<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\Entities\Product\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Forms\Module\Admin\Product\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            [
                'attribute' => 'publish',
                'filter' => [
                    Product::STATUS_PUBLISH_OFF => 'Нет',
                    Product::STATUS_PUBLISH_ON => 'Да'
                ],
                'value' => function ($model) {
                    if($model->publish == Product::STATUS_PUBLISH_OFF) {
                        return 'Нет';
                    } elseif($model->publish == Product::STATUS_PUBLISH_ON) {
                        return 'Да';
                    }
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
