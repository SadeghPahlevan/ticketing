<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ticket}}".
 *
 * @property int $id
 * @property int $stream_id
 * @property int $media_id
 * @property int $user_type
 * @property string $response
 * @property string $created_at
 *
 * @property Media $media
 * @property Stream $stream
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stream_id', 'user_type', 'response'], 'required'],
            [['stream_id', 'media_id', 'user_type'], 'integer'],
            [['response'], 'string'],
            [['created_at'], 'safe'],
            [['media_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['media_id' => 'id']],
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
            'media_id' => Yii::t('app', 'Media ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'response' => Yii::t('app', 'Response'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStream()
    {
        return $this->hasOne(Stream::className(), ['id' => 'stream_id']);
    }
    /* static function get_ticket($stream_id)
  {
      $sql = "select * from ticket where stream_id = '$stream_id' ";
      return $tickets = Yii::$app->db->createCommand($sql)->queryAll();
  } */
    static function get_ticket($stream_id)
    {
        $tickets = Ticket::find()
            ->where(['stream_id' => $stream_id])
            ->all();
        return $tickets;
    }
}
