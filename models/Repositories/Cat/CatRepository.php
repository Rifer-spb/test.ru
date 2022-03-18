<?php

namespace app\models\Repositories\Cat;

use app\models\Entities\Cat\Cat;

class CatRepository
{
    /**
     * @param Cat $model
     */
    public function save(Cat $model) : void {
        if(!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}