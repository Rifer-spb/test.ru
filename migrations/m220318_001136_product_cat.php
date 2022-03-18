<?php

use yii\db\Migration;

/**
 * Class m220318_001136_product_cat
 */
class m220318_001136_product_cat extends Migration
{
    public function up()
    {
        $this->createTable('{{%product_cat}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'color' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%product_cat}}');
    }
}
