<div class="container mt-4">
    <h4>Manajemen Surat</h4>

    <!-- 🔍 Search manual -->
    <div class="row mb-3">
        <div class="col-md-10">
            <input type="text" wire:model.defer="search" class="form-control"
                placeholder="Cari berdasarkan jenis, tanggal, tujuan, atau keterangan">
        </div>
        <div class="col-md-2">
            <button wire:click="searchSurat" class="btn btn-info w-100">Cari / Refresh</button>
        </div>
    </div>

    <hr>

    <!-- 📝 Form Input -->
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <label>Jenis Surat</label>
            <select wire:model="jenis_surat" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Surat Masuk">Surat Masuk</option>
                <option value="Surat Keluar">Surat Keluar</option>
                <option value="Surat Lainya">Surat Lainya</option>
            </select>
            @error('jenis_surat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-2">
            <label>No Surat</label>
            <input type="text" wire:model="no_surat" class="form-control">
            @error('no_surat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-2">
            <label>Tanggal</label>
            <input type="date" wire:model="tanggal" class="form-control">
            @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-3">
            <label>Tujuan</label>
            <input type="text" wire:model="tujuan" class="form-control">
            @error('tujuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-6">
            <label>Keterangan</label>
            <input type="text" wire:model="keterangan" class="form-control">
            @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-4">
            <label>Upload File</label>
            <input type="file" wire:model="file" class="form-control">
            @error('file') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                {{ $isEdit ? 'Update' : 'Simpan' }}
            </button>
        </div>

        @if($isEdit)
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" wire:click="resetInput" class="btn btn-secondary w-100">Batal</button>
            </div>
        @endif
    </form>

    <!-- 📋 Tabel Data -->
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>No Surat</th>
                <th>Tanggal</th>
                <th>Tujuan</th>
                <th>Keterangan</th>
                <th>File</th>
                <th>Aksi</th>
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
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click="edit({{ $item->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 📄 Pagination -->
    {{ $surats->links() }}
</div>
