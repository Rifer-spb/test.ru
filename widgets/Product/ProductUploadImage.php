<?php

namespace app\widgets\Product;

use yii\base\Widget;

class ProductUploadImage extends Widget
{
    public $id;

    public function init()
    {
        parent::init();
        if(!$this->id) {
            throw new \InvalidArgumentException('ID param not found.');
        }
    }

    /**
     * @return string|null
     */
    public function run() : ?string {
        $html = "<div class='product-upload-image'>";
            $html .="<div class='btn'>";
                $html .="<button class='btn btn-primary'>Загрузить изображение (1мб)</button>";
                $html .="<input type='file'>";
            $html .="</div>";
            $html .="<div class='image-list'>";

            $html .="</div>";
        $html .="</div>";
        return $html;
    }
}