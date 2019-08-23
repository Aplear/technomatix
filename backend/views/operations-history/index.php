<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OperationsHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var \yii\db\ActiveRecord $usersFilter */

$usersFilterArray = \yii\helpers\ArrayHelper::map($usersFilter, 'id', 'username');

$this->title = 'Operations Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operations-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Operations History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'owner_id',
                'value' => function($model) {
                    return $model->owner_id;
                },
                'format' => 'raw',
                'filter'=> $usersFilterArray
            ],
            'model',
            'model_id',
            'operation',
            'created_at:date',
        ],
    ]); ?>



</div>
