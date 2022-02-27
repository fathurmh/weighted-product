<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kriteria';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['project_id', 'kode', 'nama', 'jenis', 'bobot', 'normalisasi'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => [
            'label' => 'Nama Kriteria',
            'rules' => 'required'
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

    public function findByProject($project_id)
    {
        $this->builder()->select('*, (CASE WHEN jenis = 0 THEN "Benefit" ELSE "Cost" END) AS jenis_dd')->where('project_id', $project_id);
        return $this->builder()->get()->getResultArray();
    }

    public function countByProject($project_id)
    {
        $this->builder()->selectCount('id')->where('project_id', $project_id);
        return $this->builder()->get()->getResultArray();
    }

    public function kode($project_id)
    {
        $kode = 'K';

        $result = $this->builder()->select('kode')->where('project_id', $project_id)->like('kode', $kode, 'AFTER')->get()->getResult();

        if ($result) {
            $last_kode = (int) str_replace($kode, '', end($result)->kode);
            $kode .= sprintf("%01d", ++$last_kode);
        } else {
            $kode .= sprintf("%01d", 1);
        }

        return $kode;
    }

    public function cekNama($project_id, $nama, $id = null)
    {
        $this->builder()->select('kode')->where(['project_id' => $project_id, 'nama' => $nama]);

        if (isset($id) && !empty($id))
            $this->builder()->where('id <>', $id);

        $result = $this->builder()->get()->getResult();

        if (count($result) > 0)
            return false;

        return true;
    }

    public function save($data): bool
    {
        if (!is_assoc_array($data)) {
            return parent::save($data);
        } else {
            if (!isset($data['id']))
                $data['kode'] = $this->kode($data['project_id']);

            if ($this->cekNama($data['project_id'], $data['nama'], $data['id'] ?? ''))
                return parent::save($data);

            return false;
        }
    }

    public function resetNormalisasi($project_id)
    {
        $kriteria_list = $this->findByProject($project_id);
        foreach ($kriteria_list as $key => $kriteria) {
            $kriteria['normalisasi'] = 0;
            $this->save($kriteria);
        }
    }
}
