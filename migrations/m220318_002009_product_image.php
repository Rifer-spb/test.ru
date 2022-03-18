<?php

use yii\db\Migration;

/**
 * Class m220318_002009_product_image
 */
class m220318_002009_product_image extends Migration
{
    public function up()
    {
        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(),
            'product' => $this->integer()->unsigned(),
            'name' => $this->string(),
            'extension' => $this->string(),
            'server_name' => $this->string(),
            'size' => $this->integer()->unsigned(),
            'default' => $this->tinyInteger()->unsigned()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%product_image}}');
    }
}
