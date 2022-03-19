<?php

use yii\helpers\Html;

/* @var $cats array */
/* @var $this yii\web\View */
/* @var $model app\models\Forms\Module\Admin\Product\CreateForm */

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
