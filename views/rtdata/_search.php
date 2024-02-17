<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RtdataSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rtdata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dep_name') ?>

    <?= $form->field($model, 'driver_name') ?>

    <?= $form->field($model, 'vehicle_name') ?>

    <?= $form->field($model, 'mil_plate') ?>

    <?php // echo $form->field($model, 'road_ticket') ?>

    <?php // echo $form->field($model, 'rt_date') ?>

    <?php // echo $form->field($model, 'main_fuel_st') ?>

    <?php // echo $form->field($model, 'main_fuel_in') ?>

    <?php // echo $form->field($model, 'main_fuel_out') ?>

    <?php // echo $form->field($model, 'main_fuel_end') ?>

    <?php // echo $form->field($model, 'main_fuel_type') ?>

    <?php // echo $form->field($model, 'starter_benzin') ?>

    <?php // echo $form->field($model, 'oil') ?>

    <?php // echo $form->field($model, 'mh_start') ?>

    <?php // echo $form->field($model, 'mh_end') ?>

    <?php // echo $form->field($model, 'mh') ?>

    <?php // echo $form->field($model, 'odom_start') ?>

    <?php // echo $form->field($model, 'odom_end') ?>

    <?php // echo $form->field($model, 'dist') ?>

    <?php // echo $form->field($model, 'cargo_lift_cnt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
