<?php

namespace app\models\Helpers;

use Yii;
use yii\helpers\Html;

class ProductHelper
{
    /**
     * @param array $images
     * @return string
     */
    public static function getImagesListHtml(array $images) : string {
        $html ="";
        if(count($images)>0) {
            $productPath = Yii::getAlias('@product');
            foreach ($images as $key=>$image) {
                $default = $image->default;
                $imageID = $image->id;
                $productID = $image->product;
                $file = $image->server_name.'.'.$image->extension;
                $image = "$productPath/$productID/thumb/$file";
                $html .="<div class='image-item' data-id='$imageID'>";
                    $html .="<div class='image-item-top'>";
                        $html .="<div class='delete'>";
                            $html .="<a href='#'>x</a>";
                        $html .="</div>";
                        $html .="<div class='default'>";
                            $html .="<input type='radio' name='default'";
                            if($default) {
                                $html .="checked";
                            }
                            $html .=" value='$key'/> По умолчанию";
                        $html .="</div>";
                        $html .="<div class='clear'></div>";
                    $html .="</div>";
                    $html .="<div class='image-item-center'>";
                        $html.= Html::img("@web/$image");
                    $html .="</div>";
                $html .="</div>";
            }
        } else {
            $html .="Изображений не найдено";
        }
        return $html;
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getProductPath(int $id) : array {
        $productPath = Yii::getAlias('@product');
        return [
            'root' => "$productPath/$id",
            'thumb' => "$productPath/$id/thumb"
        ];
    }
}