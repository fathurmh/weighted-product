<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class Home extends BaseController
{
    public function index()
    {
        session()->set('breadcrumb', []);

        $projectModel = new ProjectModel();
        $project = $projectModel->findAll();

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

        $projectModel->save($project);

        return redirect()->to('/')->with('message', 'Berhasil menyimpan data.');
    }

    public function hapus()
    {
        $projectModel = new ProjectModel();
        $projectModel->delete($_POST['id']);
        return redirect()->to('/')->with('message', 'Berhasil menghapus data.');
    }
}
