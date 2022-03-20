<?php

namespace app\models\Entities\Product;

/**
 * This is the model class for table "product_image".
 *
 * @property int $id
 * @property int|null $product
 * @property string|null $name
 * @property string|null $extension
 * @property string|null $server_name
 * @property int|null $size
 * @property int|null $default
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @param int $product
     * @param string $name
     * @param string $extension
     * @param string $server_name
     * @param int $size
     * @return ProductImage
     */
    public static function create(int $product, string $name, string $extension, string $server_name, int $size) : self {
        $model = new static();
        $model->product = $product;
        $model->name = $name;
        $model->extension = $extension;
        $model->server_name = $server_name;
        $model->size = $size;
        return $model;
    }

    /**
     * @param int $default
     */
    public function setDefault(int $default) : void {
        $this->default = $default;
    }
}
