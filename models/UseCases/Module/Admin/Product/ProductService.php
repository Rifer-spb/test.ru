<?php

namespace app\models\UseCases\Module\Admin\Product;

use app\models\Entities\Product\Product;
use app\models\Entities\Product\ProductCatCross;
use app\models\Forms\Module\Admin\Product\CreateForm;
use app\models\Forms\Module\Admin\Product\UpdateForm;
use app\models\Repositories\Product\ProductRepository;
use app\models\Repositories\Product\ProductCatCrossRepository;

class ProductService
{
    private $products;
    private $productCatCross;

    public function __construct(
        ProductRepository $products,
        ProductCatCrossRepository $productCatCross
    ) {
        $this->products = $products;
        $this->productCatCross = $productCatCross;
    }

    /**
     * @param CreateForm $form
     * @return int
     */
    public function add(CreateForm $form) : int {
        $product = Product::create(
            $form->name,
            $form->desc,
            $form->price,
            $form->publish
        );
        $this->products->save($product);
        foreach ($form->cats as $cat) {
            $cross = ProductCatCross::create(
                $cat,
                $product->id
            );
            $this->productCatCross->save($cross);
        }
        return $product->id;
    }

    /**
     * @param Product $product
     * @param UpdateForm $form
     */
    public function edit(Product $product, UpdateForm $form) : void {
        $product->edit(
            $form->name,
            $form->desc,
            $form->price,
            $form->publish
        );
        $this->products->save($product);
        if(!empty($form->cats) and count($form->cats)>0) {
            $this->productCatCross->deleteAllBy([
                'AND',
                ['product' => $product->id],
                ['NOT IN','cat',$form->cats]
            ]);
            foreach ($form->cats as $cat) {
                $exist = $this->productCatCross->existByCatAndProduct(
                    $cat,
                    $product->id
                );
                if(!$exist) {
                    $cross = ProductCatCross::create(
                        $cat,
                        $product->id
                    );
                    $this->productCatCross->save($cross);
                }
            }
        } else {
            $this->productCatCross->deleteAllBy([
                'product' => $product->id
            ]);
        }
    }
}