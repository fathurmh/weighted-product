<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    public function index($project_id, $kriteria_id = null)
    {
        session()->set('breadcrumb', [
            0 => ['label' => 'Project', 'link' => route_to('/')],
            1 => ['label' => 'Alternatif', 'link' => base_url("alternatif/$project_id")],
            2 => ['label' => 'Kriteria', 'link' => base_url("kriteria/$project_id")]
        ]);

        $kriteriaModel = new KriteriaModel();
        $alternatifModel = new AlternatifModel();

        $kriteria_list = $kriteriaModel->findByProject($project_id);
        $count_alternatif = $alternatifModel->countByProject($project_id);
        $bobot_sum = array_sum(array_column($kriteria_list, 'normalisasi'));

        $kriteria = $kriteriaModel->find($kriteria_id);

        if (empty($kriteria)) {
            $kriteria = [
                'id' => null,
                'nama' => null,
                'jenis' => null,
                'bobot' => null,
            ];
        }

        $data = [
            'project_id' => $project_id,
            'kriteria_list' => $kriteria_list,
            'kriteria' => $kriteria,
            'count_alternatif' => $count_alternatif,
            'normalized' => $bobot_sum != 0,
        ];
        return view('kriteria', $data);
    }

    public function tambah()
    {
        $kriteriaModel = new KriteriaModel();

        if (!$this->validate($kriteriaModel->validationRules, $kriteriaModel->validationMessages))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $kriteria = [
            'project_id' => $_POST['project_id'],
            'id' => $_POST['id'],
            'nama' => $_POST['nama'],
            'jenis' => $_POST['jenis'],
            'bobot' => $_POST['bobot'],
        ];

        if (empty($_POST['id']))
            unset($kriteria['id']);

        if (!$kriteriaModel->save($kriteria))
            return redirect()->back()->withInput()->with('errors', ["Data {$kriteria['nama']} pada Nama Kriteria telah digunakan."]);

        $kriteriaModel->resetNormalisasi($kriteria['project_id']);

        return redirect()->to("kriteria/{$kriteria['project_id']}")->with('message', 'Berhasil menyimpan data.');
    }

    public function hapus()
    {
        $kriteriaModel = new KriteriaModel();

        if (!$kriteriaModel->delete($_POST['id']))
            return redirect()->back()->withInput()->with('error', "Gagal menghapus data.");

        $kriteriaModel->resetNormalisasi($_POST['project_id']);

        return redirect()->to("kriteria/{$_POST['project_id']}")->with('message', 'Berhasil menghapus data.');
    }

    public function normalisasi($project_id)
    {
        $kriteriaModel = new KriteriaModel();
        $kriteria_list = $kriteriaModel->findByProject($project_id);

        $bobot_sum = array_sum(array_column($kriteria_list, 'bobot'));

        if ($bobot_sum == 0)
            return redirect()->to("kriteria/$project_id")->with('error', 'Total bobot tidak boleh 0.');

        foreach ($kriteria_list as &$kriteria) {
            $kriteria['normalisasi'] = round($kriteria['bobot'] / $bobot_sum, 6);
            $kriteriaModel->save($kriteria);
        }

        return redirect()->to("kriteria/$project_id")->with('message', 'Berhasil menormalisasi data.');
    }
}
