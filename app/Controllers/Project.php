<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\ProjectModel;

class Project extends BaseController
{
    public function index()
    {
        session()->set('breadcrumb', []);

        $projectModel = new ProjectModel();

        $project = $projectModel->sudah_rank();

        $data = [
            'project' => $project
        ];

        return view('project', $data);
    }

    public function tambah()
    {
        $projectModel = new ProjectModel();

        if (!$this->validate($projectModel->validationRules, $projectModel->validationMessages))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $project = [
            'nama' => $_POST['nama']
        ];

        if (!$projectModel->save($project))
            return redirect()->back()->withInput()->with('error', "Gagal menyimpan data.");

        return redirect()->back()->with('message', 'Berhasil menyimpan data.');
    }

    public function hapus()
    {
        $projectModel = new ProjectModel();

        if (!$projectModel->delete($_POST['id']))
            return redirect()->back()->withInput()->with('error', "Gagal menghapus data.");

        return redirect()->back()->with('message', 'Berhasil menghapus data.');
    }
}
