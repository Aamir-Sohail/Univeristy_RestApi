<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Teachers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 31, 'auto_increment'=> true, 'unsinged'=>true,],

            'name'      => ['type' => 'varchar', 'constraint' => 31],
            'email'      => ['type' => 'varchar', 'constraint' => 31],
            'password'      => ['type' => 'varchar', 'constraint' => 31],
            'address'      => ['type' => 'varchar', 'constraint' => 31],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' =>['type' => 'datetime', 'null' => true],
        
         
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('teachers');
    }

    public function down()
    {
   
        $this->forge->dropTable('teachers');
    }
}
