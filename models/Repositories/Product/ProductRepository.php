<?php

namespace app\models\Repositories\Product;

use app\models\Entities\Product\Product;

class ProductRepository
{
    /**
     * @param Product $model
     */
    public function save(Product $model) : void {
        if(!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}