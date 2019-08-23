<?php

namespace backend\controllers;

use backend\components\events\OperationsHistoryEvent;
use backend\models\Products;
use Yii;
use backend\models\Profit;
use backend\models\search\ProfitSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * ProfitController implements the CRUD actions for Profit model.
 */
class ProfitController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'index'],
                        'roles' => ['createProfit']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Profit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $event = new OperationsHistoryEvent();
            $event->operation = 'Added profit';
            $model->trigger(Profit::EVENT_SAVE_HISTORY, $event);
            return $this->redirect(['index']);
        }

        $products = ArrayHelper::map(Products::findAll([Products::tableName() . '.status' => Products::STATUS_ACTIVE]), 'id', 'title');

        return $this->render('create', [
            'model' => $model,
            'products' => $products
        ]);
    }
}
