<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data['santri'] = Santri::with('list_kelas')->get();
       $data['kelas'] = Kelas::all();
        return view('kelaspage.santri', $data);
    }
    /**
     * Display a listing of the resource.
     */
    public function rekap1()
    {
       $data['santri'] = Santri::all();
       $data['kelas'] = Kelas::all();
       return view('rekapkehadiran.rekapkehadiran',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $santri = new Santri;
        $santri->nama_santri = $request->nama_santri;
        $santri->gender = $request->gender;
        $santri->kelas = $request->kelas;
        $santri->save();
        return back()->withSuccess('Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->nama_santri = $request->nama_santri;
        $santri->gender = $request->gender;
        $santri->kelas = $request->kelas;
        $santri ->save();
        return back()->withSuccess('Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();
        return back()->withSuccess('Data Berhasil Dihapus');
    }
}
