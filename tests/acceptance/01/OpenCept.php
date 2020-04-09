<?php

use Codeception\Scenario;
use Page\Acceptance\Plugin as PluginPage;
use \Step\Acceptance\Plugin as PluginTester;

/*
 * Автоматической установки плагина в админстративной панели пока нет
 * */
$host = 'https://mpi.testbank.ru:8444/exec';
$merchantId = 'ES000000';
$certFile = 'client.crt';
$keyFile = 'client.key';
$keyPassphrase = 'passphrase';

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
$I->canSee('Merchant secret key passphrase', PluginPage::$secretKeyPassphraseLabel);

$I->seeElement(PluginPage::$hostField);
$I->seeElement(PluginPage::$merchantIdField);
$I->seeElement(PluginPage::$clientCertTextarea);
$I->seeElement(PluginPage::$secretKeyField);
$I->seeElement(PluginPage::$secretKeyPassphraseField);
$I->seeElement(PluginPage::$totalField);
$I->seeElement(PluginPage::$orderStatusField);
$I->seeElement(PluginPage::$geoZoneField);
$I->seeElement(PluginPage::$statusField);

$clientCert = file_get_contents(codecept_data_dir(). $certFile);
$key = file_get_contents(codecept_data_dir(). $keyFile);
$I->fillField(PluginPage::$hostField, $host);
$I->fillField(PluginPage::$merchantIdField, $merchantId);
$I->fillField(PluginPage::$clientCertTextarea, $clientCert);
$I->fillField(PluginPage::$secretKeyField, $key);
$I->fillField(PluginPage::$secretKeyPassphraseField, $keyPassphrase);
$I->fillField(PluginPage::$totalField, 0);

$I->click(PluginPage::$saveButton);