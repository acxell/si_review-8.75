<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('mahasiswa', 'dosen')->get();

        return view('proposals.view', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('proposals.create', compact('mahasiswas', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun_pengajuan' => 'required|date',
            'skema_pkm' => 'required|string',
            'pendanaan_pt' => 'nullable|string',
            'pendanaan_belmawa' => 'nullable|string',
            'pendanaan_lain' => 'nullable|string',
            'jumlah_anggota_tim' => 'required|integer',
            'file_proposal' => 'required|file|mimes:pdf',
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:mahasiswas,id',
            'dosen_ids' => 'required|array',
            'dosen_ids.*' => 'exists:dosens,id',
        ]);

        $filename = 'proposal_' . uniqid() . '.' . $request->file('file_proposal')->getClientOriginalExtension();
        $filePath = $request->file('file_proposal')->storeAs('file_proposal', $filename, 'public');

        $validatedData = [
            'judul' => $request->judul,
            'tahun_pengajuan' => $request->tahun_pengajuan,
            'skema_pkm' => $request->skema_pkm,
            'pendanaan_pt' => $request->pendanaan_pt,
            'pendanaan_belmawa' => $request->pendanaan_belmawa,
            'pendanaan_lain' => $request->pendanaan_lain,
            'jumlah_anggota_tim' => $request->jumlah_anggota_tim,
            'file_proposal' => $filePath,
        ];

        $proposal = Proposal::create($validatedData);
        $proposal->mahasiswa()->attach($request->mahasiswa_ids);
        $proposal->dosen()->attach($request->dosen_ids);

        return redirect()->route('prop.index')->with('success', 'Proposal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
        $proposal->load('mahasiswa', 'dosen');
        return view('proposals.detail', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposal $proposal)
    {
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();
        return view('proposals.edit', compact('proposal', 'mahasiswas', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposal $proposal)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun_pengajuan' => 'required|date',
            'skema_pkm' => 'required',
            'pendanaan_pt' => 'nullable|string',
            'pendanaan_belmawa' => 'nullable|string',
            'pendanaan_lain' => 'nullable|string',
            'jumlah_anggota_tim' => 'integer|required',
            'file_proposal' => 'nullable|file|mimes:pdf',
        ]);

        $data = $request->except('file_proposal');

        if ($request->hasFile('file_proposal')) {
            if ($proposal->file_proposal && Storage::disk('public')->exists($proposal->file_proposal)) {
                Storage::disk('public')->delete($proposal->file_proposal);
            }

            $filename = 'proposal_' . time() . '_' . uniqid() . '.' . $request->file('file_proposal')->getClientOriginalExtension();
            $data['file_proposal'] = $request->file('file_proposal')->storeAs('proposals', $filename, 'public');
        }

        $proposal->update($data);

        return redirect()->route('prop.index')->with('success', 'Proposal created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        $proposal->mahasiswa()->detach();
        $proposal->dosen()->detach();
        $proposal->delete();

        if ($proposal) {
            return redirect()->route('prop.index')->with('success', 'Proposal Telah Dihapus');
        } else {
            return redirect()->route('prop.index')->with('failed', 'Proposal Gagal Dihapus');
        }
    }
}
