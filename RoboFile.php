<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */

if (file_exists(__DIR__.'/.env')) {
    \Dotenv\Dotenv::create(__DIR__)->load();

}

class RoboFile extends \Robo\Tasks
{
    /**
     * @var array
     */
    private $opencart_config;

    /**
     * @var int
     */
    private $server_port = 80;
    /**
     * @var string
     */
    private $server_url = 'http://localhost';

    /**
     * RoboFile constructor.
     */
    public function __construct()
    {
        foreach ($_ENV as $option => $value) {
            if (substr($option, 0, 3) === 'OC_') {
                $option = strtolower(substr($option, 3));
                $this->opencart_config[$option] = $value;
            } elseif ($option === 'SERVER_PORT') {
                $this->server_port = (int) $value;
            } elseif ($option === 'SERVER_URL') {
                $this->server_url = $value;
            }
        }
        $this->opencart_config['http_server']  = $this->server_url.':'.$this->server_port.'/';
        $required = array('db_username', 'password', 'email');
        $missing = array();
        foreach ($required as $config) {
            if (empty($this->opencart_config[$config])) {
                $missing[] = 'OC_'.strtoupper($config);
            }
        }
//        if (!empty($missing)) {
//            $this->say("<error> Missing ".implode(', ', $missing));
//            $this->say("<error> See .env.sample ");
//            die();
//        }
    }

    function release()
    {
        // TODO
    }

    function build()
    {
        // TODO
    }

    function test()
    {
        $this->taskCodecept()
            ->suite('acceptance')
            ->run();
    }

    function startup(){
        $this->taskFilesystemStack()
            ->mirror("vendor/opencart/opencart/upload", "public")
            ->chmod('public', 0777, 0000, true)
            ->mirror("vendor/skytech/payment-php-sdk", "public/system/library/skytech")
            ->run();

        // Create new database, drop if exists already
        try {
            $conn = new PDO("mysql:host=" . $this->opencart_config['db_hostname'], $this->opencart_config['db_username'], $this->opencart_config['db_password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("DROP DATABASE IF EXISTS `" . $this->opencart_config['db_database'] . "`");
            $conn->exec("CREATE DATABASE `" . $this->opencart_config['db_database'] . "`");
        } catch (PDOException $e) {
            $this->say("<error> Database error: " . $e->getMessage());
        }
        $conn = null;
        $install = $this->taskExec('php')->arg('public/install/cli_install.php')->arg('install');
        foreach ($this->opencart_config as $option => $value) {
            $install->option($option, $value);
        }
        ob_start();
        $install->run();
        ob_end_clean();


        $localPath = __DIR__ . '/public';
        $localPath = str_replace("\\", "/", $localPath);
        $this->taskReplaceInFile('public/config.php')
            ->from([$localPath, 'define(\'DB_HOSTNAME\', \'localhost\')'])
            ->to(['/var/www/html', 'define(\'DB_HOSTNAME\', \'db\')'])
            ->run();

        $this->taskReplaceInFile('public/admin/config.php')
            ->from([$localPath, 'define(\'DB_HOSTNAME\', \'localhost\')'])
            ->to(['/var/www/html', 'define(\'DB_HOSTNAME\', \'db\')'])
            ->run();

        $this->taskDeleteDir('public/install')->run();
        $this->projectDeploy();
    }

    function projectDeploy()
    {
        $this->taskFileSystemStack()
            ->mirror('src', 'public')
            ->run();
    }

    function projectWatch()
    {
        $this->projectDeploy();
        $this->taskWatch()
            ->monitor('composer.json', function () {
                $this->taskComposerUpdate()->run();
                $this->projectDeploy();
            })->monitor('src/', function () {
                $this->projectDeploy();
            })->run();
    }
}