<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'project';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => [
            'label' => 'Nama Project',
            'rules' => 'required|is_unique[project.nama]'
        ]
    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => 'Kolom {field} harus diisi.',
            'is_unique' => 'Data {value} pada {field} telah digunakan.',
        ]
    ];
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

    public function sudah_rank()
    {
        $this->builder()->select('project.*, CASE WHEN SUM(alternatif.rank) > 0 THEN TRUE ELSE FALSE END AS sudah_rank')
            ->join('alternatif', 'alternatif.project_id = project.id', 'LEFT')
            ->groupBy('project.id');

        return $this->builder()->get()->getResultArray();
    }
}
