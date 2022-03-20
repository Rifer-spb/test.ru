<?php

namespace app\modules\admin\controllers;

use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\Entities\Product\Product;
use app\models\ReadModels\Cat\CatReadRepository;
use app\models\Forms\Module\Admin\Product\CreateForm;
use app\models\Forms\Module\Admin\Product\UpdateForm;
use app\models\Forms\Module\Admin\Product\ProductSearch;
use app\models\UseCases\Module\Admin\Product\ProductService;
use app\models\ReadModels\Product\ProductCatCrossReadRepository;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    private $cats;
    private $service;
    private $catCross;

    public function __construct(
        $id,
        $module,
        ProductService $service,
        CatReadRepository $cats,
        ProductCatCrossReadRepository $catCross,
        $config = []
    ) {
        $this->cats = $cats;
        $this->service = $service;
        $this->catCross = $catCross;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritDoc
     */
    public function behaviors() : array {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index','view','create','update','delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index','view','create','update','delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate() {
        $form = new CreateForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $id = $this->service->add($form);
                return $this->redirect(['view', 'id' => $id]);
            } catch (\DomainException $e) {
                print $e->getMessage();
            }
        }
        return $this->render('create', [
            'model' => $form,
            'cats' => $this->cats->findAll()
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id) {
        $product = $this->findModel($id);
        $form = new UpdateForm();
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                print $e->getMessage();
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
            'cats' => $this->cats->findAll(),
            'cats_checked' => $this->catCross->findCatIDsByProduct(
                $product->id
            )
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
