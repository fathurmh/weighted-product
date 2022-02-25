<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
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
            'jenis' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'bobot' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'normalisasi' => [
                'type' => 'DOUBLE',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode');
        $this->forge->addUniqueKey('nama');
        $this->forge->addForeignKey('project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropForeignKey('kriteria', 'kriteria_project_id_foreign');
        $this->forge->dropTable('kriteria');
    }
}
