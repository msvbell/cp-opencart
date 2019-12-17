<?php

use Codeception\Scenario;
use Page\Acceptance\Plugin as PluginPage;
use \Step\Acceptance\Plugin as PluginTester;

/** @var Scenario $scenario */
$I = new PluginTester($scenario);
$I->wantTo('Проверка административной панели плагина');
$I->setPermissionAccess();
$I->openPluginSettings();

$I->seeElement(PluginPage::$merchantIdField);
$I->seeElement(PluginPage::$rootCertTextarea);
$I->seeElement(PluginPage::$clientCertTextarea);
$I->seeElement(PluginPage::$secretKeyField);
$I->seeElement(PluginPage::$totalField);
$I->seeElement(PluginPage::$orderStatusField);
$I->seeElement(PluginPage::$geoZoneField);
$I->seeElement(PluginPage::$statusField);
$I->seeElement(PluginPage::$debugField);

$rootCert = file_get_contents(codecept_data_dir().'test_crt.crt');
$clientCert = file_get_contents(codecept_data_dir().'test.pem');

$I->fillField(PluginPage::$merchantIdField, 'ES000000');
$I->fillField(PluginPage::$rootCertTextarea, $rootCert);
$I->fillField(PluginPage::$clientCertTextarea, $clientCert);
$I->fillField(PluginPage::$totalField, 0);

$I->click(PluginPage::$saveButton);
//$I->wait(5);