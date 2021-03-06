<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Courses extends Migration
{
    public function up(){

    $this->forge->addField([
        'id'         => ['type' => 'INT', 'constraint' => 10, 'auto_increment'=> true, 'unsinged'=>true,],
        'teacher_id'      => ['type' => 'INT', 'constraint' => 8],
        'coursename'      => ['type' => 'varchar', 'constraint' => 31],
        'leactures_course'      => ['type' => 'varchar', 'constraint' => 31],
        'created_at' => ['type' => 'datetime', 'null' => true],
        'updated_at' => ['type' => 'datetime', 'null' => true],

     
    ]);
    $this->forge->addKey('id',true);
    $this->forge->addForeignKey('teacher_id','teachers','id','CASCADE','CASCADE');
    $this->forge->createTable('courses');
}

public function down()
{
    $this->forge->dropTable('courses');
}
}