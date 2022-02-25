<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alternatif extends Migration
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
            'project_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'vektor_s' => [
                'type' => 'DOUBLE',
            ],
            'vektor_v' => [
                'type' => 'DOUBLE',
            ],
            'rank' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode');
        $this->forge->addUniqueKey('nama');
        $this->forge->addForeignKey('project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('alternatif');
    }

    public function down()
    {
        $this->forge->dropForeignKey('alternatif', 'alternatif_project_id_foreign');
        $this->forge->dropTable('alternatif');
    }
}
