<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TaskHomeСest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/task/home'));
        $I->see('Start', 'h1');
        $I->see('Welcome to the task manager!', 'h3');

        $I->seeLink('Tasks');
        $I->click('Tasks');
        $I->see('Tasks', 'h1');
    }
}