<?php

namespace App\Controllers;

use App\Models\AlternatifKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class Rating extends BaseController
{
    public function index($project_id)
    {
        session()->set('breadcrumb', [
            0 => ['label' => 'Project', 'link' => route_to('/')],
            1 => ['label' => 'Alternatif', 'link' => base_url("alternatif/$project_id")],
            2 => ['label' => 'Kriteria', 'link' => base_url("kriteria/$project_id")],
            3 => ['label' => 'Rating', 'link' => base_url("rating/$project_id")],
        ]);

        $alternatifModel = new AlternatifModel();
        $kriteriaModel = new KriteriaModel();
        $alternatifKriteriaModel = new AlternatifKriteriaModel();

        $alternatif_list = $alternatifModel->findByProject($project_id);
        $kriteria_list = $kriteriaModel->findByProject($project_id);

        $alternatif_kriteria_list = $alternatifKriteriaModel->findByProject($project_id);

        $rating_list = [];
        $alternatif_kriteria_id_list = [];
        foreach ($alternatif_kriteria_list as $value) {
            $rating_list[$value['alternatif_id']][$value['kriteria_id']] = $value['rating'];
            $alternatif_kriteria_id_list[$value['alternatif_id']][$value['kriteria_id']] = $value['id'];
        }

        $data = [
            'project_id' => $project_id,
            'alternatif_list' => $alternatif_list,
            'kriteria_list' => $kriteria_list,
            'count_kriteria' => count($kriteria_list),
            'rating_list' => $rating_list,
            'count_rating' => count($rating_list),
            'alternatif_kriteria_id_list' => $alternatif_kriteria_id_list,
        ];

        return view('rating', $data);
    }

    public function simpan()
    {
        $alternatifKriteriaModel = new AlternatifKriteriaModel();

        $rating_list = [];
        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, 'rating')) {
                $keys = explode('-', $key);

                $rating = [
                    'alternatif_id' => $keys[1],
                    'kriteria_id' => $keys[2],
                    'id' => $keys[3] ?? '',
                    'rating' => $value,
                ];

                $alternatifKriteriaModel->save($rating);
                array_push($rating_list, $rating);
            }
        }

        return redirect()->back()->with('message', 'Berhasil menyimpan data.');
    }
}
