<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entities\Product\Product */
/* @var $cats array */

$this->title = 'Создание';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats
    ]) ?>

</div>
