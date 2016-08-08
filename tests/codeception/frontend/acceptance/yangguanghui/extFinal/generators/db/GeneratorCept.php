<?php

namespace tests\codeception\frontend\acceptance\yangguanghui\extFinal\generators\db;

use tests\codeception\frontend\AcceptanceTester;
use tests\codeception\frontend\_pages\yangguanghui\extFinal\generators\db\GeneratorPage;

/* @var $scenario \Codeception\Scenario */

$I = new AcceptanceTester($scenario);

$I->wantTo('ensure that db generator works');
$generatorPage = GeneratorPage::openBy($I);
$I->see('DB Config Generator', 'h1');

$I->amGoingTo('submit db generator form with no data');
$generatorPage->submit([]);

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->expectTo('see validations errors');
$I->see('Database Name cannot be blank.', '.help-block');

$I->amGoingTo('submit db generator form with correct data');
$dbName = 'test2';
$generatorPage->submit([
    'dbName' => $dbName,
]);

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->see('Save ok');

$I->amGoingTo('drop db...');
$generatorPage->dropDB($dbName);
$I->comment('dropped');
