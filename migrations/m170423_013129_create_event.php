<?php

use yii\db\Migration;

class m170423_013129_create_event extends Migration {

    public function up() {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'create_date' => $this->dateTime()->notNull(),
            'create_own' => $this->integer(11)->notNull(),
        ]);
        $this->insert('event', [
            'title' => 'test 1','description' => 'content 1','create_date' => '2017-04-25 20:13:14','create_own' => 1,
        ]);
    }

    public function down() {    
//        $this->delete('event', ['id' => 1]);
        $this->dropTable('event');        
    }
}