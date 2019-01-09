<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%stream}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int $subject_id
 * @property int $priority
 * @property int $status
 * @property string $created_at
 *
 * @property Rate[] $rates
 * @property Subject $subject
 * @property User $user
 * @property Ticket[] $tickets
 */
class Stream extends \yii\db\ActiveRecord
{
    const EMERGENCY = 1 ;
    const NORMAL = 2 ;


    const OPEN = 1 ;
    const FINISH = 2 ;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stream}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'subject_id', 'priority'], 'required'],
            [['user_id', 'subject_id', 'priority', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'priority' => Yii::t('app', 'Priority'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['stream_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['stream_id' => 'id']);
    }
    /* static function get_streams_user(){
   $user = Yii::$app->user->id ;
    $sql = "select * from stream WHERE user_id = '$user' ";
    return $users = Yii::$app->db->createCommand($sql)->queryAll();
} */
    static function get_streams_user(){
        $x = Yii::$app->user->id ;
        $users = Stream::find()
            ->where(['user_id' => $x])
            ->all();
        return $users;
    }

    /*  static function get_streams($subject_id){

          $sql = "select * from stream where subject_id = '$subject_id' ";
          return $streams = Yii::$app->db->createCommand($sql)->queryAll();
      } */

    static function get_streams($subject_id)
    {
        $streams = Stream::find()
            ->where(['subject_id' => $subject_id])
            ->all();
        return $streams;
    }
    static function get_streams_rates($id)
    {
        $stream = Stream::find()
            ->where(['id' => $id])
            ->one();
        return $stream;
    }
    static function get_stream_open(){
        $stream_open = Stream::find()
            ->where([ 'status' => 1 ])
            ->count();

        return $stream_open ;
    }
    static function get_stream_close(){
        $stream_close = Stream::find()
            ->where([ 'status' => 2 ])
            ->count();

        return $stream_close ;
    }
}
