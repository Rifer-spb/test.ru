<?php

namespace app\widgets\Module\Admin\Product;

use yii\base\Widget;
use app\models\Helpers\ProductHelper;
use app\models\ReadModels\Product\ProductImageReadRepository;

class ProductUploadImage extends Widget
{
    public $id;
    private $images;

    public function __construct(ProductImageReadRepository $images, $config = [])
    {
        $this->images = $images;
        parent::__construct($config);
    }

    public function init()
    {
        ProductUploadImageAssets::register( $this->getView() );
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
            $html .="<label>Загрузка изображений</label>";
            $html .="<div class='row'>";
                $html .="<div class='col-sm-4'>";
                    $html .="<div class='action'>";
                        $html .="<button class='btn btn-primary'>Загрузить изображение (1мб)</button>";
                        $html .="<input type='file' multiple data-id='$this->id'>";
                    $html .="</div>";
                    $html .="<div class='progress'>";
                        $html .="<div class='progress-bar-warning progress-bar' role='progressbar' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' style='width: 0;'></div>";
                    $html .="</div>";
                    $html .="<p class='error'></p>";
                $html .="</div>";
                $html .="<div class='col-sm-8'>";
                    $images = $this->images->findAllByProduct($this->id);
                    if(count($images)>0) {
                        $html .="<div class='image-list'>";
                            $html .= ProductHelper::getImagesListHtml($images);
                        $html .="</div>";
                    } else {
                        $html .="<div class='image-list'>Изображений не найдено</div>";
                    }
                $html .="</div>";
            $html .="</div>";
        $html .="</div>";
        return $html;
    }
}