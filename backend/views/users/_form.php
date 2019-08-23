<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput()?>
    <?= $form->field($model, 'email')->textInput()?>
    <?= $form->field($model, 'password')->textInput()?>
    <?= $form->field($model, 'role')->widget(Select2::class, [
        'data' => \Yii::$app->params['rolesArray'],
        'options' => ['placeholder' => 'Select a role...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'status')->widget(Select2::class, [
        'data' => User::getStatusArray(),
        'options' => ['placeholder' => 'Select a status...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
