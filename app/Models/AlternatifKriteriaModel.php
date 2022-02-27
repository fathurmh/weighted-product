<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifKriteriaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'alternatif_kriteria';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['alternatif_id', 'kriteria_id', 'rating'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findByProject($project_id)
    {
        $this->builder()->select('alternatif_kriteria.*, alternatif.kode AS alternatif_kode, alternatif.nama AS alternatif_nama, kriteria.jenis AS kriteria_jenis, kriteria.normalisasi AS kriteria_normalisasi')
            ->join('alternatif', 'alternatif.id = alternatif_kriteria.alternatif_id', 'LEFT')
            ->join('kriteria', 'kriteria.id = alternatif_kriteria.kriteria_id', 'LEFT')
            ->where('alternatif.project_id', $project_id);

        return $this->builder()->get()->getResultArray();
    }
}
