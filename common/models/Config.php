<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $variable
 * @property string $value
 * @property int $status
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'variable', 'value'], 'required'],
            [['id', 'user_id', 'status'], 'integer'],
            [['value'], 'string'],
            [['type', 'variable'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'user_id' => 'شناسه کاربر',
            'type' => 'نوع',
            'variable' => 'نام',
            'value' => 'مقدار',
            'status' => 'اولویت',
        ];
    }
}
