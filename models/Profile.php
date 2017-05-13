<?php
namespace app\models;

use Yii;
use app\models\Userdt;
use app\models\Dep;
/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $id_card
 * @property string $fullname
 * @property string $dep
 * @property string $birthday
 * @property string $img
 * @property string $create_at
 */
class profile extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'profile';
    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fullname'], 'required'],
            ['fullname', 'unique', 'targetAttribute' => ['fullname'], 'message' => 'Username must be unique.'],
            [['user_id'], 'integer'],
            [['birthday', 'create_at'], 'safe'],
            [['id_card', 'fullname', 'dep', 'img'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
        ];
    }
    
    public function validateUser()
    {
        $user = static::findOne(['username' => Yii::$app->encrypter->encrypt($attribute)]);
        if ($user){
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
            'fullname' => 'Fullname',
            'dep' => 'ตำแหน่ง',
            'birthday' => 'Birthday',
            'img' => 'Img',
            'create_at' => 'Create At',
        ];
    }
    public function getUser() {
        return $this->hasOne(Userdt::className(), ['id' => 'user_id']);
    }
    public function getFullname() {
        return $this->fullname;
    }
    public function getUsername() {
        return $this->user->username;
    }    
   
}