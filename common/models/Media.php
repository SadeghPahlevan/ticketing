<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%media}}".
 *
 * @property int $id
 * @property string $type
 * @property string $name
 *
 * @property Ticket[] $tickets
 * @property User[] $users
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['media_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['media_id' => 'id']);
    }
    public static function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
        $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
        return $imageLayer;
    }

    public static function uploadImage($name,$resizeWidth,$resizeHeight,$folder) {
        if(!empty($_FILES[$name]['tmp_name'])){
            $fileName = $_FILES[$name]['tmp_name'];
            $sourceProperties = getimagesize($fileName);
            $resizeFileName = time();
            $uploadPath = Yii::getAlias('@common').'/web/images/'.$folder.'/';
            $fileExt = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName);
                    $imageLayer = self::resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$resizeWidth,$resizeHeight);
                    imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                    break;

                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($fileName);
                    $imageLayer = self::resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$resizeWidth,$resizeHeight);
                    imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                    break;

                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName);
                    $imageLayer = self::resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$resizeWidth,$resizeHeight);
                    imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                    break;

                default:
                    $imageProcess = 0;
                    break;
            }
            if(move_uploaded_file($fileName, $uploadPath. $resizeFileName. ".". $fileExt)){

                return 'thump_'.$resizeFileName.'.'.$fileExt;
            }else{
                return false;
            }
        }
        return false;
    }
}
