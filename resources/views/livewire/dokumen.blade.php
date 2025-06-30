<div class="container mt-4">
    <h4>Manajemen Dokumen</h4>

    <!-- 🔍 Search -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input wire:model="search" type="text" class="form-control" placeholder="Cari jenis arsip / pemilik">
        </div>
        <div class="col-md-2">
            <button wire:click="$refresh" class="btn btn-secondary">Cari</button>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dokumenModal" wire:click="resetInput">+ Tambah Dokumen</button>
        </div>
    </div>

    <!-- 📋 Tabel Data -->
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Jenis Arsip</th>
                <th>Tanggal</th>
                <th>Nama Pemilik</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dokumens as $index => $item)
                <tr>
                    <td>{{ $dokumens->firstItem() + $index }}</td>
                    <td>{{ $item->jenis_arsip }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->namapemilik }}</td>
                    <td>
                        @if ($item->file)
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-sm btn-success">Unduh</a>
                        @endif
                    </td>
                    <td>
                        <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#dokumenModal">Edit</button>
                        <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger" onclick="confirm('Yakin hapus?') || event.stopImmediatePropagation()">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $dokumens->links() }}

    <!-- 📥 Modal Form -->
    <div wire:ignore.self class="modal fade" id="dokumenModal" tabindex="-1" aria-labelledby="dokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dokumenModalLabel">{{ $isEdit ? 'Edit' : 'Tambah' }} Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Jenis Arsip -->
                    <div class="mb-2">
                        <label>Jenis Arsip</label>
                        <select wire:model="jenis_arsip" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($arsipOptions as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_arsip') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-2">
                        <label>Tanggal</label>
                        <input wire:model="tanggal" type="date" class="form-control">
                        @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Nama Pemilik -->
                    <div class="mb-2">
                        <label>Nama Pemilik</label>
                        <select wire:model="namapemilik" class="form-control">
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach($pegawaiOptions as $nama)
                                <option value="{{ $nama }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('namapemilik') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- File -->
                    <div class="mb-2">
                        <label>File</label>
                        <input wire:model="file" type="file" class="form-control">
                        @error('file') <small class="text-danger">{{ $message }}</small> @enderror

                        @if($isEdit && $existingFile)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $existingFile) }}" target="_blank" class="btn btn-sm btn-success">File Lama</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Perbarui' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
