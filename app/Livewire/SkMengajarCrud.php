<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\SkMengajar;
use Illuminate\Support\Facades\Storage;

class SkMengajarCrud extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public string $prodi = '';
    public string $semester = '';
    public string $tanggal = '';
    public $file;
    public ?int $skMengajarId = null;
    public bool $isEdit = false;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'prodi' => 'required|max:30',
            'semester' => 'required|max:30',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|max:2048',
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = SkMengajar::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('prodi', 'like', '%' . $this->search . '%')
                  ->orWhere('semester', 'like', '%' . $this->search . '%')
                  ->orWhere('tanggal', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.sk-mengajar', [
            'skMengajars' => $query->latest()->paginate(5),
        ])->layout('layouts.app');
    }

    public function searchSkMengajar()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        $path = $this->file ? $this->file->store('sk_mengajar_files', 'public') : null;

        SkMengajar::create([
            'prodi' => $this->prodi,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file' => $path,
        ]);

        $this->resetInput();
        session()->flash('message', 'Data berhasil disimpan.');
    }

    public function edit(int $id)
    {
        $skMengajar = SkMengajar::findOrFail($id);
        $this->skMengajarId = $skMengajar->id;
        $this->prodi = $skMengajar->prodi;
        $this->semester = $skMengajar->semester;
        $this->tanggal = $skMengajar->tanggal;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $skMengajar = SkMengajar::findOrFail($this->skMengajarId);

        if ($this->file && $skMengajar->file && Storage::disk('public')->exists($skMengajar->file)) {
            Storage::disk('public')->delete($skMengajar->file);
        }

        $path = $this->file ? $this->file->store('sk_mengajar_files', 'public') : $skMengajar->file;

        $skMengajar->update([
            'prodi' => $this->prodi,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file' => $path,
        ]);

        $this->resetInput();
        session()->flash('message', 'Data berhasil diupdate.');
    }

    public function delete(int $id)
    {
        $skMengajar = SkMengajar::findOrFail($id);

        if ($skMengajar->file && Storage::disk('public')->exists($skMengajar->file)) {
            Storage::disk('public')->delete($skMengajar->file);
        }

        $skMengajar->delete();
        session()->flash('message', 'Data berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->prodi = '';
        $this->semester = '';
        $this->tanggal = '';
        $this->file = null;
        $this->skMengajarId = null;
        $this->isEdit = false;
    }
}
