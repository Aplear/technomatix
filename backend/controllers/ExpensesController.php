<?php

namespace backend\controllers;

use backend\components\events\OperationsHistoryEvent;
use backend\models\Products;
use Yii;
use backend\models\Expenses;
use backend\models\search\ExpensesSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class ExpensesController extends Controller
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
                        'roles' => ['createExpenses']
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
     * Lists all Expenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpensesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Expenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expenses();

        if ($model->load(Yii::$app->request->post()) &&  $model->save()) {
            $event = new OperationsHistoryEvent();
            $event->operation = 'Added product';
            $model->trigger(Expenses::EVENT_SAVE_HISTORY, $event);
            return $this->redirect(['index']);
        }

        $products = ArrayHelper::map(Products::findAll([Products::tableName() . '.status' => Products::STATUS_ACTIVE]), 'id', 'title');

        return $this->render('create', [
            'model' => $model,
            'products' => $products
        ]);
    }
}
