<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entities\Product\ProductCat */

$this->title = 'Create Product Cat';
$this->params['breadcrumbs'][] = ['label' => 'Product Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
