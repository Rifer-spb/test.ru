<?php

namespace app\widgets\Product\CategoryBar;

use yii\base\Widget;
use app\models\ReadModels\Cat\CatReadRepository;

class ProductCategoryBar extends Widget
{
    public $id;
    private $cats;

    public function __construct(
        CatReadRepository $cats,
        $config = []
    ) {
        $this->cats = $cats;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        if(!$this->id) {
            throw new \InvalidArgumentException('ID param not found.');
        }
    }

    public function run() : ?string {
        $cats = $this->cats->findCatsByProduct($this->id);
        if(count($cats)>0) {
            $html = "<div class='product-category-bar'>";
                $width = 100/count($cats);
                foreach ($cats as $cat) {
                    $html .='<div style="background-color:'.$cat['color'].';width:'.$width.'%">';
                        $html .=$cat['color'];
                    $html .='</div>';
                }
            $html .="</div>";
            return $html;
        }
        return null;
    }
}