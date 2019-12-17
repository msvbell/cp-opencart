<?php
namespace Page;

class AdminLoginPage
{
    protected $tester;
    // include url of current page
    public static $URL = '/admin';

    public static $usernameField = "#input-username";
    public static $passwordField = "#input-password";
    public static $loginButton = "#content > div > div > div > div > div.panel-body > form > div.text-right > button";

    /**
     * AdminLoginPage constructor.
     * @param $tester
     */
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

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

    public function loginAsAdmin()
    {
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        $I->waitForElement(self::$usernameField, 15);
        $I->fillField(self::$usernameField, getenv('oc_username'));
        $I->fillField(self::$passwordField, getenv('oc_password'));
        $I->click(self::$loginButton);
        $I->waitForElement("#profile");

        return $this;
    }


}
