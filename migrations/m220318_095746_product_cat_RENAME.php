<?php

use yii\db\Migration;

/**
 * Class m220318_095746_product_cat_RENAME
 */
class m220318_095746_product_cat_RENAME extends Migration
{
    public function up()
    {
        $this->renameTable('{{%product_cat}}','{{%cat}}');
    }

    public function down()
    {
        $this->renameTable('{{%cat}}','{{%product_cat}}');
    }
}
