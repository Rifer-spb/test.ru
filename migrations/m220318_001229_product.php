<?php

use yii\db\Migration;

/**
 * Class m220318_001229_product
 */
class m220318_001229_product extends Migration
{
    public function up()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->integer()->unsigned()->defaultValue(0),
            'publish' => $this->tinyInteger()->unsigned()->defaultValue(0)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
