<?php

namespace app\models\Repositories\Product;

use app\models\Entities\Product\ProductImage;

class ProductImageRepository
{
    /**
     * @param ProductImage $model
     */
    public function save(ProductImage $model) : void {
        if(!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param ProductImage $model
     * @throws \yii\db\StaleObjectException
     */
    public function delete(ProductImage $model) : void {
        if(!$model->delete()) {
            throw new \RuntimeException('Delete error.');
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function existByProduct(int $id) : bool {
        return ProductImage::find()->where([
            'product' => $id
        ])->exists();
    }

    /**
     * @param array $fields
     * @param array $where
     */
    public function updateAll(array $fields, array $where) : void {
        ProductImage::updateAll($fields,$where);
    }

}