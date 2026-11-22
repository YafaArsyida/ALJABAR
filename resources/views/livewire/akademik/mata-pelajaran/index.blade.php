<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header border-bottom">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="mdi mdi-book-open-page-variant-outline"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Data Mata Pelajaran</h5>
                    <small class="text-muted">
                        Kelola mata pelajaran berdasarkan jenjang untuk kebutuhan kurikulum dan pengajaran.
                    </small>
                    {{-- @if ($selectedJenjang)
                        <div class="small text-primary mt-1">
                            <i class="ri-government-line me-1"></i>{{ $namaJenjang }}
                        </div>
                    @endif --}}
                </div>
            </div>

            @if ($selectedJenjang)
                <button type="button" class="btn btn-primary rounded-pill px-4 d-inline-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#ModalAddMataPelajaran"
                    wire:click.prevent="$emit('showCreateMataPelajaran', {{ (int) $selectedJenjang }})">
                    <i class="ri-add-line"></i>
                    <span>Mata Pelajaran Baru</span>
                </button>
            @endif
        </div>
    </div>

    <div class="card-body">
        @if ($selectedJenjang)
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label for="searchMataPelajaran" class="form-label small text-muted text-uppercase fw-medium mb-2">
                        Pencarian
                    </label>
                    <div class="search-box">
                        <input type="search" id="searchMataPelajaran" class="form-control search"
                            wire:model.debounce.300ms="search"
                            placeholder="Cari nama, kode, atau keterangan mata pelajaran...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
            </div>

            <div wire:loading.delay wire:target="search, updateParameters" class="text-muted small mb-3">
                <span class="spinner-border spinner-border-sm me-1"></span>
                Memuat mata pelajaran...
            </div>

            <div class="live-preview">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" width="40">No.</th>
                                <th scope="col" class="text-center">Hapus</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Jenjang</th>
                                <th scope="col">Urutan</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr wire:key="mata-pelajaran-{{ $subject->ms_mata_pelajaran_id }}">
                                    <td>{{ ($subjects->firstItem() ?? 0) + $loop->index }}.</td>
                                    <td class="text-center">
                                        <a href="#ModalDeleteMataPelajaran" data-bs-toggle="modal"
                                            class="text-danger d-inline-block"
                                            wire:click.prevent="$emit('confirmDeleteMataPelajaran', {{ $subject->ms_mata_pelajaran_id }})"
                                            title="Hapus mata pelajaran">
                                            <i class="ri-delete-bin-5-fill fs-14"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-body">
                                            {{ $subject->kode_mapel ?: '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $subject->nama_mapel }}</span>
                                        @if ($subject->deskripsi)
                                            <p class="text-muted mb-0">{{ $subject->deskripsi }}</p>
                                        @endif
                                    </td>
                                    <td>{{ $subject->ms_jenjang->nama_jenjang ?? '-' }}</td>
                                    <td>{{ $subject->urutan }}</td>
                                    <td>
                                        <span class="badge bg-{{ $subject->status === 'AKTIF' ? 'success' : 'secondary' }}-subtle text-{{ $subject->status === 'AKTIF' ? 'success' : 'secondary' }}">
                                            {{ $subject->status === 'AKTIF' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="#ModalEditMataPelajaran" data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm rounded-pill px-3"
                                                wire:click="$emit('loadDataMataPelajaran', {{ $subject->ms_mata_pelajaran_id }})">
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
                                                    <i class="ri-book-2-line"></i>
                                                </span>
                                            </div>
                                            <h5 class="mt-2">Belum Ada Mata Pelajaran</h5>
                                            <p class="text-muted mb-0">
                                                Tambahkan mata pelajaran untuk jenjang {{ $namaJenjang ?: 'yang dipilih' }}.
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
                            <span class="fw-semibold">{{ $subjects->firstItem() ?? 0 }}</span>
                            –
                            <span class="fw-semibold">{{ $subjects->lastItem() ?? 0 }}</span>
                            dari
                            <span class="fw-semibold">{{ $subjects->total() }}</span>
                            mata pelajaran
                        </div>
                        {{ $subjects->links() }}
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
                    Pilih jenjang di atas untuk melihat dan mengelola mata pelajaran.
                </p>
            </div>
        @endif
    </div>
</div>
