<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vbook_log".
 *
 * @property integer $id
 * @property string $vbook_id
 * @property integer $user_id
 * @property string $create_at
 */
class VbookLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vbook_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['create_at'], 'safe'],
            [['vbook_id'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vbook_id' => 'Vbook ID',
            'user_id' => 'User ID',
            'create_at' => 'Create At',
        ];
    }
}
