<?php

namespace tests\codeception\frontend\functional\yangguanghui\extFinal\generators\db;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\frontend\_pages\yangguanghui\extFinal\generators\db\GeneratorPage;

/* @var $scenario \Codeception\Scenario */

$I = new FunctionalTester($scenario);

$I->wantTo('ensure that db generator works');
$generatorPage = GeneratorPage::openBy($I);
$I->see('DB Config Generator', 'h1');

$I->amGoingTo('submit db generator form with no data');
$generatorPage->submit([]);

$I->expectTo('see validations errors');
$I->see('Database Name cannot be blank.', '.help-block');

$I->amGoingTo('submit db generator form with correct data');
$dbName = 'test2';
$generatorPage->submit([
    'dbName' => $dbName,
]);

$I->see('Save ok');

$I->amGoingTo('drop db...');
$generatorPage->dropDB($dbName);
$I->comment('dropped');
