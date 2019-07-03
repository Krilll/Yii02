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
        $I->wait(2);
        $I->see('Tasks', 'h1');
        $I->wait(2);
        $I->click('(//*[contains(@class,"glyphicon-eye-open")])[2]');
        //$I->click(['class' => 'glyphicon-eye-open']);
        $I->wait(2);
        $I->see('nothing', 'h1');
        $I->wait(2);
        $I->click('Tasks');
        $I->wait(2);

//"//*[@id='modal_w']/div[2]
        //'(//*[contains(@class,"red") and not(@disabled)])[1]'
       // $I->see('Welcome to the task manager!', 'h3');
        //$I->wait(2);
        //$I->seeLink('Create Task');
        //$I->wait(2);
        //$I->click(['class' => 'btn btn-success']);
        //$I->wait(4);
        //$I->see('Create Task', 'h1');
    }
}
