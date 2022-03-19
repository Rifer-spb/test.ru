<?php

namespace app\models\Forms\Widgets\Module\Admin\Product\UploadImage;

use yii\base\Model;
use app\models\Entities\Product\Product;

class UploadForm extends Model
{
    public $id;
    public $file;

    /**
     * @return array[]
     */
    public function rules() : array {
        return [
            ['id','integer'],
            ['id','exist','targetClass' => Product::class,'targetAttribute' => ['id' => 'id']],
            [
                ['file'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'jpg,png',
                'maxSize' => 1048576,
                'tooBig' => 'Максимальный размер 1 мб'
            ],
        ];
    }
}