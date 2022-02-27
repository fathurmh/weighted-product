<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    public function index($project_id)
    {
        session()->set('breadcrumb', [
            0 => ['label' => 'Project', 'link' => route_to('/')],
            1 => ['label' => 'Alternatif', 'link' => base_url("alternatif/$project_id")],
            2 => ['label' => 'Kriteria', 'link' => base_url("kriteria/$project_id")]
        ]);

        $kriteriaModel = new KriteriaModel();
        $kriteria = $kriteriaModel->findByProject($project_id);
        $data = [
            'project_id' => $project_id,
            'kriteria' => $kriteria,
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
            'nama' => $_POST['nama']
        ];

        if (!$kriteriaModel->save($kriteria))
            return redirect()->back()->withInput()->with('errors', ["Data {$kriteria['nama']} pada Nama Kriteria telah digunakan."]);

        return redirect()->back()->with('message', 'Berhasil menyimpan data.');
    }

    public function hapus()
    {
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->delete($_POST['id']);
        return redirect()->back()->with('message', 'Berhasil menghapus data.');
    }
}
