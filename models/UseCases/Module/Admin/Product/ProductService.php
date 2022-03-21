<?php

namespace app\models\UseCases\Module\Admin\Product;

use Yii;
use app\models\Helpers\FileHelper;
use app\models\Entities\Product\Product;
use app\models\Entities\Product\ProductCatCross;
use app\models\Forms\Module\Admin\Product\CreateForm;
use app\models\Forms\Module\Admin\Product\UpdateForm;
use app\models\Repositories\Product\ProductRepository;
use app\models\Repositories\Product\ProductImageRepository;
use app\models\Repositories\Product\ProductCatCrossRepository;

class ProductService
{
    private $products;
    private $productImages;
    private $productCatCross;

    public function __construct(
        ProductRepository $products,
        ProductImageRepository $productImages,
        ProductCatCrossRepository $productCatCross
    ) {
        $this->products = $products;
        $this->productImages = $productImages;
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
        if(!empty($form->cats) and count($form->cats)>0) {
            foreach ($form->cats as $cat) {
                $cross = ProductCatCross::create(
                    $cat,
                    $product->id
                );
                $this->productCatCross->save($cross);
            }
        }
        return $product->id;
    }

    /**
     * @param Product $product
     * @param UpdateForm $form
     */
    public function edit(Product $product, UpdateForm $form) {
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

    /**
     * @param Product $product
     * @throws \yii\db\StaleObjectException
     */
    public function delete(Product $product) : void {
        $uploadPath = Yii::getAlias('@product');
        $productPath = "$uploadPath/$product->id";
        $this->productCatCross->deleteAllBy([
            'product' => $product->id
        ]);
        if($this->productImages->existByProduct($product->id)) {
            $images = $this->productImages->findAllByProduct(
                $product->id
            );
            foreach ($images as $image) {
                $thumbPath = "$productPath/thumb";
                $filePath = "$productPath/$image->server_name.$image->extension";
                $fileThumbPath = "$thumbPath/$image->server_name.$image->extension";
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                if (file_exists($fileThumbPath)) {
                    unlink($fileThumbPath);
                }
                $this->productImages->deleteAll([
                    'id' => $image->id
                ]);
            }
        }
        FileHelper::rmRec($productPath);
        $this->products->delete($product);
    }
}