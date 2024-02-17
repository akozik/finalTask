<?php

use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = 'Щомісячна агрегація за дорожніми листами';
$this->params['breadcrumbs'][] = $this->title;


use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

echo GridView::widget([
    'dataProvider' =>new \yii\data\ArrayDataProvider(['allModels' => $models]),
]);


/*

echo DetailView::widget([
    'models' => $models,
    'attributes' => [
        'dep_name',
        'vehicle_name',
        'mil_plate',
        'road_ticket',
        'fromdate',
        'todate',
        'rt_main_fuel_st',
        'tot_main_fuel_in',
        'tot_main_fuel_out',
        'rt_main_fuel_end',
        'main_fuel_type',
        'tot_starter_benzin',
        'tot_oil',
        'rt_mh_start',
        'rt_mh_end',
        'tot_mh',
        'rt_odom_start',
        'rt_odom_end',
        'tot_dist',
        'tot_cargo_lift_cnt',
    ],
]);
*/
