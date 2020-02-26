<?php
namespace Step\Acceptance;

use Page\Acceptance\AdminMainPage;
use Page\Acceptance\AdminUserGroupPage;
use Page\Acceptance\ExtensionsPage;
use Page\AdminLoginPage;

class Plugin extends \AcceptanceTester
{

    public function openPluginSettings()
    {
        $I = $this;
        $adminLoginPage = new AdminLoginPage($I);
        $adminLoginPage->loginAsAdmin();
        $mainAdminPage = new AdminMainPage($I);
        $mainAdminPage->openExtensionMenu();
        $extensionsPage = new ExtensionsPage($I);
        $extensionsPage->openPaymentPlugins();

        $uri = $I->grabFromCurrentUrl();
        $uri = str_replace('extension/extension', 'extension/payment/compassplus', $uri);
        $I->amOnPage($uri);
        $I->waitForElement(\Page\Acceptance\Plugin::$merchantIdField);
    }

    public function setPermissionAccess()
    {
        $I = $this;
        $adminLoginPage = new AdminLoginPage($I);
        $adminLoginPage->loginAsAdmin();
        $mainAdminPage = new AdminMainPage($I);
        $mainAdminPage->openUserGroups();
        $userGroupPage = new AdminUserGroupPage($I);
        $userGroupPage->editAdminGroup();
        $I->wait(1);
        $I->click(AdminUserGroupPage::$selectAllAccessPermission);
        $I->click(AdminUserGroupPage::$selectAllModifyPermission);
        $I->click(AdminUserGroupPage::$saveButton);
        $I->wait(5);

    }

}