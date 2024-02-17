<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Rtdata $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rtdata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dep_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vehicle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mil_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'road_ticket')->textInput() ?>

    <?= $form->field($model, 'rt_date')->textInput() ?>

    <?= $form->field($model, 'main_fuel_st')->textInput() ?>

    <?= $form->field($model, 'main_fuel_in')->textInput() ?>

    <?= $form->field($model, 'main_fuel_out')->textInput() ?>

    <?= $form->field($model, 'main_fuel_end')->textInput() ?>

    <?= $form->field($model, 'main_fuel_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starter_benzin')->textInput() ?>

    <?= $form->field($model, 'oil')->textInput() ?>

    <?= $form->field($model, 'mh_start')->textInput() ?>

    <?= $form->field($model, 'mh_end')->textInput() ?>

    <?= $form->field($model, 'mh')->textInput() ?>

    <?= $form->field($model, 'odom_start')->textInput() ?>

    <?= $form->field($model, 'odom_end')->textInput() ?>

    <?= $form->field($model, 'dist')->textInput() ?>

    <?= $form->field($model, 'cargo_lift_cnt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
