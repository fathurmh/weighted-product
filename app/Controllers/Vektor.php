<?php

namespace App\Controllers;

use App\Models\AlternatifKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class Vektor extends BaseController
{
    public function index($project_id)
    {
        session()->set('breadcrumb', [
            0 => ['label' => 'Project', 'link' => route_to('/')],
            1 => ['label' => 'Alternatif', 'link' => base_url("alternatif/$project_id")],
            2 => ['label' => 'Kriteria', 'link' => base_url("kriteria/$project_id")],
            3 => ['label' => 'Rating', 'link' => base_url("rating/$project_id")],
            4 => ['label' => 'Vektor', 'link' => base_url("vektor/$project_id")],
        ]);

        $alternatifModel = new AlternatifModel();
        $alternatif_list_s = $alternatifModel->findByProject($project_id);
        $alternatif_list_v = $alternatifModel->findByProject($project_id, 'rank ASC');

        $data = [
            'project_id' => $project_id,
            'alternatif_list_s' => $alternatif_list_s,
            'alternatif_list_v' => $alternatif_list_v,
            'sum_vektor_s' => array_sum(array_column($alternatif_list_s, 'vektor_s')),
        ];

        return view('vektor', $data);
    }

    public function s($project_id)
    {
        $alternatifModel = new AlternatifModel();
        $alternatifKriteriaModel = new AlternatifKriteriaModel();

        $alternatif_list = $alternatifModel->findByProject($project_id);

        $alternatif_kriteria_list = $alternatifKriteriaModel->findByProject($project_id);

        $rating_list = [];
        foreach ($alternatif_kriteria_list as $value) {
            $rating_list[$value['alternatif_id']][$value['kriteria_id']] = $value;
        }

        foreach ($alternatif_list as &$alternatif) {
            $alternatif['vektor_s'] = 1;

            foreach ($rating_list[$alternatif['id']] as $rating) {
                $alternatif['vektor_s'] *= pow($rating['rating'], $rating['kriteria_jenis'] == 0 ? $rating['kriteria_normalisasi'] : -1 * $rating['kriteria_normalisasi']);
            }

            $alternatif['vektor_s'] = round($alternatif['vektor_s'], 6);
            $alternatifModel->save($alternatif);
        }

        return redirect()->back()->with('message', 'Berhasil menghitung Vektor S.');
    }

    public function v($project_id)
    {
        $alternatifModel = new AlternatifModel();

        $alternatif_list = $alternatifModel->findByProject($project_id);

        $sum_vektor_s = array_sum(array_column($alternatif_list, 'vektor_s'));

        if ($sum_vektor_s == 0)
            return redirect()->back()->with('error', 'Total bobot tidak boleh 0.');

        foreach ($alternatif_list as &$alternatif) {
            $alternatif['vektor_v'] = round($alternatif['vektor_s'] / $sum_vektor_s, 6);
        }

        usort($alternatif_list, function ($a, $b) {
            return $b['vektor_v'] <=> $a['vektor_v'];
        });

        $rank = 1;
        foreach ($alternatif_list as &$alternatif) {
            $alternatif['rank'] = $rank++;
            $alternatifModel->save($alternatif);
        }


        return redirect()->back()->with('message', 'Berhasil menghitung Vektor V dan meranking Alternatif.');
    }
}
