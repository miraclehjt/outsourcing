<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_test1`.
 */
class m170721_020357_create_table_test1 extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('table_test1', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('table_test1');
    }
}
