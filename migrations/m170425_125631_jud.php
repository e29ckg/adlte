<?php

use yii\db\Migration;

class m170425_125631_jud extends Migration
{
    public function up()
    {
        $this->createTable('judgement', [
            'id' => $this->primaryKey(),
            'black_number' => $this->string(255)->notNull(),
            'doc_type_id' => $this->string(255)->notNull(),
            'black_append' => $this->string(255),
            'red_number' => $this->string(255),
            'doc_style_id' => $this->string(255)->notNull(),
            'file_name' => $this->string(255),
            'file_size' => $this->string(255),
            'scan_by' => $this->string(255),
            'scan_datetime' => $this->string(255)->notNull(),
            'upload_datetime' => $this->string(255),
            'upload_by' => $this->string(255),
            'transfer_status' => $this->integer(9),
            'file_page' => $this->string(255),
            'create_at' => $this->timestamp(),
        ]);

    }

    public function down()
    {
        $this->dropTable('judgement');
    }
}
