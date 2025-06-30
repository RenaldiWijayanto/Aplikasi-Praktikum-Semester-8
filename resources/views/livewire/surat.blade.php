<div class="container mt-5">
    <h4 class="mb-4">Manajemen Surat</h4>

    <!-- 🔍 Search Bar -->
    <div class="row mb-4">
        <div class="col-md-9 col-sm-12">
            <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Cari berdasarkan jenis, tanggal, tujuan, atau keterangan">
        </div>
        <div class="col-md-3 col-sm-12 mt-md-0 mt-2">
            <button wire:click="searchSurat" class="btn btn-primary w-100">Cari / Refresh</button>
        </div>
    </div>
    <hr>

    <!-- 📝 Form Input -->
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store'}}" class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <label for="jenis_surat" class="form-label">Jenis Surat</label>
            <select wire:model="jenis_surat" class="form-control" id="jenis_surat">
                <option value="">-- Pilih --</option>
                <option value="Surat Masuk">Surat Masuk</option>
                <option value="Surat Keluar">Surat Keluar</option>
                <option value="Surat Lainnya">Surat Lainnya</option>
            </select>
            @error('jenis_surat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="no_surat" class="form-label">No Surat</label>
            <input type="text" wire:model="no_surat" class="form-control" id="no_surat">
            @error('no_surat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" wire:model="tanggal" class="form-control" id="tanggal">
            @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" wire:model="tujuan" class="form-control" id="tujuan">
            @error('tujuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" wire:model="keterangan" class="form-control" id="keterangan">
            @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="file" class="form-label">Upload File</label>
            <input type="file" wire:model="file" class="form-control" id="file">
            @error('file') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-2 col-sm-6 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        </div>
        @if($isEdit)
        <div class="col-md-2 col-sm-6 d-flex align-items-end">
            <button type="button" wire:click="resetInput" class="btn btn-secondary w-100">Batal</button>
        </div>
        @endif
    </form>

    <!-- 📋 Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">No Surat</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">File</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $index => $item)
                <tr>
                    <td>{{ $surats->firstItem() + $index }}</td>
                    <td>{{ $item->jenis_surat }}</td>
                    <td>{{ $item->no_surat }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->tujuan }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        @if($item->file)
                        <a href="{{ asset('storage/' . $item->file) }}" class="btn btn-sm btn-success" target="_blank">Unduh</a>
                        @else
                        <span class="text-muted">Tidak ada file</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-info" wire:click="edit({{ $item->id }})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 📄 Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $surats->links() }}
    </div>
</div>
