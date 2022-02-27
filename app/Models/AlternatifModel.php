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
            'rules' => 'required|is_unique[alternatif.nama,id,{id}]'
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

    public function findByProject($project_id, $orderBy = '')
    {
        $this->builder()->select()->where('project_id', $project_id);

        $this->builder()->orderBy($orderBy);

        return $this->builder()->get()->getResultArray();
    }

    public function countByProject($project_id)
    {
        $this->builder()->selectCount('id')->where('project_id', $project_id);
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
        if (!isset($data['id'])) {
            $data['kode'] = $this->kode($data['project_id']);
        }

        if ($this->cekNama($data['project_id'], $data['nama'], $data['id'] ?? ''))
            return parent::save($data);

        return false;
    }
}
