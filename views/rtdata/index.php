<?php

use app\models\Rtdata;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RtdataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rtdatas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rtdata-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rtdata', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dep_name',
            'driver_name',
            'vehicle_name',
            'mil_plate',
            //'road_ticket',
            //'rt_date',
            //'main_fuel_st',
            //'main_fuel_in',
            //'main_fuel_out',
            //'main_fuel_end',
            //'main_fuel_type',
            //'starter_benzin',
            //'oil',
            //'mh_start',
            //'mh_end',
            //'mh',
            //'odom_start',
            //'odom_end',
            //'dist',
            //'cargo_lift_cnt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rtdata $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
