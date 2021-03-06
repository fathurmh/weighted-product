<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class Alternatif extends BaseController
{
    public function index($project_id, $alternatif_id = null)
    {
        session()->set('breadcrumb', [
            0 => ['label' => 'Project', 'link' => route_to('/')],
            1 => ['label' => 'Alternatif', 'link' => route_to('alternatif')]
        ]);

        $alternatifModel = new AlternatifModel();
        $kriteriaModel = new KriteriaModel();

        $alternatif_list = $alternatifModel->findByProject($project_id);
        $kriteria_list = $kriteriaModel->findByProject($project_id);
        $count_alternatif = $alternatifModel->countByProject($project_id);
        $bobot_sum = array_sum(array_column($kriteria_list, 'normalisasi'));

        $alternatif = $alternatifModel->find($alternatif_id);

        if (empty($alternatif)) {
            $alternatif = [
                'id' => null,
                'nama' => null
            ];
        }

        $data = [
            'project_id' => $project_id,
            'alternatif_list' => $alternatif_list,
            'alternatif' => $alternatif,
            'count_alternatif' => $count_alternatif,
            'normalized' => $bobot_sum != 0,
        ];
        return view('alternatif', $data);
    }

    public function tambah()
    {
        $alternatifModel = new AlternatifModel();

        if (!$this->validate($alternatifModel->validationRules, $alternatifModel->validationMessages))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $alternatif = [
            'project_id' => $_POST['project_id'],
            'id' => $_POST['id'] ?? null,
            'nama' => $_POST['nama']
        ];

        if (empty($_POST['id']))
            unset($alternatif['id']);

        if (!$alternatifModel->save($alternatif))
            return redirect()->back()->withInput()->with('errors', ["Data {$alternatif['nama']} pada Nama Alternatif telah digunakan."]);

        return redirect()->to("alternatif/{$alternatif['project_id']}")->with('message', 'Berhasil menyimpan data.');
    }

    public function hapus()
    {
        $alternatifModel = new AlternatifModel();

        if (!$alternatifModel->delete($_POST['id']))
            return redirect()->back()->withInput()->with('error', "Gagal menghapus data.");

        return redirect()->to("alternatif/{$_POST['project_id']}")->with('message', 'Berhasil menghapus data.');
    }
}
