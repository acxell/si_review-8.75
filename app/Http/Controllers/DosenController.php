<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all();

        return view('dosen.view', ['dosens' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nidn' => 'required|string|max:10',
            'nama' => 'required|string',
            'email' => 'required|email|unique:dosens',
            'no_hp' => 'required|integer|max:15',
            'jurusan' => 'required',
            'prodi' => 'required',
        ]);

        $dosen = Dosen::create($validateData);

        if ($dosen) {
            return redirect()->route('dosen.view')->with('success', 'Dosen Telah Ditambahkan');
        } else {
            return redirect()->route('dosen.view')->with('failed', 'Dosen Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return view('dosen.detail', ['dosen' => $dosen]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', ['dosen' => $dosen]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validateData = $request->validate([
            'nidn' => 'required|string|max:10',
            'nama' => 'required|string',
            'email' => 'required|email|unique:dosens',
            'no_hp' => 'required|integer|max:15',
            'jurusan' => 'required',
            'prodi' => 'required',
        ]);

        $dosen->update($validateData);

        if ($dosen) {
            return redirect()->route('dosen.view')->with('success', 'Dosen Berhasil Diubah');
        } else {
            return redirect()->route('dosen.view')->with('failed', 'Dosen Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        if ($dosen) {
            return redirect()->route('dosen.view')->with('success', 'Dosen Telah Dihapus');
        } else {
            return redirect()->route('dosen.view')->with('failed', 'Dosen Gagal Dihapus');
        }
    }
}
