<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::all();

        return view('pengumuman.view', ['pengumumans' => $pengumuman]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul_pengumuman' => 'required|string',
            'link_pengumuman' => 'required|string',
            'tanggal_pengumuman' => 'required|date',
            'status' => 'required',
        ]);

        $pengumuman = Pengumuman::create($validateData);

        if ($pengumuman) {
            return redirect()->route('pengumuman.view')->with('success', 'Pengumuman Telah Ditambahkan');
        } else {
            return redirect()->route('pengumuman.view')->with('failed', 'Pengumuman Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pengumuman.detail', ['pengumuman' => $pengumuman]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', ['pengumuman' => $pengumuman]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validateData = $request->validate([
            'judul_pengumuman' => 'required|string',
            'link_pengumuman' => 'required|string',
            'tanggal_pengumuman' => 'required|date',
            'status' => 'required',
        ]);

        $pengumuman->update($validateData);

        if ($pengumuman) {
            return redirect()->route('pengumuman.view')->with('success', 'Pengumuman Telah Ditambahkan');
        } else {
            return redirect()->route('pengumuman.view')->with('failed', 'Pengumuman Gagal Ditambahkan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        if ($pengumuman) {
            return redirect()->route('pengumuman.view')->with('success', 'Pengumuman Berhasil Dihapus');
        } else {
            return redirect()->route('pengumuman.view')->with('failed', 'Pengumuman Gagal Dihapus');
        }
    }
}
