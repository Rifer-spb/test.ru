<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Forms\Module\Admin\Cat\CreateForm */

$this->title = 'Создание новой категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
