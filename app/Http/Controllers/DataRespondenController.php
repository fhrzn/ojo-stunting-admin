<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kader;
use App\DataResponden;

class DataRespondenController extends Controller
{
    public function anak($alamat=null, $tahun=null, $bulan=null)
    {        

        $query = DataResponden::select('data_respondens.id', 'nama_responden', 'alamat_responden', 'hasil_kuesioner', 'kaders.username', 'data_respondens.created_at as created_at')
                             ->join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','3');                    

        if ($alamat && $alamat!='semua') {
            $query = $query->where('alamat_responden', '=' ,$alamat);
        }        
        
        if ($tahun) {
            $query = $query->whereYear('data_respondens.created_at', '=', $tahun);            
        }
        
        if ($bulan && $bulan!='semua') {
            $query = $query->whereMonth('data_respondens.created_at', '=', $bulan);
        }        
                
        $data = $query->get();                
        
        return view('data-responden.skrininganak')->with('data', $data);
    }

    public function ibuHamil($alamat=null, $tahun=null, $bulan=null)
    {
        $query = DataResponden::select('data_respondens.id', 'nama_responden', 'alamat_responden', 'hasil_kuesioner', 'kaders.username', 'data_respondens.created_at as created_at')
                             ->join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','2');                    

        if ($alamat && $alamat!='semua') {
            $query = $query->where('alamat_responden', '=' ,$alamat);
        }        
        
        if ($tahun) {
            $query = $query->whereYear('data_respondens.created_at', '=', $tahun);            
        }
        
        if ($bulan && $bulan!='semua') {
            $query = $query->whereMonth('data_respondens.created_at', '=', $bulan);
        }        
                
        $data = $query->get();                
        
        return view('data-responden.skriningibuhamil')->with('data', $data);
    }

    public function wus($alamat=null, $tahun=null, $bulan=null)
    {
        $query = DataResponden::select('data_respondens.id', 'nama_responden', 'alamat_responden', 'hasil_kuesioner', 'kaders.username', 'data_respondens.created_at as created_at')
                             ->join('kaders', 'surveyor', '=', 'kaders.id')
                             ->where('jenis_kuesioner','1');                    

        if ($alamat && $alamat!='semua') {
            $query = $query->where('alamat_responden', '=' ,$alamat);
        }        
        
        if ($tahun) {
            $query = $query->whereYear('data_respondens.created_at', '=', $tahun);            
        }
        
        if ($bulan && $bulan!='semua') {
            $query = $query->whereMonth('data_respondens.created_at', '=', $bulan);
        }        
                
        $data = $query->get();                
        
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

    public function getRiwayat($nama, $alamat)
    {
        $data = DataResponden::select('hasil_kuesioner', 'kaders.username as surveyor', 'data_respondens.created_at')
                            ->join('kaders', 'surveyor', '=', 'kaders.id')
                            ->where('nama_responden', '=', $nama)
                            ->where('alamat_responden', '=', $alamat)
                            ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
