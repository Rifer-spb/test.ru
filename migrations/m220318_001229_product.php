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
        $this->insert('{{%product}}',[
            'name' => 'Первый',
            'price' => 600,
            'publish' => 1
        ]);
        $this->insert('{{%product}}',[
            'name' => 'Часы',
            'price' => 300,
            'publish' => 1
        ]);
        $this->insert('{{%product}}',[
            'name' => 'Продукт без описания категории',
            'price' => 500,
            'publish' => 1
        ]);
        $this->insert('{{%product}}',[
            'name' => 'Машинка',
            'price' => 777,
            'publish' => 1
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%products}}');
    }
}
