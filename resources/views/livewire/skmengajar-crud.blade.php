<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top">
            <h4 class="mb-0">📄 Manajemen SK Mengajar</h4>
            <input wire:model="search" type="text" class="form-control w-25" placeholder="🔍 Cari Prodi / Semester">
        </div>

        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Prodi</label>
                        <input type="text" wire:model.defer="prodi" class="form-control" placeholder="Contoh: Informatika">
                        @error('prodi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Semester</label>
                        <input type="text" wire:model.defer="semester" class="form-control" placeholder="Contoh: Genap 2025">
                        @error('semester') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal SK</label>
                        <input type="date" wire:model.defer="tanggal" class="form-control">
                        @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Unggah File (PDF / DOC)</label>
                        <input type="file" wire:model="file" class="form-control">
                        @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button class="btn btn-{{ $isEdit ? 'warning' : 'success' }} w-100">
                            <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-save' }} me-1"></i>
                            {{ $isEdit ? 'Update Data' : 'Simpan Data' }}
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-primary text-center">
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
                        @forelse ($data as $index => $item)
                        <tr>
                            <td class="text-center">{{ $data->firstItem() + $index }}</td>
                            <td>{{ $item->prodi }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td class="text-center">
                                @if($item->file)
                                    <a href="{{ Storage::url($item->file) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Kosong</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data SK Mengajar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
