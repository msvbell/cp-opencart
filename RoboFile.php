<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */

if (file_exists(__DIR__ . '/.env')) {
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
                $this->server_port = (int)$value;
            } elseif ($option === 'SERVER_URL') {
                $this->server_url = $value;
            }
        }
        $this->opencart_config['http_server'] = $this->server_url . ':' . $this->server_port . '/';
        $required = array('db_username', 'password', 'email');
        $missing = array();
        foreach ($required as $config) {
            if (empty($this->opencart_config[$config])) {
                $missing[] = 'OC_' . strtoupper($config);
            }
        }
    }

    function release()
    {
        // TODO
    }

    function build()
    {
        // TODO
    }

    /**
     * Запуск acceptance тестов в chrome
     */
    function test()
    {
        $this->taskCodecept()
            ->suite('acceptance')
            ->run();
    }

    /**
     * Установка opencart и плагина на docker
     */
    function startup()
    {
        $this->taskFilesystemStack()
            ->mirror("vendor/opencart/opencart/upload", "public")
            ->chmod('public', 0777, 0000, true)
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

    /**
     * Копирование кода плагина на docker
     */
    function projectDeploy()
    {
        $this->taskFileSystemStack()
            ->mirror('src', 'public')
            ->run();
    }

    /**
     * Добавляет в плагин sdk как библиотеку из dev ветки sdk
     */
    public function addsdk()
    {
        $collection = $this->collectionBuilder();
        $tmpDir = $this->collectionBuilder()->tmpDir('tmp', __DIR__);
        $tmpDir2 = $this->collectionBuilder()->tmpDir('tmp', __DIR__);

        $this->say($tmpDir);

        $collection->addTask(
            $this->taskFilesystemStack()
                ->mirror('vendor/skytech/payment-php-sdk', $tmpDir)
        )->addTask(
            $this->taskComposerInstall()
                ->dir($tmpDir)
                ->noDev()
        );

        $collection->run();

        $files = \Symfony\Component\Finder\Finder::create()
            ->ignoreVCS(true)
            ->files()
            ->notName('*.md')
            ->notName('*.rst')
            ->notName('composer.json')
            ->notName('*.yml')
            ->notName('*.dist')
            ->notName('LICENSE')
            ->notName('phpunit.xml')
            ->notName('Makefile')
            ->path('src')
            ->path('vendor')
            ->notPath('/vendor\/.*\/[Tt]est/')
            ->notPath('/vendor\/.*\/[Dd]ocs/')
            ->in($tmpDir);

        $directories = \Symfony\Component\Finder\Finder::create()
            ->ignoreVCS(true)
            ->directories()
            ->path('src')
            ->path('vendor')
            ->notPath('/vendor\/.*\/[Tt]est/')
            ->notPath('/vendor\/.*\/[Dd]ocs/')
            ->in($tmpDir);

        $collection2 = $this->collectionBuilder();

        foreach ($directories as $directory) {
            $destDir = str_replace($tmpDir, $tmpDir2, $directory);
            $collection2->addTask(
                $this->taskFilesystemStack()->mkdir($destDir)
            );
        }

        foreach ($files as $file) {
            $destFile = str_replace($tmpDir, $tmpDir2, $file);
            $collection2->addTask(
                $this->taskExec('php')
                    ->arg('-w')
                    ->arg((string)$file)
                    ->rawArg('>')
                    ->arg($destFile)
            );
        }

        $collection2->addTask(
            $this->taskFilesystemStack()
            ->mirror("$tmpDir2/src", 'src/system/library/compassplus/src')
            ->mirror("$tmpDir2/vendor", 'src/system/library/compassplus/vendor')
        );

        $collection2->completion($this->taskDeleteDir([$tmpDir, $tmpDir2]));
        $collection2->run();
    }

    /**
     * Добавить файл корневых сертификатов.
     * Нужен для ssl соединения с сервером TWPG
     */
    public function updatecacert()
    {
        $caFile = file_get_contents('https://curl.haxx.se/ca/cacert.pem');
        $this->taskWriteToFile('src/system/library/compassplus/cacert.pem')->text($caFile)->run();
    }

    /**
     *  Уменьшить размер sdk
     *  Убирает комментарии и лишнии символы
     *  В каждом файле исходный код будет в одну строчку
     */
    function compressDependencies()
    {
        $finder = \Symfony\Component\Finder\Finder::create()
            ->path('src/system/library/compassplus')
            ->name('*.php');

        foreach ($finder as $file) {
            $handle = fopen($file, 'wb+');
            $contents = fread($handle, filesize($file));
        }
    }

    /**
     *  Следить за изменениями в папке src и composer.json и загружать изменения в docker
     */
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