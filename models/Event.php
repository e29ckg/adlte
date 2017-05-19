<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $create_date
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'create_date'], 'required'],
            [['description'], 'string'],
            [['create_date','end_date'], 'safe'],
            [['title','color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อกิจกรรม',
            'description' => 'รายละเอียด',
            'create_date' => 'เริ่มกิจกรรมวันที่และเวลา',
            'end_date' => 'สิ้นสุดกิจกรรมวันที่',
            'color' => 'สี',
        ];
    }
}
