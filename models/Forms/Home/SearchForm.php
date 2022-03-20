<?php

namespace app\models\Forms\Home;

use yii\base\Model;
use yii\helpers\Url;
use app\models\Entities\Cat\Cat;
use app\models\Helpers\ArrayHelper;
use app\models\Helpers\ProductHelper;
use app\models\Entities\Product\Product;
use app\models\Entities\Product\ProductImage;

class SearchForm extends Model
{
    public $cat;
    public $sort;

    public function rules()
    {
        return [
            ['cat','integer'],
            ['cat','exist','targetClass' => Cat::class,'targetAttribute' => ['cat' => 'id']],
            ['sort','integer', 'max' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cat' => 'Категория',
            'sort' => 'Сортировка'
        ];
    }

    /**
     * @return array
     */
    public function search() : array {
        $query = Product::find();
        $query->alias('p');
        $query->joinWith('catCross c');
        $query->where(['p.publish' => 1]);
        if($this->cat) {
            $query->andWhere(['c.cat' => $this->cat]);
        }
        if($this->sort) {
            $query->orderBy('p.id DESC');
        } else {
            $query->orderBy('p.id ASC');
        }
        $query->asArray();
        $queryProducts = $query->all();
        $products = [];
        if(count($queryProducts)>0) {
            $productIDs = array_column($queryProducts,'id');
            $cats = Cat::find()
                ->where('id IN (SELECT cat FROM product_cat_cross WHERE product IN ('.implode(',',$productIDs).') GROUP BY cat)')
                ->asArray()
                ->all();
            $cats = ArrayHelper::getKeyArray($cats,'id');
            $images = ProductImage::find()->where([
                'AND',
                ['IN','product',$productIDs],
                ['default' => 1]
            ])->asArray()->all();
            $images = ArrayHelper::getKeyArray($images,'product');
            foreach ($queryProducts as $key=>$queryProduct) {
                $products[$key] = [
                    'id' => $queryProduct['id'],
                    'name' => $queryProduct['name'],
                    'desc' => $queryProduct['desc'],
                    'price' => $queryProduct['price']
                ];
                $productCats = [];
                foreach ($queryProduct['catCross'] as $catCross) {
                    $productCats[] = $cats[$catCross['cat']];
                }
                $products[$key]['cats'] = $productCats;
                $image = null;
                if(array_key_exists($queryProduct['id'],$images)) {
                    $productPath = ProductHelper::getProductPath($queryProduct['id']);
                    $productImage = $images[$queryProduct['id']];
                    $imageFile = $productImage['server_name'].'.'.$productImage['extension'];
                    $imagePath = Url::to('@web/'.$productPath['thumb'].'/'.$imageFile);
                    $image = [
                        'id' => $productImage['id'],
                        'src' => $imagePath
                    ];
                }
                $products[$key]['image'] = $image;
            }
        }
        return $products;
    }
}