<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('documents');
    }
}
