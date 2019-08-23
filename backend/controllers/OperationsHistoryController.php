<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use backend\models\search\OperationsHistorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * OperationsHistoryController implements the CRUD actions for OperationsHistory model.
 */
class OperationsHistoryController extends Controller
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
                        'actions' => ['index'],
                        'roles' => ['operationsHistory']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all OperationsHistory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OperationsHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $usersFilter = User::getActiveUsersByRoles([User::ROLE_ADMINISTRATOR, User::ROLE_MANAGER]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'usersFilter' => $usersFilter
        ]);
    }
}
