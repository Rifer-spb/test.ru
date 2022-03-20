<?php

namespace app\widgets\Module\Admin\Product\CategoryBar;

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

    /**
     * @return string
     */
    public function run() : string {
        return $this->render('index',[
            'cats' => $this->cats->findCatsByProduct($this->id)
        ]);
    }
}