<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataResponden extends Model
{    
    protected $fillable = [
        'nama_responden', 
        'alamat_responden', 
        'hasil_kuesioner', 
        'surveyor', 
        'jenis_kuesioner'
    ];

    public function kaders()
    {
        return $this->belongsTo('App\Kader', 'id');
    }
}
