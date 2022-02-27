<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlternatifKriteria extends Migration
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
            'alternatif_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kriteria_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'rating' => [
                'type' => 'DOUBLE',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('alternatif_id', 'alternatif', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kriteria_id', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('alternatif_kriteria');
    }

    public function down()
    {
        $this->forge->dropForeignKey('alternatif_kriteria', 'alternatif_kriteria_alternatif_id_foreign');
        $this->forge->dropForeignKey('alternatif_kriteria', 'alternatif_kriteria_kriteria_id_foreign');
        $this->forge->dropTable('alternatif_kriteria');
    }
}
