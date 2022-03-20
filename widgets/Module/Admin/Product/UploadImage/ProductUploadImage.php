<?php

namespace app\widgets\Module\Admin\Product\UploadImage;

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
        parent::init();
        if(!$this->id) {
            throw new \InvalidArgumentException('ID param not found.');
        }
    }

    /**
     * @return string
     */
    public function run() : string {
        return $this->render('index',[
            'id' => $this->id,
            'images' => $this->images->findAllByProduct($this->id)
        ]);
    }
}