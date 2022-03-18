<?php

use yii\db\Migration;

/**
 * Class m220318_122550_product_ADD_COL
 */
class m220318_122550_product_ADD_COL extends Migration
{
    public function up()
    {
        $this->addColumn('{{%product}}', 'desc', $this->text()->after('name'));
    }

    public function down()
    {
        $this->dropColumn('{{%product}}', 'desc');
    }
}
