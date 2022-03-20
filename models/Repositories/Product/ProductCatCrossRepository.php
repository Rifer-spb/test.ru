<?php

namespace app\models\Repositories\Product;

use app\models\Entities\Product\ProductCatCross;

class ProductCatCrossRepository
{
    /**
     * @param ProductCatCross $model
     */
    public function save(ProductCatCross $model) : void {
        if(!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param array $where
     */
    public function deleteAllBy(array $where) : void {
        ProductCatCross::deleteAll($where);
    }

    /**
     * @param int $cat
     * @param int $product
     * @return bool
     */
    public function existByCatAndProduct(int $cat, int $product) : bool {
        return ProductCatCross::find()->where([
            'cat' => $cat,
            'product' => $product
        ])->exists();
    }
}