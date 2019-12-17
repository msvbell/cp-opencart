<?php
namespace Page\Acceptance;

class Main
{
    // include url of current page
    public static $URL = '/';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    public static $addToCartButton = '#content > div.row > div:nth-child(1) > div > div.button-group > button:nth-child(1)';
    public static $cartButton = '#cart > button';
    public static $checkoutButton = '#cart > ul > li:nth-child(2) > div > p > a:nth-child(2)';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
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
