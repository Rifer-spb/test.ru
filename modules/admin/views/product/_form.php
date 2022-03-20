<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use app\models\Entities\Cat\Cat;
use app\models\Entities\Product\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Entities\Product\Product */
/* @var $cats array */
/* @var $form yii\widgets\ActiveForm */

$css= <<< CSS
.product-form #createform-cats label,
.product-form #updateform-cats label {
    margin-right: 10px;
}
.product-form #createform-cats label>span,
.product-form #updateform-cats label>span {
    width: 10px; 
    height: 10px; 
    display: inline-block; 
    vertical-align: middle;
}
CSS;
$this->registerCss($css, ["type" => "text/css"], "myStyles" );
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

    <?php if(count($cats)>0) { ?>
        <?= $form->field($model, 'cats')->checkboxList(
            ArrayHelper::map($cats,'id','name'), [
             'item' => function ($index, $label, $name, $checked, $value) {
                $cat = Cat::findOne($value);
                $html = "<label>";
                    $html .="<input type='checkbox' name='$name' value='$value'";
                    if($checked) {
                        $html .="checked";
                    }
                    $html .="/>$label";
                    $html .="<span style='background-color: $cat->color;'>&nbsp;</span>";
                $html .="</label>";
                return $html;
            }]
        ) ?>
    <?php } ?>

    <?=$form->field($model, 'publish')->checkbox([
        'value' => Product::STATUS_PUBLISH_ON
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
