<?php

namespace tests\codeception\frontend\_pages\yangguanghui\extFinal\generators\db;

use yii\codeception\BasePage;
use yangguanghui\extFinal\generators\db\Generator;

/**
 * Represents db generator page
 * @property \codeception_frontend\AcceptanceTester|\codeception_frontend\FunctionalTester $actor
 */
class GeneratorPage extends BasePage
{

    public $route = ['final/default/view', 'id' => 'db'];

    private $model;
    /**
     * @param array $generatorData
     */
    public function submit(array $generatorData)
    {
        $generatorForm = new Generator();
        
        $this->model = $generatorForm;

        foreach ($generatorData as $field => $value) {
            $inputType = $field === 'body' ? 'textarea' : 'input';
            $this->actor->fillField($inputType . '[name="' . $generatorForm->formName() . '[' . $field . ']"]', $value);
        }
        $this->actor->click('save');
    }
    
    public function dropDB($dbName) {
        $this->model->dbName = $dbName;
        $this->model->executeDropDB();
    }
}
