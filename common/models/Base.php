<?php

namespace common\models;

use Yii;
use common\models\Test;
/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $name
 * @property string $family
 * @property string $city
 */
class Base extends \yii\db\ActiveRecord {

    public static function insertInToDb ($model , $row) {
        foreach ($row as $index => $column){
            $model->$index = $column;
        }
        $model->save();
        return $model;
    }

    public static function upredateOne ($model , $condition , $variables) {

    }


}
