<div class="container mt-5">
    <h2>Manajemen SK Mengajar</h2>

    <!-- 🔍 Search -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input wire:model.debounce.500ms="search" type="text" class="form-control" placeholder="Cari prodi / semester">
        </div>
        <div class="col-md-2">
            <button wire:click="searchSkMengajar" class="btn btn-secondary">Cari</button>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#skMengajarModal" wire:click="resetInput">+ Tambah Prodi</button>
        </div>
    </div>

    <!-- 📥 Modal Form -->
    <div wire:ignore.self class="modal fade" id="skMengajarModal" tabindex="-1" aria-labelledby="skMengajarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skMengajarModalLabel">{{ $isEdit ? 'Edit SK Mengajar' : 'Tambah SK Mengajar' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="prodi" class="form-label">Prodi</label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                   wire:model="prodi" id="prodi">
                            @error('prodi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" class="form-control @error('semester') is-invalid @enderror"
                                   wire:model="semester" id="semester">
                            @error('semester') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input wire:model="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal">
                            @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="file" class="form-label">File</label>
                            <input wire:model="file" type="file" class="form-control @error('file') is-invalid @enderror" id="file">
                            @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                            @if($isEdit && $file)
                                <div class="mt-2">
                                    <a href="{{ Storage::url($file) }}" target="_blank" class="btn btn-sm btn-success">File Lama</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetInput">Tutup</button>
                    <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Perbarui' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Prodi</th>
                        <th>Semester</th>
                        <th>Tanggal</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skMengajars as $index => $item)
                        <tr>
                            <td>{{ $skMengajars->firstItem() + $index }}</td>
                            <td>{{ $item->prodi }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>
                                @if($item->file)
                                    <a href="{{ Storage::url($item->file) }}" class="btn btn-sm btn-info">Unduh</a>
                                @endif
                            </td>
                            <td>
                                <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#skMengajarModal">Edit</button>
                                <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $skMengajars->links() }}
        </div>
    </div>
</div>
