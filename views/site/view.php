<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Helpers\ProductHelper;

/** @var yii\web\View $this */
/** @var app\models\Entities\Product\Product $product */

$this->title = $product->name;
$this->params['breadcrumbs'][] = $this->title;

$css = <<< CSS
.product .category {
    display: flex;
    margin-bottom: 20px;
}
.product .category>div {
    width: 100%;
    padding: 5px;
    text-align: center;
}
.product .image-preview {
    text-align: center;
}
.product .image-preview img {
    max-width: 200px;
    max-height: 200px;
    padding: 3px;
    border: 1px solid #cccccc;
    display: inline-block;
    border-radius: 5px;
}
.product .images {
    padding-bottom: 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #cccccc;
}
.product .price {
    margin-bottom: 20px;
    font-weight: 500;
}
CSS;
$this->registerCss($css, ["type" => "text/css"]);
$catCross = $product->catCross;
$images = $product->images;
$imageDefault = $product->imageDefault;
$publicPath = ProductHelper::getProductPath(
    $product->id
);
?>
<div class="site-view">
    <h1><?=$this->title?></h1>
    <div class="product">
        <div class="row">
            <div class="col-sm-4">
                <div class="category">
                    <?php if(count($catCross)>0) { ?>
                        <?php foreach ($catCross as $cross) { $catItem = $cross->catItem; ?>
                            <div style="background-color: <?=$catItem->color?>;">
                                <?=$catItem->name?>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        Нет категории
                    <?php } ?>
                </div>
                <div class="image-preview">
                    <?php if(!$imageDefault) { ?>
                        <?=Html::img('@web/images/default.jpg');?>
                    <?php } else { ?>
                        <?=Html::img('@web/'.$publicPath['thumb'].'/'.$imageDefault->server_name.'.'.$imageDefault->extension);?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-8">
                <?php if(count($images)>0) { ?>
                    <?php
                    $items = [];
                    foreach ($images as $image) {
                        $file = Url::to('@web/'.$publicPath['root'].'/'.$image->server_name.'.'.$image->extension);
                        $thumb = Url::to('@web/'.$publicPath['thumb'].'/'.$image->server_name.'.'.$image->extension);
                        $size = getimagesize(Url::to('@app/web/'.$publicPath['root'].'/'.$image->server_name.'.'.$image->extension));
                        $items[] = [
                            'image' => $file,
                            'thumb' => $thumb,
                            'size' => $size[0].'x'.$size[1]
                        ];
                    }
                    ?>
                    <div class="images">
                        <?=\powerkernel\photoswipe\Gallery::widget(['items' => $items])?>
                    </div>
                <?php } ?>
                <div class="price">Стоимость: <?=$product->price?></div>
                <?php if(!empty($product->desc)) { ?>
                    <div class="desc">
                        <?= $product->desc ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
