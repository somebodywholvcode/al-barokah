<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        //$data['siswa'] = student::with(['kelas.wali_kelas','extra'])->get();
        //mengirim data ke view
        return view('admin_akunstaff');
       }
}
