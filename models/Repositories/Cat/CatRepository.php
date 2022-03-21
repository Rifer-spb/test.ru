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

    /**
     * @param Cat $model
     * @throws \yii\db\StaleObjectException
     */
    public function delete(Cat $model) : void {
        if(!$model->delete()) {
            throw new \RuntimeException('Delete error.');
        }
    }
}