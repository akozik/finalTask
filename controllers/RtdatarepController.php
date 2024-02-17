<?php

namespace app\controllers;


use yii\web\Controller;

use app\models\DynamicModel;

class RtdatarepController extends Controller
{
    public function actionDorlist()
    {
        $sql = 'SELECT dep_name,
                       vehicle_name,
                       mil_plate,
                       road_ticket,
                       min(rt_date) as fromdate,
                       max(rt_date) as todate,
                       /*(select [main_fuel_st] from 
                                (
                                select [main_fuel_st], RANK() over (partition by b.[road_ticket] order by b.[rt_date]) as rt_main_fuel
                                from [dbo].rtdata$ as b 
                                where b.[road_ticket]=a.road_ticket
                                ) as c
                            where c.rt_main_fuel=1)*/ 
                            1 as rt_main_fuel_st,
                        sum(main_fuel_in) as tot_main_fuel_in,
                        sum(main_fuel_out) as tot_main_fuel_out,
                        /*(select [main_fuel_st] from 
                                (
                                select [main_fuel_st], RANK() over (partition by b.[road_ticket] order by b.[rt_date] desc) as rt_main_fuel
                                from rtdata as b 
                                where b.[road_ticket]=a.road_ticket
                                ) as c
                            where c.rt_main_fuel=1)*/
                            1 as rt_main_fuel_end,
                        main_fuel_type,
                        sum(starter_benzin) as tot_starter_benzin,
                        sum(oil) as tot_oil,
                        min(mh_start) as rt_mh_start,
                        max(mh_end) as rt_mh_end,
                        sum(mh) as tot_mh,
                        min(odom_start) as rt_odom_start,
                        max(odom_end) as rt_odom_end,
                        sum(dist) as tot_dist,
                        sum(cargo_lift_cnt) as tot_cargo_lift_cnt
                    from rtdata as a
                    where road_ticket >0 and (main_fuel_in>0 or main_fuel_out>0)
                    group by dep_name
                        ,vehicle_name
                        ,mil_plate
                        ,road_ticket
                        ,main_fuel_type';
        $data = \Yii::$app->db->createCommand($sql)->queryAll();

        $models = [];
        foreach ($data as $row) {
            $model = new RtdataModel();
            $model->attributes = $row;
            $models[] = $model;
        }


        return $this->render('rtdatareps', ['models' => $models]);
    }


    public function actionTechlist()
    {
        $sql = "select 
                dep_name,
                vehicle_name,
                mil_plate,
                min(mh_start) as rt_mh_start,
                min(odom_start) as rt_odom_start,
                (
                    select sum(b.mh)
                    from rtdata as b
                    where b.mil_plate=a.mil_plate
                    and b.rt_date>='20231119' and b.rt_date<'20231221'
                ) as tot_mh_2023_12,
                (
                    select sum(b.mh)
                    from rtdata as b
                    where b.mil_plate=a.mil_plate
                    and b.rt_date>='20231221' and b.rt_date<'20240121'
                ) as tot_mh_2024_01,
                (
                    select sum(b.dist)
                    from rtdata as b
                    where b.mil_plate=a.mil_plate
                    and b.rt_date>='20231119' and b.rt_date<'20231221'
                ) as tot_dist_2023_12,
                (
                    select sum(b.dist)
                    from rtdata as b
                    where b.mil_plate=a.mil_plate
                    and b.rt_date>='20231221' and b.rt_date<'20240121'
                )as tot_dist_2024_01,
                sum(mh) as tot_mh,
                sum(dist) as tot_dist,
                max(mh_end) as rt_mh_end,
                max(odom_end) as rt_odom_end
            from rtdata as a
            where road_ticket >0 and (main_fuel_in>0 or main_fuel_out>0)
            and rt_date>='20231119' and rt_date<'20240121'
        group by dep_name,
                 vehicle_name,
                 mil_plate";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();

        $models = [];
        foreach ($data as $row) {
            $model = new DynamicModel();
            $model->addAttributesDynamically($row);

            var_dump($model);
            //$model->attributes = $row;
            $models[] = $model;
        }

        var_dump($models);


        return $this->render('rtdatareps', ['models' => $models]);
    }
}
?>