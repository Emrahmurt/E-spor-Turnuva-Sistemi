<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTurnuvalarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'oyun_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'ad' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255],
            'aciklama' => ['type' => 'TEXT', 'null' => true],
            'baslangic_tarihi' => ['type' => 'DATETIME'],
            'kayit_bitis' => ['type' => 'DATETIME'],
            'format' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'tek_eleme'],
            'odul' => ['type' => 'TEXT', 'null' => true],
            'kurallar' => ['type' => 'TEXT', 'null' => true],
            'durum' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'yakinda'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('oyun_id', 'oyunlar', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('turnuvalar', true);
    }

    public function down()
    {
        $this->forge->dropTable('turnuvalar', true);
    }
}