<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dep".
 *
 * @property integer $id
 * @property string $name
 * @property integer $st
 */
class Dep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['st'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อตำแหน่ง',
            'st' => 'St',
        ];
    }
}
