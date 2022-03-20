<?php

namespace app\models\Forms\Module\Admin\Product;

use yii\base\Model;
use app\models\Entities\Cat\Cat;

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
    public function rules() : array {
        return [
            [['name','price'],'required','message' => 'Поле обязательно к заполнению'],
            [['price'], 'integer'],
            [['publish'], 'integer', 'max' => 1],
            [['name'], 'string', 'max' => 255],
            ['desc','string'],
            ['cats', 'catsValidate']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() : array {
        return [
            'id' => 'ID',
            'cats' => 'Категории',
            'name' => 'Название',
            'desc' => 'Описание',
            'price' => 'Цена',
            'publish' => 'Публикация',
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function catsValidate($attribute, $params) {
        if (!$this->hasErrors()) {
            if(!empty($this->cats) and count($this->cats)>0) {
                foreach ($this->cats as $cat) {
                    $exist = Cat::find()->where([
                        'id' => $cat,
                    ])->exists();
                    if(!$exist) {
                        $this->addError($attribute, 'Cat error.');
                    }
                }
            }
        }
    }
}