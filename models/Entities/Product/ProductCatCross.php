<?php

namespace app\models\Entities\Product;

use yii\db\ActiveQuery;
use app\models\Entities\Cat\Cat;

/**
 * This is the model class for table "product_cat_cross".
 *
 * @property int $id
 * @property int|null $cat
 * @property int|null $product
 */
class ProductCatCross extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName() : string {
        return 'product_cat_cross';
    }

    /**
     * @param int $cat
     * @param int $product
     * @return static
     */
    public static function create(int $cat, int $product) : self {
        $model = new static();
        $model->cat = $cat;
        $model->product = $product;
        return $model;
    }

    /**
     * @return ActiveQuery
     */
    public function getCat() : ActiveQuery {
        return $this->hasOne(Cat::class,['id' => 'cat']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCatItem() : ActiveQuery {
        return $this->hasOne(Cat::class,['id' => 'cat']);
    }
}
