<?php
namespace Page\Acceptance;

class AdminMainPage
{
    // include url of current page
    public static $URL = '';
    // Главные пункты меню
    public static $dashboardMainMenuItem = "#menu-dashboard"; // Меню
    public static $catalogMainMenuItem = "#menu-catalog"; // Каталог
    public static $extensionsMainMenuItem = "#menu-extension"; // Модули
    public static $designMainMenuItem = "#menu-design"; // Дизайн
    public static $saleMainMenuItem = "#menu-sale"; // Продажи
    public static $customerMainMenuItem = "#menu-customer"; // Клиенты
    public static $marketingMainMenuItem = "#menu-marketing"; // Маркетинг
    public static $systemMainMenuItem = "#menu-system"; // Система
    public static $reportMainMenuItem = "#menu-report"; // Отчёт

    // ПОДПУНКТЫ МЕНЮ

    // Модули
    public static $extensionsMenuItem = "#menu-extension > ul > li:nth-child(2)"; // Подменю списка модулей в меню модулей
    public static $modulesIcon = "#content > div.container-fluid > div > div.panel-heading > h3 > i.fa-puzzle-piece"; //

    // Система
    public static $usersMenuItem = "#menu-system > ul > li:nth-child(2)"; // Пользовательские группы
    public static $userGroupMenuItem = "#menu-system > ul > li:nth-child(2) > ul > li:nth-child(2)"; // Пользовательские группы

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    public function openExtensionMenu()
    {
        $I = $this->acceptanceTester;
        $I->click(self::$extensionsMainMenuItem);
        $I->wait(1);
        $I->click(self::$extensionsMenuItem);
        $I->seeElement(self::$modulesIcon); //? хочу убедиться что страница прогрузилась, но эти два варианта надо уточнить
        $I->waitForElement('#content > div.container-fluid > div > div.panel-body > fieldset > legend'); //?

        return $this;
    }

    public function openUserGroups()
    {
        $I = $this->acceptanceTester;
        $I->click(self::$systemMainMenuItem);
        $I->wait(1);
        $I->click(self::$usersMenuItem);
        $I->wait(1);
        $I->click(self::$userGroupMenuItem);
        $I->wait(1);
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

}
