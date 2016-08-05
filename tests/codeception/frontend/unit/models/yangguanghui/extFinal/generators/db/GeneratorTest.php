<?php

namespace tests\codeception\frontend\unit\models\yangguanghui\extFinal\generators\db;

use Yii;
use tests\codeception\frontend\unit\TestCase;
use yangguanghui\extFinal\generators\db\Generator;
use yii\helpers\FileHelper;

class GeneratorTest extends TestCase
{

    use \Codeception\Specify;

    private $source = YII_APP_BASE_PATH . '/common/config/main-local.php';
    private $dest = YII_APP_BASE_PATH 
            . '/tests/codeception/frontend/unit/fixtures/data/models/' 
            . 'yangguanghui/extFinal/generators/db/main-local.php';
    
    protected function setUp()
    {
        parent::setUp();
        copy($this->source, $this->dest);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testSaveDB()
    {
        $model = new Generator();
        $model->configFile = $this->dest;
        
        $model->attributes = [
            'dbDriver' => 'mysql',
            'dbHost' => '127.0.0.1',
            'dbPort' => '3306',
            'dbName' => 'test-final',
        ];

        expect('DB test-final should be create', $model->save(null, null, $result))->true();
        
        $config = require($model->configFile);
        
        $this->specify('config file should content model data', function () use ($model, $config) {
            expect('db name should be test-final', $config['components']['db']['dsn'])->contains($model->dbName);
        });
    }

    private function getMessageFile()
    {
        return Yii::getAlias(Yii::$app->mailer->fileTransportPath) . '/testing_message.eml';
    }
}
