<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOyunlarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ad' => ['type' => 'VARCHAR', 'constraint' => 100],
            'logo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'max_oyuncu' => ['type' => 'INT', 'constraint' => 2, 'default' => 5],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('oyunlar', true);
    }

    public function down()
    {
        $this->forge->dropTable('oyunlar', true);
    }
}