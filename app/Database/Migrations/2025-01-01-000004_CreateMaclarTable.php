<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaclarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'turnuva_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'takim1_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'takim2_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'skor1' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'skor2' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'tarih' => ['type' => 'DATETIME', 'null' => true],
            'tur' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'Grup A'], // Grup adı veya "Çeyrek Final" vb.
            'durum' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'planlandi'], // planlandi, oynaniyor, tamamlandi
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('turnuva_id', 'turnuvalar', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('takim1_id', 'takimlar', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('takim2_id', 'takimlar', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('maclar', true);
    }

    public function down()
    {
        $this->forge->dropTable('maclar', true);
    }
}