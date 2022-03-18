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
}