<?php

namespace app\modules\admin\controllers\widgets\product;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\Helpers\ProductHelper;
use app\models\Entities\Product\ProductImage;
use app\models\ReadModels\Product\ProductImageReadRepository;
use app\models\Forms\Widgets\Module\Admin\Product\UploadImage\UploadForm;
use app\models\UseCases\Widgets\Module\Admin\Product\UploadImage\UploadImageService;

class UploadImageController extends Controller
{
    private $images;
    private $service;

    public function __construct(
        $id,
        $module,
        UploadImageService $service,
        ProductImageReadRepository $images,
        $config = []
    ) {
        $this->images = $images;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors() : array {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['upload','delete','set-default'],
                'rules' => [
                    [
                        'roles' => ['@'],
                        'allow' => true,
                        'actions' => ['upload','delete','set-default']
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array|string
     * @throws \Exception
     */
    public function actionUpload() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $form = new UploadForm();
        $form->file = UploadedFile::getInstance($form, 'file');
        if($form->load($this->request->post())) {
            if(!$form->validate()) {
                return [
                    'error' => ActiveForm::validate($form)
                ];
            } else {
                try {
                    $this->service->upload($form);
                    return ['html' => ProductHelper::getImagesListHtml(
                        $this->images->findAllByProduct($form->id)
                    )];
                } catch (\DomainException $e) {
                    return $e->getMessage();
                }
            }
        }
    }

    /**
     * @param $id
     * @return array|string
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $image = $this->findModel($id);
        try {
            $this->service->delete($image);
            return ['html' => ProductHelper::getImagesListHtml(
                $this->images->findAllByProduct($image->product)
            )];
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return array|string
     * @throws NotFoundHttpException
     */
    public function actionSetDefault($id) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $image = $this->findModel($id);
        try {
            $this->service->setDefault($image);
            return ['html' => ProductHelper::getImagesListHtml(
                $this->images->findAllByProduct($image->product)
            )];
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return ProductImage|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id) {
        if (!$model = ProductImage::findOne($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }
}