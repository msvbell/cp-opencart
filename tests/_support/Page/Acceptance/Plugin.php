<?php

namespace Page\Acceptance;

class Plugin
{
    // include url of current page
    public static $URL = '';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    public static $merchantIdField = '#input-merchant-id';
    public static $hostField = '#input-host';
    public static $clientCertTextarea = '#textarea-client-cert';
    public static $secretKeyField = '#input-secret-key';
    public static $totalField = '#input-total';
    public static $orderStatusField = '#input-order-status';
    public static $geoZoneField = '#input-geo-zone';
    public static $statusField = '#input-status';
    public static $saveButton = 'button.btn';

    public static $hostLabel = 'label[for=input-host]';
    public static $merchantIdLabel = 'label[for=input-merchant-id]';
    public static $clientCertLabel = 'label[for=textarea-client-cert]';
    public static $secretKeyLabel = 'label[for=input-secret-key]';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL . $param;
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
