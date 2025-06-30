<div class="container mt-4">
    <h4 class="mb-3 fw-bold text-primary">📋 Manajemen Data Pegawai</h4>

    <!-- 🔍 Search Field -->
    <div class="input-group mb-4 shadow-sm">
        <input type="text" wire:model.defer="search" class="form-control" placeholder="🔎 Cari berdasarkan semua kolom...">
        <button class="btn btn-outline-primary" wire:click="$refresh">
            Cari
        </button>
    </div>

    <!-- 🔘 Tambah Button -->
    <button class="btn btn-primary mb-3 shadow" data-bs-toggle="modal" data-bs-target="#pegawaiModal" wire:click="resetInput">
        ➕ Tambah Pegawai
    </button>

    <!-- 🧾 Table -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>NIK / NIP</th>
                    <th>NIDN</th>
                    <th>NUPTK</th>
                    <th>Nama</th>
                    <th>Status Pegawai</th>
                    <th>Status Nikah</th>
                    <th>Tgl Lahir</th>
                    <th>JK</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Unit Kerja</th>
                    <th>NPWP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pegawais as $index => $pegawai)
                    <tr>
                        <td class="text-center">{{ $pegawais->firstItem() + $index }}</td>
                        <td>{{ $pegawai->NIK_NIP }}</td>
                        <td>{{ $pegawai->NIDN }}</td>
                        <td>{{ $pegawai->NUPTK }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->status_pegawai }}</td>
                        <td>{{ $pegawai->status_nikah }}</td>
                        <td>{{ $pegawai->tanggal_lahir }}</td>
                        <td>{{ $pegawai->sex }}</td>
                        <td>{{ $pegawai->telp }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td>{{ $pegawai->unit_kerja }}</td>
                        <td>{{ $pegawai->NPWP }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning me-1" wire:click="edit({{ $pegawai->id }})"
                                data-bs-toggle="modal" data-bs-target="#pegawaiModal">✏️ Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $pegawai->id }})"
                                onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()">🗑️ Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center text-muted">📭 Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $pegawais->links() }}
    </div>

    <!-- 🧾 Modal -->
    <div wire:ignore.self class="modal fade" id="pegawaiModal" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">{{ $isEdit ? 'Edit Pegawai' : 'Tambah Pegawai' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row g-3">
                        @foreach ([
                            'NIK_NIP' => 'NIK / NIP',
                            'NIDN' => 'NIDN',
                            'NUPTK' => 'NUPTK',
                            'nama' => 'Nama',
                            'status_pegawai' => 'Status Pegawai',
                            'status_nikah' => 'Status Nikah',
                            'tanggal_lahir' => 'Tanggal Lahir',
                            'sex' => 'Jenis Kelamin',
                            'telp' => 'Telepon',
                            'email' => 'Email',
                            'alamat' => 'Alamat',
                            'unit_kerja' => 'Unit Kerja',
                            'NPWP' => 'NPWP'
                        ] as $field => $label)
                            <div class="col-md-{{ $field === 'alamat' ? '12' : '6' }}">
                                <label class="form-label fw-semibold">{{ $label }}</label>
                                @if ($field === 'alamat')
                                    <textarea wire:model.defer="{{ $field }}" class="form-control" rows="2"></textarea>
                                @elseif ($field === 'sex')
                                    <select wire:model.defer="sex" class="form-select">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                @elseif ($field === 'tanggal_lahir')
                                    <input type="date" wire:model.defer="{{ $field }}" class="form-control">
                                @elseif ($field === 'email')
                                    <input type="email" wire:model.defer="{{ $field }}" class="form-control">
                                @else
                                    <input type="text" wire:model.defer="{{ $field }}" class="form-control">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click="resetInput">Batal</button>
                        <button type="submit" class="btn btn-success">{{ $isEdit ? '💾 Update' : '✅ Simpan' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('pegawaiModal'));
            modal.hide();
        });

        window.addEventListener('open-modal', () => {
            const modal = new bootstrap.Modal(document.getElementById('pegawaiModal'));
            modal.show();
        });
    </script>
@endpush
