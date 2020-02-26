<?php

use Codeception\Scenario;
use Page\Acceptance\Plugin as PluginPage;
use \Step\Acceptance\Plugin as PluginTester;

/*
 * Автоматической установки плагина в админстративной панели пока нет
 * */

/** @var Scenario $scenario */
$I = new PluginTester($scenario);
$I->wantTo('Проверка административной панели плагина');
$I->setPermissionAccess();
$I->openPluginSettings();

$I->cantSee('Undefined variable');

$I->canSee('Host', PluginPage::$hostLabel);
$I->canSee('Merchant ID', PluginPage::$merchantIdLabel);
$I->canSee('Merchant certificate', PluginPage::$clientCertLabel);
$I->canSee('Merchant secret key', PluginPage::$secretKeyLabel);

$I->seeElement(PluginPage::$hostField);
$I->seeElement(PluginPage::$merchantIdField);
$I->seeElement(PluginPage::$clientCertTextarea);
$I->seeElement(PluginPage::$secretKeyField);
$I->seeElement(PluginPage::$totalField);
$I->seeElement(PluginPage::$orderStatusField);
$I->seeElement(PluginPage::$geoZoneField);
$I->seeElement(PluginPage::$statusField);

$clientCert = file_get_contents(codecept_data_dir().'test.pem');

$I->fillField(PluginPage::$hostField, 'https://superpayment.com:9444/exec');
$I->fillField(PluginPage::$merchantIdField, 'ES000000');
$I->fillField(PluginPage::$clientCertTextarea, $clientCert);
$I->fillField(PluginPage::$secretKeyField, 'super secret key hash');
$I->fillField(PluginPage::$totalField, 0);

$I->click(PluginPage::$saveButton);
//$I->wait(5);