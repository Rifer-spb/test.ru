<?php

namespace app\widgets\Product;

use yii\web\AssetBundle;

class ProductCategoryBarAssets extends AssetBundle
{
    public $baseUrl = '@web';
    public $css = [
        'widgets/product/category-bar/style.css',
    ];
}