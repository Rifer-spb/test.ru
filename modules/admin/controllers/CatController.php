<?php

namespace app\modules\admin\controllers;

use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Entities\Cat\Cat;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use app\models\Forms\Module\Admin\Cat\CatSearch;
use app\models\Forms\Module\Admin\Cat\CreateForm;
use app\models\Forms\Module\Admin\Cat\UpdateForm;
use app\models\UseCases\Module\Admin\Cat\CatService;

/**
 * CatController implements the CRUD actions for Cat model.
 */
class CatController extends Controller
{
    private $service;

    public function __construct($id, $module, CatService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritDoc
     */
    public function behaviors() {
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
     * Lists all Cat models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new CatSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cat model.
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
        if ($form->load($this->request->post()) and $form->validate()) {
            try {
                $id = $this->service->add($form);
                return $this->redirect(['view', 'id' => $id]);
            } catch (\DomainException $e) {
                print $e->getMessage();
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id) {
        $cat = $this->findModel($id);
        $model = new UpdateForm();
        if ($model->load($this->request->post()) and $model->validate()) {
            try {
                $this->service->edit($cat,$model);
                return $this->redirect(['view', 'id' => $cat->id]);
            } catch (\DomainException $e) {
                print $e->getMessage();
            }
        }
        return $this->render('update', [
            'model' => $model,
            'cat' => $cat
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Cat|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id) : ?Cat {
        if (!$model = Cat::findOne($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }
}
