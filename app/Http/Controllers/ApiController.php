<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Kader;
use App\DataResponden;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller{   

    public function login2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $kader = Kader::where('username', $request->input('username'))->first();

        if ($kader==null) {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak terdaftar!Untuk informasi lebih lanjut silahkan hubungi admin.',
                'data' => ''
            ], 404);
        }

        if (Hash::check($request->input('password'),$kader->password)) {
            $apiToken = base64_encode(str_random(40));

            $kader->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil login',
                'profile' => $kader,
                'data' => $apiToken
            ], 201);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal login',
                'data' => ''
            ]);
        }
    }
    
    public function submitSkrining(Request $request)
    {
        if (!$request->header('Authorization')) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan login terlebih dahulu'
            ]);
        } else{
            $apiToken = explode(' ', $request->header('Authorization'));
            $kader = Kader::where('api_token',$apiToken[1])->first();
            if ($kader==null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak valid, silahkan login terlebih dahulu'
                ]);
            }
        }

        $validate = Validator::make($request->all(), [
            'nama_responden' => 'required',
            'alamat_responden'  => 'required',
            'hasil_kuesioner' => 'required',
            'surveyor' => 'required',
            'jenis_kuesioner' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->messages()
            ]);
        }

        $checkExist = DataResponden::where('nama_responden', $request->input('nama_responden'))
                                ->where('alamat_responden', $request->input('alamat_responden'))
                                ->whereYear('created_at', date("Y"))
                                ->whereMonth('created_at', date("m"))->first();
        
        // dd($checkExist);
        if ($checkExist==null) {
            $data = DataResponden::create([
                'nama_responden' => $request->input('nama_responden'),
                'alamat_responden' => $request->input('alamat_responden'),
                'hasil_kuesioner' => $request->input('hasil_kuesioner'),
                'surveyor' => $request->input('surveyor'),
                'jenis_kuesioner' => $request->input('jenis_kuesioner')
            ]);
    
            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data skrining'
                ], 200);
            } else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan data skrining'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sudah dilakukan skrining bulan ini, silahkan lakukan skrining bulan depan'
            ]);
        }
    }
}
