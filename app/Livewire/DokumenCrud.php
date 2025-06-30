<?php

namespace App\Livewire;

use App\Models\Dokumen;
use Livewire\Component;
use App\Models\Pegawai;
use App\Models\kategori_arsips;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DokumenCrud extends Component
{
    use WithPagination, WithFileUploads;

    public $existingFile = null;
    public $jenis_arsip, $tanggal, $namapemilik, $keterangan, $file, $dokumenId, $isEdit = false, $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'jenis_arsip' => 'required|string|max:30',
        'tanggal' => 'required|date',
        'namapemilik' => 'required|string|max:50',
        'file' => 'nullable|file|max:2048',
    ];

    public function render()
    {
        $dokumens = Dokumen::where('jenis_arsip', 'like', "%{$this->search}%")
            ->orWhere('namapemilik', 'like', "%{$this->search}%")
            ->latest()->paginate(10);

        $arsipOptions = kategori_arsips::pluck('jenis');
        $pegawaiOptions = Pegawai::pluck('nama');

        return view('livewire.dokumen', compact('dokumens','arsipOptions' ,'pegawaiOptions'))
        ->layout('layouts.app');
    }

    public function store()
    {
        $this->validate();
        $filePath = $this->file ? $this->file->store('dokumen', 'public') : null;

        Dokumen::create([
            'jenis_arsip' => $this->jenis_arsip,
            'tanggal' => $this->tanggal,
            'namapemilik' => $this->namapemilik,
            'file' => $filePath,
        ]);

        $this->resetInput();
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $this->dokumenId = $dokumen->id;
        $this->jenis_arsip = $dokumen->jenis_arsip;
        $this->tanggal = $dokumen->tanggal;
        $this->namapemilik = $dokumen->namapemilik;
        $this->file = null;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        $dokumen = Dokumen::findOrFail($this->dokumenId);
        $filePath = $this->file ? $this->file->store('dokumen', 'public') : $dokumen->file;

        $dokumen->update([
            'jenis_arsip' => $this->jenis_arsip,
            'tanggal' => $this->tanggal,
            'namapemilik' => $this->namapemilik,
            'file' => $filePath,
        ]);
        $this->resetInput();
    }

    public function delete($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        if ($dokumen->file && Storage::disk('public')->exists($dokumen->file)) {
            Storage::disk('public')->delete($dokumen->file);
        }
        $dokumen->delete();
    }

    public function resetInput()
    {
        $this->reset([
            'dokumenId',
            'jenis_arsip',
            'tanggal',
            'namapemilik',
            'file',
            'isEdit',
        ]);
    }
}
