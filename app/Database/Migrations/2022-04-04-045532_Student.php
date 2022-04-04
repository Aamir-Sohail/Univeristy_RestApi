<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Student extends Migration
{
    public function up(){
    $this->forge->addField([
        'id'         => ['type' => 'INT', 'constraint' => 31, 'auto_increment'=> true, 'unsinged'=>true,],
        'studentname'      => ['type' => 'varchar', 'constraint' => 31],
        'fathername'      => ['type' => 'varchar', 'constraint' => 31],
        'semester'      => ['type' => 'varchar', 'constraint' => 31],
        'email'      => ['type' => 'varchar', 'constraint' => 31],
        'password'      => ['type' => 'varchar', 'constraint' => 31],
        'add_course'      => ['type' => 'varchar', 'constraint' => 31],
        'created_at' => ['type' => 'datetime', 'null' => true],
        'updated_at' => ['type' => 'datetime', 'null' => true],

     
    ]);
    $this->forge->addKey('id',true);
    $this->forge->createTable('student');
}

    public function down()
    {
        $this->forge->dropTable('student');

    }
}
