<?php

namespace app\models;

use Yii;
use app\models\Userdt;
use app\models\Dep;
use yii\web\UploadedFile;

class profile extends \yii\db\ActiveRecord {

    public $upload_foler = 'uploads/img/user';

    public static function tableName() {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fullname'], 'required'],
            ['fullname', 'unique', 'targetAttribute' => ['fullname'], 'message' => 'ชื่อ-สกุล ซ้ำ'],
            [['user_id'], 'integer'],
            [['birthday', 'create_at'], 'safe'],
            [['id_card', 'fullname', 'dep'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function validateUser() {
        $user = static::findOne(['username' => Yii::$app->encrypter->encrypt($attribute)]);
        if ($user) {
            $this->addError($attribute, 'This username is already in use".');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'id_card' => 'Id Card',
            'fullname' => 'ชื่อ-สกุล',
            'dep' => 'ตำแหน่ง',
            'birthday' => 'Birthday',
            'img' => 'Img',
            'create_at' => 'Create At',
        ];
    }

    public function getUser() {
        return $this->hasOne(Userdt::className(), ['id' => 'user_id']);
    }
    
    public function getDepname($id) {
        $depName = Dep::findOne($id);
        return $depName->name;
    }
    
    public function getFullname() {
        return $this->fullname;
    }

    public function getUsername() {
        return $this->user->username;
    }

    public function upload($model, $attribute) {
        $photo = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;

            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl() {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer() {
        return empty($this->img) ? Yii::getAlias('@web') . '/' . $this->upload_foler . '/none.png' : $this->getUploadUrl() . $this->img;
    }

    public function delphoto($photo) {
        if ($photo !== null) {
            unlink(Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/'. $photo);
            return true;
        }
        return FALSE;
    }

}
