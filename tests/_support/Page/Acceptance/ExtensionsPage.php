<?php
namespace Page\Acceptance;

use Codeception\Util\Locator;

class ExtensionsPage
{
    // include url of current page
    public static $URL = '/admin/index.php?route=extension/extension';

    public static $extensionTypeSelect = "#content > div.container-fluid > div > div.panel-body > fieldset > div > div > select";
    public static $paymentsPluginsOption = "#content > div.container-fluid > div > div.panel-body > fieldset > div > div > select > option:nth-child(7)";

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

    public function openPaymentPlugins()
    {
        $I = $this->acceptanceTester;
        $paymentMenuText = $I->grabTextFrom(self::$paymentsPluginsOption);
        $I->selectOption(self::$extensionTypeSelect, $paymentMenuText);

        return $this;
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
