<?php

namespace App\Controllers;

use App\Models\AlternatifModel;

class Alternatif extends BaseController
{
    public function index($project_id)
    {
        session()->set('breadcrumb', [
            0 => ['label' => 'Project', 'link' => route_to('/')],
            1 => ['label' => 'Alternatif', 'link' => route_to('alternatif')]
        ]);

        $alternatifModel = new AlternatifModel();
        $alternatif = $alternatifModel->findByProject($project_id);
        $data = [
            'project_id' => $project_id,
            'alternatif' => $alternatif,
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
            'nama' => $_POST['nama']
        ];

        if (!$alternatifModel->save($alternatif))
            return redirect()->back()->withInput()->with('errors', ["Data {$alternatif['nama']} pada Nama Alternatif telah digunakan."]);

        return redirect()->back()->with('message', 'Berhasil menyimpan data.');
    }

    public function hapus()
    {
        $alternatifModel = new AlternatifModel();
        $alternatifModel->delete($_POST['id']);
        return redirect()->back()->with('message', 'Berhasil menghapus data.');
    }
}
