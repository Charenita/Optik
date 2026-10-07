<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Penyakit;

class CertaintyFactorService
{
    public function hitungDiagnosa($selectedGejalaIds)
    {
        $results = [];
        $penyakits = Penyakit::all();

        foreach ($penyakits as $penyakit) {

            $cfValues = [];

            // Ambil semua rule yang sesuai gejala yang dipilih
            $rules = Rule::where('penyakit_id', $penyakit->id)
                         ->whereIn('gejala_id', $selectedGejalaIds)
                         ->get();

            foreach ($rules as $rule) {
                $userCF = 1.0; // user yakin penuh terhadap gejala
                $cf = $rule->cf_value * $userCF;

                // pastikan tidak null
                if ($rule->cf_value !== null) {
                    $cfValues[] = $cf;
                }
            }

            // 🔥 PERBAIKAN: tetap tampilkan semua penyakit
            $cfResult = 0;

            if (count($cfValues) > 0) {
                $cfResult = $this->combineCF($cfValues);
            }

            $results[] = [
                'penyakit'   => $penyakit,
                'cf'         => $cfResult,
                'percentage' => $cfResult * 100
            ];
        }

        // Urutkan dari terbesar ke terkecil
        usort($results, function ($a, $b) {
            return $b['cf'] <=> $a['cf'];
        });

        return $results;
    }

    private function combineCF($cfValues)
    {
        $result = $cfValues[0];

        for ($i = 1; $i < count($cfValues); $i++) {
            $result = $result + ($cfValues[$i] * (1 - $result));
        }

        return $result;
    }
}