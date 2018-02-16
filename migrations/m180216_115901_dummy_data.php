<?php

use app\components\SQLFileExecutor;
use yii\db\Migration;

/**
 * Class m180216_115901_dummy_data
 */
class m180216_115901_dummy_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $path = __DIR__ . '/assets/dummy.sql';
        echo SQLFileExecutor::execute($path);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180216_115901_dummy_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180216_115901_dummy_data cannot be reverted.\n";

        return false;
    }
    */
}
