<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TasksCest
{
    public function checkIndex(AcceptanceTester $I)
    {
        $I->amOnPage('/task/index');
        //$I->amOnPage(Url::toRoute('/task/home'));
        $I->see('Tasks', 'h1');
        $I->click('(//*[contains(@class,"glyphicon-eye-open")])[2]');
        $I->wait(2);
        $I->see('nothing', 'h1');
        $I->wait(2);
        $I->click('Tasks');
        $I->wait(2);
        $I->click(['class' => 'btn-success']);
        $I->wait(2);
        $I->fillField('Title', 'Hello');
        $I->wait(2);
        $I->fillField('Description', ' Vestibulum ante ipsum.');
        $I->wait(2);
        $I->fillField('Project ID', 1);
        $I->wait(2);
        $I->click(['class' => 'btn-success']);
        $I->wait(2);
    }
}
