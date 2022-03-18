<?php

namespace app\models\UseCases\Module\Admin\Product;

use app\models\Entities\Product\Product;
use app\models\Forms\Module\Admin\Product\CreateForm;
use app\models\Repositories\Product\ProductRepository;

class ProductService
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateForm $form
     * @return int
     */
    public function add(CreateForm $form) : int {
        $model = Product::create(
            $form->name,
            $form->desc,
            $form->price,
            $form->publish
        );
        $this->repository->save($model);
        return $model->id;
    }
}