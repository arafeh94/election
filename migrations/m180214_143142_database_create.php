<?php

use app\components\SQLFileExecutor;
use yii\db\Migration;

/**
 * Class m180214_143142_database_create
 */
class m180214_143142_database_create extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $path = __DIR__ . '/assets/create.sql';
        echo SQLFileExecutor::execute($path);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180214_143142_database_create cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180214_143142_database_create cannot be reverted.\n";

        return false;
    }
    */
}
