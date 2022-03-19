<?php

use yii\helpers\Html;

/* @var $cats array */
/* @var $this yii\web\View */
/* @var $cats_checked array */
/* @var $product app\models\Entities\Product\Product */
/* @var $model app\models\Forms\Module\Admin\Product\UpdateForm */

$model->id = $product->id;
$model->cats = $cats_checked;
$model->name = $product->name;
$model->desc = $product->desc;
$model->price = $product->price;
$model->publish = $product->publish;

$this->title = 'Редактирование продукта: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats
    ]) ?>

</div>
