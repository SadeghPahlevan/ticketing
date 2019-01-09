<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_subject".
 *
 * @property int $user_id
 * @property int $subject_id
 * @property string $created_at
 *
 * @property Subject $subject
 * @property User $user
 */
class UserSubject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subject_id'], 'required'],
            [['user_id', 'subject_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_id', 'subject_id'], 'unique', 'targetAttribute' => ['user_id', 'subject_id']],
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
            'user_id' => Yii::t('app', 'User ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'created_at' => Yii::t('app', 'Created At'),
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
}
