<?php
namespace Page\Acceptance;

use Codeception\Util\Locator;

class AdminUserGroupPage
{
    // include url of current page
    public static $URL = '';

    public static $form = "#form-user-group";
    public static $selectAllAccessPermission = "div.form-group:nth-child(2) > div:nth-child(2) > a:nth-child(2)";
    public static $selectAllModifyPermission = "div.form-group:nth-child(3) > div:nth-child(2) > a:nth-child(2)";
    public static $saveButton = "button.btn";

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

    private static function getGroupEditButtonSelector($groupName)
    {
        return Locator::lastElement(Locator::contains("tr", $groupName). '/td') . '/a';
    }

    public function editAdminGroup()
    {
        $I = $this->acceptanceTester;
        $I->click(self::getGroupEditButtonSelector("Administrator"));
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
