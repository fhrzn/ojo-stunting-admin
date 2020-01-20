<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{

    // nama => username
    protected $fillable = ['username', 'password', 'api_token'];

    protected $hidden = [
        'password',
        'api_token'
    ];

    public function dataRespondens()
    {
        return $this->hasMany('App\DataResponden', 'surveyor', 'id');
    }
}
