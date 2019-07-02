<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class IndexCest
{
    public function checkIndex(AcceptanceTester $I)
    {
        $I->amOnPage('/task/home');
        //$I->amOnPage(Url::toRoute('/task/home'));
        $I->wait(10);
        $I->see('Start', 'h1');
        $I->wait(2);
        $I->see('Welcome to the task manager!', 'h3');
        $I->wait(2);
        $I->seeLink('Tasks');
        $I->wait(2);
        $I->click('Tasks');
        $I->wait(4);
        $I->see('Tasks', 'h1');
    }
}
