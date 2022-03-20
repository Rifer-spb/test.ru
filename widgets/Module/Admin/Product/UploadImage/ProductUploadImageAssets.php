<?php

namespace app\widgets\Module\Admin\Product\UploadImage;

use yii\web\AssetBundle;

class ProductUploadImageAssets extends AssetBundle
{
    public $baseUrl = '@web';
    public $css = [
        'widgets/module/admin/product/upload-image/style.css',
    ];
    public $js = [
        'widgets/module/admin/product/upload-image/script.js',
    ];
}