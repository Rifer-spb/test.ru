<?php

namespace app\models\ReadModels\Product;

use app\models\Entities\Product\ProductCatCross;

class ProductCatCrossReadRepository
{
    /**
     * @param int $id
     * @return array
     */
    public function findCatIDsByProduct(int $id) : array {
        return ProductCatCross::find()
            ->select('cat')
            ->where(['product' => $id])
            ->asArray()
            ->column();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findCatsByProduct(int $id) : array {
        return ProductCatCross::find()
            ->alias('c')
            ->joinWith('cat')
            ->where(['product' => $id])
            ->asArray()
            ->all();
    }
}