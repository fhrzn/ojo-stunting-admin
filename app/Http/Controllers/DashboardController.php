<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kader;
use App\DataResponden;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        // dd(date("m"));
        
        $countAll = DataResponden::count();
        $countAnak = DataResponden::where('jenis_kuesioner','3')->count();
        $countHamil = DataResponden::where('jenis_kuesioner','2')->count();
        $countWus = DataResponden::where('jenis_kuesioner','1')->count();

        $peringkatDesa = DataResponden::select(DB::raw('alamat_responden, count(alamat_responden) as total'))
                                        ->groupBy('alamat_responden')
                                        ->orderBy('total','DESC')
                                        ->LIMIT(5)
                                        ->get();

        $index = 0;

        $totalData = DataResponden::count();        
        $peringkatKader = DataResponden::select(DB::raw('kaders.username as username, count(hasil_kuesioner) as total'))
                                        ->join('kaders', 'surveyor', '=', 'kaders.id')
                                        ->groupBy('surveyor')
                                        ->groupBy('username')
                                        ->limit(5)
                                        ->get();

        foreach ($peringkatKader as $peringkat) {
            $peringkat['total'] = round(($peringkat['total']/$totalData)*100);
        }        

        return view('dashboard.index')->with([
            'all' => $countAll,
            'anak' => $countAnak,
            'ibu_hamil' => $countHamil,
            'wus' => $countWus,
            'peringkats' => $peringkatDesa,
            'index' => $index,
            'peringkatKader' => $peringkatKader
        ]);
    }
}
