<?php

namespace app\models\Forms\Module\Admin\Cat;

use yii\base\Model;

class CreateForm extends Model
{
    public $name;
    public $color;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'],'required','message' => 'Поле обязательно к заполнению'],
            [['name', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'color' => 'Цвет',
        ];
    }
}