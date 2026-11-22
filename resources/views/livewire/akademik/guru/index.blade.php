<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header border-bottom">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="mdi mdi-account-school-outline"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Data Guru</h5>
                    <small class="text-muted">
                        Kelola data guru sebagai pegawai sekolah beserta akun pengguna untuk akses aplikasi.
                    </small>
                </div>
            </div>

            @if ($hasParameter)
                <button type="button" class="btn btn-primary rounded-pill px-4 d-inline-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#ModalAddGuru"
                    wire:click.prevent="$emit('showCreateGuru', {{ (int) $selectedJenjang }})">
                    <i class="ri-add-line"></i>
                    <span>Guru Baru</span>
                </button>
            @endif
        </div>
    </div>

    <div class="card-body">
        @if ($hasParameter)
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label for="searchGuru" class="form-label small text-muted text-uppercase fw-medium mb-2">
                        Pencarian
                    </label>
                    <div class="search-box">
                        <input type="search" id="searchGuru" class="form-control search"
                            wire:model.debounce.300ms="search"
                            placeholder="Cari nama, NIP, atau email guru...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
            </div>

            <div wire:loading.delay wire:target="search, updateParameters" class="text-muted small mb-3">
                <span class="spinner-border spinner-border-sm me-1"></span>
                Memuat data guru...
            </div>

            <div class="live-preview">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" width="40">No.</th>
                                <th scope="col" class="text-center">Hapus</th>
                                <th scope="col">Guru / Akun</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Kontak</th>
                                <th scope="col">NIP / NIK</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pegawais as $pegawai)
                                <tr wire:key="guru-{{ $pegawai->ms_pegawai_id }}">
                                    <td>{{ ($pegawais->firstItem() ?? 0) + $loop->index }}.</td>
                                    <td class="text-center">
                                        <a href="#ModalDeleteGuru" data-bs-toggle="modal"
                                            class="text-danger d-inline-block"
                                            wire:click.prevent="$emit('confirmDeleteGuru', {{ $pegawai->ms_pegawai_id }})"
                                            title="Hapus data guru">
                                            <i class="ri-delete-bin-5-fill fs-14"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $pegawai->nama_pegawai }}</span>
                                        <p class="text-muted mb-0">
                                            {{ $pegawai->akun_pengguna->email ?? $pegawai->email ?? 'Akun belum terhubung' }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $pegawai->ms_jabatan->nama_jabatan ?? 'Guru' }}</span>
                                        <p class="text-muted mb-0">{{ $pegawai->ms_jenjang->nama_jenjang ?? '-' }}</p>
                                    </td>
                                    <td>
                                        <span class="fw-medium text-success">{{ $pegawai->telepon ?: '-' }}</span>
                                        <p class="text-muted mb-0">{{ $pegawai->email ?: '-' }}</p>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $pegawai->nip ?: '-' }}</span>
                                        <p class="text-muted mb-0">{{ $pegawai->nik ?: '-' }}</p>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ strcasecmp((string) $pegawai->status, 'Aktif') === 0 ? 'success' : 'secondary' }}-subtle text-{{ strcasecmp((string) $pegawai->status, 'Aktif') === 0 ? 'success' : 'secondary' }}">
                                            {{ strcasecmp((string) $pegawai->status, 'Aktif') === 0 ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="#ModalEditGuru" data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm rounded-pill px-3"
                                                wire:click="$emit('loadDataGuru', {{ $pegawai->ms_pegawai_id }})">
                                                <i class="ri-mark-pen-line me-1"></i> Ubah
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="text-center py-4">
                                            <div class="avatar-md mx-auto mb-3">
                                                <span class="avatar-title rounded-circle bg-light text-muted fs-24">
                                                    <i class="ri-user-search-line"></i>
                                                </span>
                                            </div>
                                            <h5 class="mt-2">Belum Ada Data Guru</h5>
                                            <p class="text-muted mb-0">
                                                Tambahkan guru untuk jenjang {{ $namaJenjang ?: 'yang dipilih' }}.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="text-muted fs-13">
                            Menampilkan
                            <span class="fw-semibold">{{ $pegawais->firstItem() ?? 0 }}</span>
                            –
                            <span class="fw-semibold">{{ $pegawais->lastItem() ?? 0 }}</span>
                            dari
                            <span class="fw-semibold">{{ $pegawais->total() }}</span>
                            guru
                        </div>
                        {{ $pegawais->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary fs-24">
                        <i class="ri-filter-3-line"></i>
                    </span>
                </div>
                <h5 class="mt-2">Silakan Pilih Jenjang</h5>
                <p class="text-muted mb-0">
                    Pilih jenjang di atas untuk melihat dan mengelola data guru.
                </p>
            </div>
        @endif
    </div>
</div>
