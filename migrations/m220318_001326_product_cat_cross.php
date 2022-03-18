<?php

use yii\db\Migration;

/**
 * Class m220318_001326_product_cat_cross
 */
class m220318_001326_product_cat_cross extends Migration
{
    public function up()
    {
        $this->createTable('{{%product_cat_cross}}', [
            'id' => $this->primaryKey(),
            'cat' => $this->integer()->unsigned(),
            'product' => $this->integer()->unsigned()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%product_cat_cross}}');
    }
}
