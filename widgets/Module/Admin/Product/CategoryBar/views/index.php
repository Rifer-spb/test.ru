<?php
/* @var $this yii\web\View */
/* @var $cats array */
$width = 100/count($cats);
?>
<?php if(count($cats)>0) { ?>
    <div class='product-category-bar'>
        <?php foreach ($cats as $cat) { ?>
            <div style="background-color:<?=$cat->color?>;width:<?=$width?>%">
                <?=$cat->name?>
            </div>
        <?php } ?>
    </div>
<?php } ?>