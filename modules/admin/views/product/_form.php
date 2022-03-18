<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use app\models\Entities\Product\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Entities\Product\Product */
/* @var $cats array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-9">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'desc')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'cats')->checkboxList(
                ArrayHelper::map($cats,'id','name')
            ) ?>
        </div>
    </div>

    <?=$form->field($model, 'publish')->checkbox([ 'value' => Product::STATUS_PUBLISH_ON]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
