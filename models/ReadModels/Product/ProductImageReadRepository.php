<?php

namespace app\models\ReadModels\Product;

use app\models\Entities\Product\ProductImage;

class ProductImageReadRepository
{
    /**
     * @param int $id
     * @return array
     */
    public function findAllByProduct(int $id) : array {
        return ProductImage::find()->where([
            'product' => $id
        ])->asArray()->all();
    }
}