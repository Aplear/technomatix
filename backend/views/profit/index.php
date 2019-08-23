<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProfitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'owner_id',
            'product_id',
            'value',
            'created_at:date',
        ],
    ]); ?>

</div>
