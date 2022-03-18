<?php

namespace app\models\Forms\Module\Admin\Product;

use yii\base\Model;

class CreateForm extends Model
{
    public $cats;
    public $name;
    public $desc;
    public $price;
    public $publish;

    /**
     * @return array
     */
    public function rules() {
        return [
            [['name','price','cats'],'required','message' => 'Поле обязательно к заполнению'],
            [['price'], 'integer'],
            [['publish'], 'integer', 'max' => 1],
            [['name'], 'string', 'max' => 255],
            ['desc','string'],
            ['cats', 'each', 'rule' => ['integer']]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cats' => 'Категории',
            'name' => 'Название',
            'desc' => 'Описание',
            'price' => 'Цена',
            'publish' => 'Публикация',
        ];
    }
}