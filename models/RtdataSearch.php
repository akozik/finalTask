<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rtdata;

/**
 * RtdataSearch represents the model behind the search form of `app\models\Rtdata`.
 */
class RtdataSearch extends Rtdata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['dep_name', 'driver_name', 'vehicle_name', 'mil_plate', 'rt_date', 'main_fuel_type'], 'safe'],
            [['road_ticket', 'main_fuel_st', 'main_fuel_in', 'main_fuel_out', 'main_fuel_end', 'starter_benzin', 'oil', 'mh_start', 'mh_end', 'mh', 'odom_start', 'odom_end', 'dist', 'cargo_lift_cnt'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Rtdata::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'road_ticket' => $this->road_ticket,
            'rt_date' => $this->rt_date,
            'main_fuel_st' => $this->main_fuel_st,
            'main_fuel_in' => $this->main_fuel_in,
            'main_fuel_out' => $this->main_fuel_out,
            'main_fuel_end' => $this->main_fuel_end,
            'starter_benzin' => $this->starter_benzin,
            'oil' => $this->oil,
            'mh_start' => $this->mh_start,
            'mh_end' => $this->mh_end,
            'mh' => $this->mh,
            'odom_start' => $this->odom_start,
            'odom_end' => $this->odom_end,
            'dist' => $this->dist,
            'cargo_lift_cnt' => $this->cargo_lift_cnt,
        ]);

        $query->andFilterWhere(['like', 'dep_name', $this->dep_name])
            ->andFilterWhere(['like', 'driver_name', $this->driver_name])
            ->andFilterWhere(['like', 'vehicle_name', $this->vehicle_name])
            ->andFilterWhere(['like', 'mil_plate', $this->mil_plate])
            ->andFilterWhere(['like', 'main_fuel_type', $this->main_fuel_type]);

        return $dataProvider;
    }
}
