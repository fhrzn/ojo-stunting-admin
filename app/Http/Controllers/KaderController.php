<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Kader;
use Validator;

class KaderController extends Controller
{
    public function index()
    {
        $kaders = Kader::all();
        return view('kader.index')->with('kaders', $kaders);
    }

    public function create()
    {
        return view('kader.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withDanger($validator);
        }

        if (Kader::where('username', '=', $request->input('username'))->count() > 0) {
            return redirect()->back()->withDanger('Username sudah digunakan, silahkan gunakan username lain.');
        }

        $kader = Kader::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))
        ]);

        // $token = JWTAuth::fromUser($kader);
        
        if ($kader) {
            return redirect()->route('kader')->with('success', 'Berhasil menambahkan data');
        } else{
            return redirect()->back()->withDanger($kader);
        }
    }

    public function edit($id)
    {
        $kader = Kader::findOrFail($id);
        if ($kader==null) {
            return redirect()->back()->withDanger('Data tidak ditemukan !');
        } else{
            return view('kader.edit')->with('kader',$kader);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withDanger($validator);
        }

        $kader = Kader::find($id);

        $kader->update([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]); 
        
        return redirect()->route('kader')->with('success', 'Data berhasil di perbarui');        
    }

    public function destroy($id)
    {
        $kader = Kader::findOrFail($id);

        if ($kader === null) {
            return redirect()->back()->withDanger('Data tidak ditemukan !');
        } else{
            $kader->delete();
            return redirect()->back()->withSuccess('Berhasil dihapus');
        }
    }
}
