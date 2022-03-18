<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entities\Product\ProductCat */

$this->title = 'Update Product Cat: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
