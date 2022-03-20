<?php

namespace app\models\UseCases\Widgets\Module\Admin\Product\UploadImage;

use Yii;
use yii\imagine\Image;
use app\models\Helpers\FileHelper;
use app\models\Entities\Product\ProductImage;
use app\models\Repositories\Product\ProductImageRepository;
use app\models\Forms\Widgets\Module\Admin\Product\UploadImage\UploadForm;

class UploadImageService
{
    private $repository;

    public function __construct(ProductImageRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param UploadForm $form
     * @throws \Exception
     */
    public function upload(UploadForm $form) : void {
        $uploadPath = Yii::getAlias('@product');
        $productPath = "$uploadPath/$form->id";
        $thumbPath = "$productPath/thumb";
        FileHelper::createFolder($productPath,0777);
        FileHelper::createFolder($thumbPath,0777);
        $file = $form->file;
        do {
            $server_name = FileHelper::generateRandomStr();
            $e = ProductImage::find()->where([
                'product' => $form->id,
                'server_name' => $server_name
            ])->exists();
        } while($e);
        $image = ProductImage::create(
            $form->id,
            $file->baseName,
            $file->extension,
            $server_name,
            $file->size
        );
        if(!$this->repository->existByProduct($form->id)) {
            $image->setDefault(1);
        }
        $filePath = "$productPath/$server_name.$file->extension";
        $fileThumbPath = "$thumbPath/$server_name.$file->extension";
        if(!$file->saveAs($filePath)) {
            throw new \DomainException('File save error.');
        }
        Image::resize($filePath, 600, 800)->save($filePath, ['quality' => 80]);
        Image::crop($filePath, 200, 200)->save($fileThumbPath, ['quality' => 80]);
        $this->repository->save($image);
    }

    /**
     * @param ProductImage $image
     * @throws \yii\db\StaleObjectException
     */
    public function delete(ProductImage $image) : void {
        $uploadPath = Yii::getAlias('@product');
        $productPath = "$uploadPath/$image->product";
        $thumbPath = "$productPath/thumb";
        $filePath = "$productPath/$image->server_name.$image->extension";
        $fileThumbPath = "$thumbPath/$image->server_name.$image->extension";
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        if (file_exists($fileThumbPath)) {
            unlink($fileThumbPath);
        }
        $this->repository->delete($image);
    }

    /**
     * @param ProductImage $image
     */
    public function setDefault(ProductImage $image) : void {
        $this->repository->updateAll(
            ['default' => 0],
            ['product' => $image->product]
        );
        $image->setDefault(1);
        $this->repository->save($image);
    }

}