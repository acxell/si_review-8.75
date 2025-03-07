<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProposalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/home', function () {
    return view('home');
});


Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::get('/dosen/edit', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

Route::get('/proposals', [ProposalController::class, 'index'])->name('prop.index');
Route::get('/proposals/create', [ProposalController::class, 'create'])->name('prop.create');
Route::post('/proposals', [ProposalController::class, 'store'])->name('prop.store');
Route::get('/proposals/detai/{proposal}', [ProposalController::class, 'show'])->name('prop.detail');
Route::get('/proposals/{proposal}', [ProposalController::class, 'edit'])->name('prop.edit');
Route::put('/proposals/{proposal}', [ProposalController::class, 'update'])->name('prop.update');
Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('prop.destroy');
