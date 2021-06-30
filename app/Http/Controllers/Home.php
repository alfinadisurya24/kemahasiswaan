<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

// use App\Models\Mahasiswa_m;

class Home extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // cek login
        // if (login) {
            // redirect();
        //  exit;
        // }else{

        // }

        $mhs = DB::table('mahasiswa')
                ->get();
        $prodi = DB::table('prodi')
                ->get();
        $data = [
            'title' => 'dashboard',
            'jumlahMhs' => count($mhs),
            'jumlahProdi' => count($prodi),
            'views' => 'dashboard'
        ];

        return view('partials.base', $data);
    }

    public function profile(){
        $mhs = DB::table('mahasiswa')
                ->join('prodi', 'prodi.id', '=', 'mahasiswa.prodi_id')
                ->select('*', 'mahasiswa.id as idMhs','prodi.name as nama_prodi', 'mahasiswa.name as nama_mhs')
                ->get();
        $data = [
            'title' => 'Profile',
            'dataMhs' => $mhs,
            'views' => 'profile'
        ];


        return view('partials.base', $data);
    }

    public function mahasiswa(){
        $mhs = DB::table('mahasiswa')
                ->join('prodi', 'prodi.id', '=', 'mahasiswa.prodi_id')
                ->select('*', 'mahasiswa.id as idMhs','prodi.name as nama_prodi', 'mahasiswa.name as nama_mhs')
                ->get();
        $data = [
            'title' => 'Mahasiswa',
            'dataMhs' => $mhs,
            'views' => 'mahasiswa'
        ];


        return view('partials.base', $data);
    }

    public function createMhs()
    {
        $field = new \stdClass();
            $field->id        = null;
            $field->nim       = null;
            $field->name      = null;
            $field->prodi_id  = null;
            $field->email     = null;
            $field->phone     = null;
            $field->address   = null;

        $prodi = DB::table('prodi')
                ->get();

        $data = [
            'title' => 'Mahasiswa',
            'field' => $field,
            'prodi' => $prodi,
            'views' => 'form.form_mahasiswa'
        ];

        return view('partials.base', $data);
    }

    public function updateMhs($id)
    {
        $field = DB::table('mahasiswa')
        // ->join('prodi', 'prodi.id', '=', 'mahasiswa.prodi_id')
        // ->select('*', 'prodi.name as nama_prodi', 'mahasiswa.name as nama_mhs')
        ->find($id);

        $prodi = DB::table('prodi')
                ->get();

        $data = [
            'title' => 'Mahasiswa',
            'field' => $field,
            'prodi' => $prodi,
            'views' => 'form.form_mahasiswa'
        ];

        return view('partials.base', $data);
    }

    public function login_v()
    {
        return view('login');
    }

    public function register_v()
    {
        return view('register');
    }
}
