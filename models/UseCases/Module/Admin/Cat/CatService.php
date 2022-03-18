<?php

namespace app\models\UseCases\Module\Admin\Cat;

use app\models\Entities\Cat\Cat;
use app\models\Forms\Module\Admin\Cat\UpdateForm;
use app\models\Repositories\Cat\CatRepository;
use app\models\Forms\Module\Admin\Cat\CreateForm;

class CatService
{
    private $repository;

    /**
     * CatService constructor.
     * @param CatRepository $repository
     */
    public function __construct(CatRepository $repository)
    {
        $this->repository = $repository;
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
}