<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "judgement".
 *
 * @property integer $id
 * @property string $black_number
 * @property string $doc_type_id
 * @property string $black_append
 * @property string $red_number
 * @property string $doc_style_id
 * @property string $file_name
 * @property integer $file_size
 * @property string $scan_by
 * @property string $scan_datetime
 * @property string $upload_by
 * @property string $upload_datetime
 * @property integer $transfer_status
 * @property integer $file_page
 * @property string $create_at
 */
class Judgement extends \yii\db\ActiveRecord {

    const UPLOAD_FOLDER = '/data/PDFServer/';

    public $urlfiles = '/data/PDFServer/';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'judgement';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['doc_type_id','red_number'], 'required'],
            [['file_size', 'transfer_status', 'file_page'], 'integer'],
            [['create_at'], 'safe'],
            [['black_number', 'doc_type_id'], 'string', 'max' => 100],
            [['black_append', 'red_number', 'doc_style_id', 'file_name'], 'string', 'max' => 255],
            [['scan_by'], 'string', 'max' => 50],
            [['scan_datetime', 'upload_datetime'], 'string', 'max' => 14],
            [['upload_by'], 'string', 'max' => 13],
            [['file_name'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'black_number' => 'Black Number',
            'doc_type_id' => 'ประเภทหนังสือ',
            'black_append' => 'Black Append',
            'red_number' => 'Red Number',
            'doc_style_id' => 'Doc Style ID',
            'file_name' => 'File Name',
            'file_size' => 'File Size',
            'scan_by' => 'Scan By',
            'scan_datetime' => 'Scan Datetime',
            'upload_by' => 'Upload By',
            'upload_datetime' => 'Upload Datetime',
            'transfer_status' => 'Transfer Status',
            'file_page' => 'File Page',
            'create_at' => 'Create At',
        ];
    }

    public function upload($model, $attribute, $folder) {
        $photo = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();

        $path .= iconv('UTF-8', 'TIS-620', $folder);
        $path .= '/';

        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public static function getUploadPath() {
//    return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
        return $_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_FOLDER;
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function getPhotoViewer() {
        return empty($this->photo) ? Yii::getAlias('@web') . '/img/none.png' : $this->getUploadUrl() . $this->photo;
    }

    public function deleteallfile($black_name) {
        $filedelete = $this->findOne($black_name);
        $a = Judgement::getUploadPath();
        $a .= iconv('UTF-8', 'TIS-620', $filedelete->black_number);
//        $a = iconv('TIS-620', 'UTF-8', 'C:/xampp/htdocs/courts/PDFServer/' . $black_number);
        $files = glob($a . '/*');
// loop through files
        foreach ($files as $file) {
            if (is_file($file)) {
                // delete file
                unlink($file);
            }
        }
        return TRUE;
    }

    public function deleteDirFiles($id) {
        $model = Judgement::find($id);
        $a = Judgement::getUploadPath();
        $a .= iconv('UTF-8', 'TIS-620', $model->black_number);
//        $a = iconv('TIS-620', 'UTF-8', 'C:/xampp/htdocs/courts/PDFServer/' . $black_number);
        $files = glob($a . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                // delete file
                unlink($file);
            }
        }
        rmdir($a);
        $this->findOne($id)->delete();
        return TRUE;
    }

}
