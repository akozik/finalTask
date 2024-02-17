<?php

namespace app\models;

use yii\base\Model;

class DynamicModel extends RtdataModel{

    public function addAttributesDynamically(array $selectedFields)
    {
        foreach ($selectedFields as $field=>$value) {

            $this->addRule([$field], 'safe');

            // Динамічно додаємо атрибут, якщо його ще не існує
            if (!property_exists($this, $field)) {
                $this->$field = $value;
            }
        }
    }


}


?>