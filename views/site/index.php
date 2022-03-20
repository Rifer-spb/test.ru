<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var array $cats  */
/** @var array $products  */
/** @var app\models\Forms\Home\SearchForm $model  */

$this->title = 'Витрина';

$css = <<< CSS

.product {
    border: 1px solid #cccccc;
    padding: 15px;
    border-radius: 5px;
}

.product .title {
    margin-bottom: 10px;
}

.product .title>a {
    font-size: 17px;
    color: #0185ad;
    text-decoration: none;
    font-weight: 500;
    line-height: 17px;
    display: block;
}

.product .category {
    display: flex;
    margin-bottom: 10px;
}

.product .category>div {
    width: 100%;
    text-align: center;
    font-size: 14px;
    padding: 5px;
    font-weight: 500;
}

.product .price {
    margin-bottom: 10px;
}

.product .price>a {
    font-size: 16px;
    padding: 7px;
    line-height: 16px;
}

.product .image {
    text-align: center;    
}

.product .image>a {
    padding: 3px;
    border: 1px solid #cccccc;
    display: inline-block;
    border-radius: 5px;
}

.product .image img {
    max-width: 200px;
    max-height: 200px;
}

CSS;
$this->registerCss($css, ["type" => "text/css"]);
 ?>
<div class="site-index">
    <h1><?=$this->title?></h1>
    <?php if(count($products)>0) { ?>
    <div class="filter">
        <?php $form = ActiveForm::begin([
            'method' => 'GET',
            'action' => '@web/site/index'
        ]); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'sort')->dropDownList([
                    0 => 'По умолчанию',
                    1 => 'По убыванию'
                ], [
                    'onchange' => 'this.form.submit()'
                ]); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'cat')->dropDownList(
                    ArrayHelper::map($cats,'id','name'),[
                        'prompt' => 'Категория',
                        'onchange' => 'this.form.submit()'
                    ]
                ); ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="products">
        <div class="row">
            <?php foreach ($products as $product) { ?>
                <?php $url = Url::to(['site/view','id' => $product['id']]); ?>
                <div class="col-sm-4">
                    <div class="product">
                        <div class="title">
                            <a href="<?=$url?>"><?=$product['name']?></a>
                        </div>
                        <div class="category">
                            <?php if(count($product['cats'])>0) { ?>
                                <?php foreach ($product['cats'] as $cat) { ?>
                                    <div style="background-color: <?=$cat['color']?>;"><?=$cat['name']?></div>
                                <?php } ?>
                            <?php } else { ?>
                                <div>Нет категории</div>
                            <?php } ?>
                        </div>
                        <div class="price">
                            <a href="<?=$url?>" class="btn btn-primary">Стоимость <?=$product['price']?></a>
                        </div>
                        <div class="image">
                            <a href="<?=$url?>">
                                <?php if($product['image']) { ?>
                                    <?=Html::img($product['image']['src']);?>
                                <?php } else { ?>
                                    <?=Html::img('@web/images/default.jpg');?>
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-sm-12">
                <p>Товаров не найдено</p>
            </div>
        </div>
    <?php } ?>
</div>
