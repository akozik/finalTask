<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Rtdata $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rtdatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rtdata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dep_name',
            'driver_name',
            'vehicle_name',
            'mil_plate',
            'road_ticket',
            'rt_date',
            'main_fuel_st',
            'main_fuel_in',
            'main_fuel_out',
            'main_fuel_end',
            'main_fuel_type',
            'starter_benzin',
            'oil',
            'mh_start',
            'mh_end',
            'mh',
            'odom_start',
            'odom_end',
            'dist',
            'cargo_lift_cnt',
        ],
    ]) ?>

</div>
