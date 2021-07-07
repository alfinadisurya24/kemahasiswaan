<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Hash;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;

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
        $users = DB::table('users')
                ->get();
        $data = [
            'title' => 'dashboard',
            'jumlahMhs' => count($mhs),
            'jumlahUser' => count($users),
            'views' => 'dashboard'
        ];

        return view('partials.base', $data);
    }

    public function profile(){
        $id = session('userid');
        
        $user = DB::select('select * from users where id = ' . $id);
        $data = [
            'title' => 'Profile',
            'dataUser' => $user,
            'views' => 'profile'
        ];

        return view('partials.base', $data);
    }

    public function update_img(Request $req){

        // get img
        $img = DB::select('select img from users where id = '.$req->idImg);

        foreach($img as $pic){
            $fileName = $pic->img;
        }
        // delete old img
        File::delete(public_path('images/'.$fileName));
        // upload new img
        $req->validate([
            'img' => 'image|mimes:jpg,jpeg,png'
        ]);
        $filenames = $req->nameImg.'.'.$req->usrImg->extension();
        // save img to folder
        $req->usrImg->move(public_path('images'), $filenames);
        // update img on db
        DB::select('update users set img = "'. $filenames .'" where id = '. $req->idImg);

        return redirect('/profile')->with('message', 'Foto berhasil diubah!');

    }

    public function update_user_data_master(Request $req){

        // set variable
        $id = $req->idData;
        $name = $req->name;
        $phone = $req->phone;
        $email = $req->email;
        $username = $req->username;

        DB::select('update users set name = "'.$name.'", phone = '.$phone.', email = "'.$email.'", username = "'.$username.'" where id = '. $id);

        return redirect('/profile')->with('message', 'Data user berhasil diubah!');
    }

    public function change_password(Request $req){
        // set variable
        $pass = $req->password;
        $repass = $req->repassword;
        
        if ($pass === $repass) {
            DB::select('update users set password = "'.bcrypt($repass).'" where id = '.$req->idPass);
            return redirect('/profile')->with('message', 'Password berhasil diganti!');
        } else {
            return redirect('/profile')->with('error', 'Password tidak sama!');
        }
    }

    public function user_view(){
        // get user data
        $usr = DB::select('select usr.*, role.name as role_name from users as usr join roles as role on usr.role_id = role.id');
        
        $data = [
            'title' => 'User',
            'userData' => $usr,
            'views' => 'user'
        ];

        return view('partials.base', $data);
    }

    public function user_create_view(){
        $field = new \stdClass();
        $field->id = null;
        $field->name = null;
        $field->email = null;
        $field->phone = null;
        $field->username = null;
        $field->role_id = null;

        $role = DB::select('select * from roles');

        $data = [
            'title' => 'User',
            'field' => $field,
            'role' => $role,
            'views' => 'form.form_user'
        ];
        return view('partials.base', $data);
    }

    public function user_fetch_view($id){
        // get user data by id
        $field = DB::select('select * from users where id = ' . $id);
        $role = DB::select('select * from roles');
        $data = [
            'title' => 'User',
            'field' => $field[0],
            'role' => $role,
            'views' => 'form.form_user'
        ];
        return view('partials.base', $data);
    }

    public function create_user_master_data(Request $req){
        // set data 
        $data = [
            '"'.$req->name.'"',
            '"'.$req->email.'"',
            $req->phone,
            '"'.$req->username.'"',
            '"'.bcrypt($req->password).'"',
            $req->role
        ];

        DB::select('insert into users (name,email,phone,username,password,role_id) values ('.implode(',',$data).')');

        return redirect('/user')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function update_master_user_data(Request $req){
        // set variable
        $id = $req->id;
        $name = $req->name;
        $email = $req->email;
        $phone = $req->phone;
        $username = $req->username;
        $password = $req->password;
        $role = $req->role;
        
        $passQ = ($password == null) ? '' : ', password = "'.bcrypt($password).'"';
        DB::select('update users set name = "'.$name.'", email = "'.$email.'", phone = '.$phone.', username = "'.$username.'", role_id = '.$role . $passQ . ' where id = ' . $id);

        return redirect('/user')->with('message', 'Data Berhasil Diubah!');
    }

    public function delete_user_master_data(Request $req){
        //set variable
        $id = $req->id_hidden;
        DB::select('delete from users where id = '.$id);
        return redirect('/user')->with('message', 'Data Berhasil Dihapus!');
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

    public function createData(Request $req) 
    {
        $data = [
            $req->nim,
            $req->prodi,
            '"'.$req->name.'"',
            '"'.$req->email.'"',
            $req->phone,
            '"'.$req->alamat.'"',
        ];
        
        DB::select('insert into mahasiswa (nim, prodi_id, name, email, phone, address) values ('.implode(',', $data).')');

        return redirect('/mahasiswa')->with('message', 'Data Berhasil Ditambahkan!');
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

    public function updateData(Request $req)
    {
        $id = $req->id;
        $nim = $req->nim;
        $prodi_id = $req->prodi;
        $name = '"'.$req->name.'"';
        $email = '"'.$req->email.'"';
        $phone = $req->phone;
        $address = '"'.$req->alamat.'"';

        DB::select('update mahasiswa set nim = '.$nim.', prodi_id = '.$prodi_id.', name = '.$name.', email = '.$email.', phone = '.$phone.', address = '.$address.' where id = '. $id);

        return redirect('/mahasiswa')->with('message', 'Data Berhasil Diubah!');
    }

    public function deleteData(Request $req)
    {
        $id = $req->id_hidden;

        DB::select('delete from mahasiswa where id = ' . $id);

        return redirect('/mahasiswa')->with('message', 'Data Berhasil Dihapus!');
    }

    public function export_pdf()
    {
        $mhs = DB::select('select mhs.*, prd.name as prodi_name from mahasiswa as mhs join prodi as prd on mhs.prodi_id = prd.id');

        $pdf = PDF::loadview('mahasiswa_pdf', ['mahasiswa' => $mhs]);
        return $pdf->stream();
    }

    public function register_v()
    {
        return view('register');
    }

    public function login_v()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        $username = $req->username;
        $password = $req->password;

        $usrData = DB::select('select * from users where username = "' . $username . '"');
        $dbpass = $usrData[0]->password;

        if (!Hash::check($password, $dbpass)) {
            return redirect('/')->with('message', 'Username atau password salah!');
        } else {
            session(['userid' => $usrData[0]->id]);
            session(['role' => $usrData[0]->role_id]);
            return redirect('/dashboard');
        }
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        header("Set-Cookie: credentials=; path=/; httpOnly;");
        return redirect('/');
    }

}
