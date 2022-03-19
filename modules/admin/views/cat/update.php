<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $cat app\models\Entities\Cat\Cat */
/* @var $model app\models\Forms\Module\Admin\Cat\UpdateForm */

$model->id = $cat->id;
$model->name = $cat->name;
$model->color = $cat->color;

$this->title = 'Редактирование категории: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
