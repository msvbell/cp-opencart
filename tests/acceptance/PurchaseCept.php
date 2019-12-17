<?php

use Codeception\Scenario;
use Page\Acceptance\Checkout as CheckoutPage;
use Page\Acceptance\Main as MainPage;

/** @var Scenario $scenario */
$I = new AcceptanceTester($scenario);
$I->wantTo('Купить товар');
$I->amOnPage('/');
$I->click(MainPage::$addToCartButton);
$I->waitForText('1 item'); // В корзине появился один товар
$I->click(MainPage::$cartButton);
$I->waitForText('Checkout'); // Ждем открытия модального окна корзины
$I->click(MainPage::$checkoutButton);
$I->waitForText('Step 1'); // Убедимся что открылась страница оформления покупки
$I->wait(1);
$I->click(CheckoutPage::$guestCheckoutRadio);
$I->click(CheckoutPage::$accountContinueButton);
$I->wait(1);
$I->fillField(CheckoutPage::$firstNameField, 'Sergey');
$I->fillField(CheckoutPage::$lastNameField, 'Ivanov');
$I->fillField(CheckoutPage::$emailField, 'test@test.com');
$I->fillField(CheckoutPage::$telephoneField, '84951234567');
$I->fillField(CheckoutPage::$addressField, 'Address');
$I->fillField(CheckoutPage::$cityField, 'City');
$I->fillField(CheckoutPage::$postCodeField, '123456');
$I->selectOption(CheckoutPage::$zoneField, 'Aberdeen');
$I->click(CheckoutPage::$billingDetailsContinueButton);
$I->wait(1);
$I->click(CheckoutPage::$agreeCheckbox);
$I->click(CheckoutPage::$paymentMethodContinueButton);
$I->wait(1);
$I->dontSee('Warning: Payment method required!', '#collapse-payment-method > div');
$I->wait(5);
