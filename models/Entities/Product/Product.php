<?php

namespace app\models\Entities\Product;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $desc
 * @property int|null $price
 * @property int|null $publish
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISH_ON = 1;
    const STATUS_PUBLISH_OFF = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'desc' => 'Описание',
            'price' => 'Цена',
            'publish' => 'Публикация',
        ];
    }

    /**
     * @param string $name
     * @param string $desc
     * @param int $price
     * @param int $publish
     * @return Product
     */
    public static function create(string $name, string $desc, int $price, int $publish = 0) : self {
        $model = new static();
        $model->name = $name;
        $model->desc = $desc;
        $model->price = $price;
        $model->publish = $publish;
        return $model;
    }

    /**
     * @param string $name
     * @param string $desc
     * @param int $price
     * @param int $publish
     */
    public function edit(string $name, string $desc, int $price, int $publish) : void {
        $this->name = $name;
        $this->desc = $desc;
        $this->price = $price;
        $this->publish = $publish;
    }

    /**
     * @param int $publish
     */
    public function publish(int $publish) : void {
        $this->publish = $publish;
    }
}
