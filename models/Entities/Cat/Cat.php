<?php

namespace app\models\Entities\Cat;

/**
 * This is the model class for table "cat".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $color
 */
class Cat extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName() {
        return 'cat';
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'color' => 'Цвет',
        ];
    }

    /**
     * @param string $name
     * @param string $color
     * @return Cat
     */
    public static function create(string $name, string $color) : self {
        $model = new static();
        $model->name = $name;
        $model->color = $color;
        return $model;
    }

    /**
     * @param string $name
     * @param string $color
     */
    public function edit(string $name, string $color) : void {
        $this->name = $name;
        $this->color = $color;
    }
}
