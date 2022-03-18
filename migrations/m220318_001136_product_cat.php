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
        $this->insert('{{%product_cat}}',['name' => 'Бирюзовая','color' => '#3dfff2']);
        $this->insert('{{%product_cat}}',['name' => 'Синяя','color' => '#003998']);
        $this->insert('{{%product_cat}}',['name' => 'Зеленая','color' => '#248f02']);
        $this->insert('{{%product_cat}}',['name' => 'Красная','color' => '#cc0000']);
    }

    public function down()
    {
        $this->dropTable('{{%product_cat}}');
    }
}
