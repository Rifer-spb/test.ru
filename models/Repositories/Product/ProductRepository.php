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

    /**
     * @param Product $model
     * @throws \yii\db\StaleObjectException
     */
    public function delete(Product $model) : void {
        if(!$model->delete()) {
            throw new \RuntimeException('Delete error.');
        }
    }
}