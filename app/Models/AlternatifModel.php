<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'alternatif';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['project_id', 'kode', 'nama', 'vektor_s', 'vektor_v', 'rank'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => [
            'label' => 'Nama Alternatif',
            'rules' => 'required'
        ]
    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => 'Kolom {field} Harus diisi.',
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
        $this->builder()->select()->where('project_id', $project_id);
        return $this->builder()->get()->getResultArray();
    }

    public function kode($project_id)
    {
        $kode = 'A';

        $result = $this->builder()->select('kode')->where('project_id', $project_id)->like('kode', $kode, 'AFTER')->get()->getResult();

        if ($result) {
            $last_kode = (int) str_replace($kode, '', end($result)->kode);
            $kode .= sprintf("%01d", ++$last_kode);
        } else {
            $kode .= sprintf("%01d", 1);
        }

        return $kode;
    }

    public function cekNama($project_id, $nama)
    {
        $result = $this->builder()->select('kode')->where(['project_id' => $project_id, 'nama' => $nama])->get()->getResult();

        if (count($result) > 0)
            return false;

        return true;
    }

    public function save($data): bool
    {
        $data['kode'] = $this->kode($data['project_id']);

        if ($this->cekNama($data['project_id'], $data['nama']))
            return parent::save($data);

        return false;
    }
}
