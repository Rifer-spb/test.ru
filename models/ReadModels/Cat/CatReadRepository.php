<?php

namespace app\models\ReadModels\Cat;

use app\models\Entities\Cat\Cat;

class CatReadRepository
{
    /**
     * @return array
     */
    public function findAll() : array {
        return Cat::find()->asArray()->all();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findCatsByProduct(int $id) : array {
        return Cat::find()
            ->where("id IN (SELECT cat FROM product_cat_cross WHERE product=$id)")
            ->asArray()
            ->all();
    }
}