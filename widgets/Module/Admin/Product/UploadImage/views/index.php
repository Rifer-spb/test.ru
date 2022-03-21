<?php

use app\models\Helpers\ProductHelper;

/* @var $this yii\web\View */
/* @var $images array */
/* @var $id int */

?>
<div class='product-upload-image'>
    <label>Загрузка изображений</label>
    <div class='row'>
        <div class='col-sm-4'>
            <div class='action'>
                <button class='btn btn-primary'>Загрузить изображение (1мб)</button>
                <input type='file' multiple data-id='<?=$id?>'>
            </div>
            <div class="progress-wrap">
                <div class='progress'>
                    <div class='progress-bar-warning progress-bar' role='progressbar' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' style='width: 0;'></div>
                </div>
                <a class="abort" href="#">x</a>
            </div>
            <p class='error'></p>
        </div>
        <div class='col-sm-8'>
            <?php if(count($images)>0) { ?>
                <div class='image-list'>
                    <?=ProductHelper::getImagesListHtml($images)?>
                </div>
            <?php } else { ?>
                <div class='image-list'>Изображений не найдено</div>
            <?php } ?>
        </div>
    </div>
</div>