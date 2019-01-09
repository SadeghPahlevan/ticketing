<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%rate}}".
 *
 * @property int $id
 * @property int $stream_id
 * @property string $text
 * @property int $rate
 *
 * @property Stream $stream
 */
class Rate extends \yii\db\ActiveRecord
{
    const BAD = 1 ;
    const NORMAL = 2 ;
    const EXCELLENT = 3 ;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stream_id', 'rate'], 'required'],
            [['stream_id', 'rate'], 'integer'],
            [['text'], 'string'],
            [['stream_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stream::className(), 'targetAttribute' => ['stream_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'stream_id' => Yii::t('app', 'Stream ID'),
            'text' => Yii::t('app', 'Text'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStream()
    {
        return $this->hasOne(Stream::className(), ['id' => 'stream_id']);
    }
    static function get_rate(){
        $rate = Rate::find()
            ->all();
        return $rate;
    }
}
