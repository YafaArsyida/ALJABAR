<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-transparent border-bottom p-3 p-lg-4">
        <div class="d-flex align-items-center flex-wrap gap-3">

            {{-- INFORMASI --}}
            <div class="d-flex align-items-center gap-3 flex-grow-1">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="ri-user-line"></i>
                    </div>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Akses Petugas SPMB</h5>
                    <small class="text-muted">
                        Kelola akun petugas dan hak akses jenjang pendidikan.
                    </small>
                </div>
            </div>

            {{-- TOMBOL --}}
            <button type="button"
                class="btn btn-primary rounded-pill px-4 flex-shrink-0"
                wire:click="$emit('showCreatePetugas')">
                <i class="ri-user-add-line me-1"></i>
                Tambah Petugas
            </button>

        </div>
    </div>

    <div class="card-body">
        <div class="row g-3 mb-3">
            <div class="col-12">
                <label for="searchAksesPetugas" class="form-label small text-muted text-uppercase fw-medium mb-2">
                    Pencarian
                </label>
                <div class="search-box">
                    <input
                        type="search"
                        id="searchAksesPetugas"
                        class="form-control search"
                        wire:model.debounce.300ms="search"
                        placeholder="Cari nama, email, atau peran..."
                    >
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-nowrap align-middle">
                <thead class="table-light">
                    <tr class="text-uppercase">
                        <th class="text-center" width="60">No.</th>
                        <th>Nama Petugas</th>
                        <th>Email / Username</th>
                        <th>Peran</th>
                        <th>Akses Jenjang</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengguna as $user)
                        <tr wire:key="akses-petugas-{{ $user->ms_pengguna_id }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->peran === 'SUPERADMIN' ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }}">
                                    {{ $user->peran }}
                                </span>
                            </td>
                            <td>
                                @forelse ($user->ms_jenjang as $jenjang)
                                    <span class="badge bg-light text-body me-1 mb-1">
                                        {{ $jenjang->nama_jenjang }}
                                    </span>
                                @empty
                                    <span class="text-muted">Belum memiliki akses jenjang</span>
                                @endforelse
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button
                                        type="button"
                                        class="btn btn-soft-primary btn-sm rounded-pill px-3"
                                        wire:click="$emit('showDetailPetugas', {{ $user->ms_pengguna_id }})"
                                    >
                                        <i class="ri-eye-line me-1"></i>
                                        Detail
                                    </button>
                                    @if ($user->peran === 'PETUGAS_PPDB')
                                        <button
                                            type="button"
                                            class="btn btn-primary btn-sm rounded-pill px-3"
                                            wire:click="$emit('editPetugas', {{ $user->ms_pengguna_id }})"
                                        >
                                            <i class="ri-edit-line me-1"></i>
                                            Edit
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-soft-danger btn-sm rounded-pill px-3"
                                            wire:click="$emit('confirmDeletePetugas', {{ $user->ms_pengguna_id }})"
                                        >
                                            <i class="ri-delete-bin-line me-1"></i>
                                            Hapus
                                        </button>
                                    @endif
                                    <button
                                        type="button"
                                        class="btn btn-soft-secondary btn-sm rounded-pill px-3"
                                        wire:click="$emit('editAksesPetugas', {{ $user->ms_pengguna_id }})"
                                    >
                                        <i class="ri-building-line me-1"></i>
                                        Akses
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center py-5">
                                    <i class="ri-user-search-line fs-1 text-muted"></i>
                                    <h6 class="mt-2 mb-1">Petugas Tidak Ditemukan</h6>
                                    <p class="text-muted mb-0">
                                        Tidak ada akun SUPERADMIN atau PETUGAS_PPDB yang sesuai dengan pencarian.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
