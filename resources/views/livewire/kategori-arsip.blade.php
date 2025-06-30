<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title mb-0">{{ $isEdit ? 'Edit Kategori Arsip' : 'Tambah Kategori Arsip' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Kategori</label>
                    <input type="text" wire:model="jenis" id="jenis" class="form-control" placeholder="Contoh: SK Pengangkatan">
                    @error('jenis') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>

                @if($isEdit)
                <button type="button" wire:click="resetInput" class="btn btn-secondary ms-2">
                    Batal
                </button>
                @endif
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="card-title mb-0">Daftar Kategori Arsip</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th>Jenis</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>
                            <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-primary">
                                Edit
                            </button>
                            <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger ms-1">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
