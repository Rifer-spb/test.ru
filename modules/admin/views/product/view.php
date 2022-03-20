<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Module\Admin\Product\CategoryBar\ProductCategoryBar;
use app\widgets\Module\Admin\Product\UploadImage\ProductUploadImage;

/* @var $this yii\web\View */
/* @var $model app\models\Entities\Product\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
        if ($this->beginCache("product-category-bar-$model->id",['duration' => 60])) {
            print ProductCategoryBar::widget(['id' => $model->id]);
            $this->endCache();
        }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'desc',
            'price',
            'publish',
        ],
    ]) ?>
    <?= ProductUploadImage::widget(['id' => $model->id]) ?>
</div>
