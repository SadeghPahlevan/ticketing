<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%usersubject}}".
 *
 * @property int $id
 * @property int $subject_id
 * @property int $user_id
 *
 * @property Subject $subject
 * @property User $user
 */
class Usersubject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usersubject}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'user_id'], 'required'],
            [['subject_id', 'user_id'], 'integer'],
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
            'subject_id' => Yii::t('app', 'Subject ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
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
    /*   static function get_user_subject(){
       $user = Yii::$app->user->id ;
       $sql = "select * from usersubject WHERE user_id = '$user'";
       return $user_subject = Yii::$app->db->createCommand($sql)->queryAll();
   }*/
    static function get_user_subject(){
        $user = Yii::$app->user->id ;
        $user_subject = Usersubject::find()
            ->where(['user_id' => $user])
            ->all();
        return $user_subject;
    }
    static function get_user_subject_rates($subject_id){
        $users = Usersubject::find()
            ->where(['subject_id' => $subject_id])
            ->all();
        return $users;
    }
}
