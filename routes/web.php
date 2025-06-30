<?php

use App\Livewire\SuratCrud;
use App\Livewire\Dashboard;
use App\Livewire\DokumenCrud;
use App\Livewire\PegawaiCrud;
use App\Livewire\KategoriArsip;
use App\Livewire\SkMengajarCrud;
use Illuminate\Support\Facades\Route;


Route::get('/', Dashboard::class);
Route::get('/kategori-arsip', KategoriArsip::class)->name('kategori-arsip');
Route::get('/dokumen', DokumenCrud::class)->name('dokumen');
Route::get('/pegawai', PegawaiCrud::class)->name('pegawai');
Route::get('/surat', SuratCrud::class)->name('surat');
Route::get('/sk-mengajar', SkMengajarCrud::class)->name('sk-mengajar');
