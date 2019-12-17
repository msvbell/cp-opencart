<?php
namespace Page\Acceptance;

class Checkout
{
    // include url of current page
    public static $URL = '';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    public static $guestCheckoutRadio = '#collapse-checkout-option > div > div > div:nth-child(1) > div:nth-child(4) > label';
    public static $accountContinueButton = '#button-account';
    public static $firstNameField = '#input-payment-firstname';
    public static $lastNameField = '#input-payment-lastname';
    public static $emailField = '#input-payment-email';
    public static $telephoneField = '#input-payment-telephone';
    public static $addressField = '#input-payment-address-1';
    public static $cityField = '#input-payment-city';
    public static $postCodeField = '#input-payment-postcode';
    public static $zoneField = '#input-payment-zone';
    public static $billingDetailsContinueButton = '#button-guest';
    public static $paymentMethodContinueButton = '#button-payment-method';
    public static $agreeCheckbox = 'input[name=agree]';

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
