<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rtdata".
 *
 * @property int $id
 * @property string|null $dep_name
 * @property string|null $driver_name
 * @property string|null $vehicle_name
 * @property string|null $mil_plate
 * @property float|null $road_ticket
 * @property string|null $rt_date
 * @property float|null $main_fuel_st
 * @property float|null $main_fuel_in
 * @property float|null $main_fuel_out
 * @property float|null $main_fuel_end
 * @property string|null $main_fuel_type
 * @property float|null $starter_benzin
 * @property float|null $oil
 * @property float|null $mh_start
 * @property float|null $mh_end
 * @property float|null $mh
 * @property float|null $odom_start
 * @property float|null $odom_end
 * @property float|null $dist
 * @property float|null $cargo_lift_cnt
 */
class Rtdata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rtdata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['road_ticket', 'main_fuel_st', 'main_fuel_in', 'main_fuel_out', 'main_fuel_end', 'starter_benzin', 'oil', 'mh_start', 'mh_end', 'mh', 'odom_start', 'odom_end', 'dist', 'cargo_lift_cnt'], 'number'],
            [['rt_date'], 'safe'],
            [['dep_name', 'driver_name', 'vehicle_name'], 'string', 'max' => 255],
            [['mil_plate', 'main_fuel_type'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dep_name' => 'Dep Name',
            'driver_name' => 'Driver Name',
            'vehicle_name' => 'Vehicle Name',
            'mil_plate' => 'Mil Plate',
            'road_ticket' => 'Road Ticket',
            'rt_date' => 'Rt Date',
            'main_fuel_st' => 'Main Fuel St',
            'main_fuel_in' => 'Main Fuel In',
            'main_fuel_out' => 'Main Fuel Out',
            'main_fuel_end' => 'Main Fuel End',
            'main_fuel_type' => 'Main Fuel Type',
            'starter_benzin' => 'Starter Benzin',
            'oil' => 'Oil',
            'mh_start' => 'Mh Start',
            'mh_end' => 'Mh End',
            'mh' => 'Mh',
            'odom_start' => 'Odom Start',
            'odom_end' => 'Odom End',
            'dist' => 'Dist',
            'cargo_lift_cnt' => 'Cargo Lift Cnt',
        ];
    }
}
