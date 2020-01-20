<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kader;
use App\DataResponden;

class DataRespondenController extends Controller
{
    public function anak(Request $request)
    {        
        if ($request==null || $request->input('alamat')=='semua') {
            $data = DataResponden::join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','3')
                             ->get();
        } else{
            $data = DataResponden::join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','3')
                             ->where('alamat_responden', 'LIKE' ,'%'.$request->input('alamat').'%')
                             ->get();
        }
        
        return view('data-responden.skrininganak')->with('data', $data);
    }

    public function ibuHamil(Request $request)
    {
        if ($request==null || $request->input('alamat')=='semua') {
            $data = DataResponden::join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','2')
                             ->get();
        } else{
            $data = DataResponden::join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','2')
                             ->where('alamat_responden', 'LIKE' ,'%'.$request->input('alamat').'%')
                             ->get();
        }
        return view('data-responden.skriningibuhamil')->with('data', $data);
    }

    public function wus(Request $request)
    {
        if ($request==null || $request->input('alamat')=='semua') {
            $data = DataResponden::join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','1')
                             ->get();
        } else{
            $data = DataResponden::join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','1')
                             ->where('alamat_responden', 'LIKE' ,'%'.$request->input('alamat').'%')
                             ->get();
        }
        return view('data-responden.skriningwus')->with('data', $data);
    }

    public function delete($id)
    {
        $data = DataResponden::findOrFail($id);

        if ($data === null) {
            return redirect()->back()->withDanger('Data tidak ditemukan !');            
        } else{
            $data->delete();
            return redirect()->back()->withSuccess('Berhasil dihapus');
        }
    }
}
