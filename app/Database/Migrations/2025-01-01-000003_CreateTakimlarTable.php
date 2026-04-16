<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTakimlarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'turnuva_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'kaptan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => 'users tablosuna bağlanacak'],
            'ad' => ['type' => 'VARCHAR', 'constraint' => 100],
            'kisa_ad' => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'logo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('turnuva_id', 'turnuvalar', 'id', 'CASCADE', 'CASCADE');
        // Kullanıcı tablosu olmadığı için şimdilik foreign key eklemiyoruz
        $this->forge->createTable('takimlar', true);
    }

    public function down()
    {
        $this->forge->dropTable('takimlar', true);
    }
}