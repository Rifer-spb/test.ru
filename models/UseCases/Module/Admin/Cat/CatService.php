<?php

namespace app\models\UseCases\Module\Admin\Cat;

use app\models\Entities\Cat\Cat;
use app\models\Repositories\Cat\CatRepository;
use app\models\Forms\Module\Admin\Cat\UpdateForm;
use app\models\Forms\Module\Admin\Cat\CreateForm;
use app\models\Repositories\Product\ProductCatCrossRepository;

class CatService
{
    private $repository;
    private $productCats;


    public function __construct(
        CatRepository $repository,
        ProductCatCrossRepository $productCats
    ) {
        $this->repository = $repository;
        $this->productCats = $productCats;
    }

    /**
     * @param CreateForm $form
     * @return int
     */
    public function add(CreateForm $form) : int {
         $cat = Cat::create(
             $form->name,
             $form->color
         );
        $this->repository->save($cat);
        return $cat->id;
    }

    /**
     * @param Cat $model
     * @param UpdateForm $form
     */
    public function edit(Cat $model, UpdateForm $form) : void {
        $model->edit(
            $form->name,
            $form->color
        );
        $this->repository->save($model);
    }

    /**
     * @param Cat $model
     * @throws \yii\db\StaleObjectException
     */
    public function delete(Cat $model) : void {
        $this->productCats->deleteAllBy([
            'cat' => $model->id
        ]);
        $this->repository->delete($model);
    }
}