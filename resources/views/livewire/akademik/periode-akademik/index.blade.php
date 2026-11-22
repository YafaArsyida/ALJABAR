<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header border-bottom">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="mdi mdi-calendar-range-outline"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Data Periode Akademik</h5>
                    <small class="text-muted">
                        Kelola semester dan rentang waktu pembelajaran untuk setiap jenjang dan tahun ajaran.
                    </small>
                    {{-- @if ($selectedJenjang && $selectedTahunAjar)
                        <div class="small text-primary mt-1">
                            <i class="ri-government-line me-1"></i>{{ $namaJenjang }}
                            <span class="mx-1">·</span>
                            <i class="ri-calendar-2-line me-1"></i>{{ $namaTahunAjar }}
                        </div>
                    @endif --}}
                </div>
            </div>

            @if ($selectedJenjang && $selectedTahunAjar)
                <button type="button" class="btn btn-primary rounded-pill px-4 d-inline-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#ModalAddPeriodeAkademik"
                    wire:click.prevent="$emit('showCreatePeriodeAkademik', {{ (int) $selectedJenjang }}, {{ (int) $selectedTahunAjar }})">
                    <i class="ri-add-line"></i>
                    <span>Periode Baru</span>
                </button>
            @endif
        </div>
    </div>

    <div class="card-body">
        @if ($selectedJenjang && $selectedTahunAjar)
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label for="searchPeriodeAkademik" class="form-label small text-muted text-uppercase fw-medium mb-2">
                        Pencarian
                    </label>
                    <div class="search-box">
                        <input type="search" id="searchPeriodeAkademik" class="form-control search"
                            wire:model.debounce.300ms="search"
                            placeholder="Cari nama semester atau keterangan...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
            </div>

            <div wire:loading.delay wire:target="search, updateParameters" class="text-muted small mb-3">
                <span class="spinner-border spinner-border-sm me-1"></span>
                Memuat periode akademik...
            </div>

            <div class="live-preview">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" width="40">No.</th>
                                <th scope="col" class="text-center">Hapus</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Jenjang</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">Rentang Tanggal</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($periods as $period)
                                <tr wire:key="periode-akademik-{{ $period->ms_periode_akademik_id }}">
                                    <td>{{ ($periods->firstItem() ?? 0) + $loop->index }}.</td>
                                    <td class="text-center">
                                        <a href="#ModalDeletePeriodeAkademik" data-bs-toggle="modal"
                                            class="text-danger d-inline-block"
                                            wire:click.prevent="$emit('confirmDeletePeriodeAkademik', {{ $period->ms_periode_akademik_id }})"
                                            title="Hapus periode">
                                            <i class="ri-delete-bin-5-fill fs-14"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $period->nama_periode }}</span>
                                        <p class="text-muted mb-0">Urutan {{ $period->urutan }}</p>
                                    </td>
                                    <td>{{ $period->ms_jenjang->nama_jenjang ?? '-' }}</td>
                                    <td>{{ $period->ms_tahun_ajar->nama_tahun_ajar ?? '-' }}</td>
                                    <td class="text-nowrap">
                                        {{ $period->tanggal_mulai->format('d/m/Y') }}
                                        <span class="text-muted mx-1">—</span>
                                        {{ optional($period->tanggal_selesai)->format('d/m/Y') ?? 'Belum ditentukan' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $period->status === 'AKTIF' ? 'success' : 'secondary' }}-subtle text-{{ $period->status === 'AKTIF' ? 'success' : 'secondary' }}">
                                            {{ $period->status === 'AKTIF' ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                        @if ($period->deskripsi)
                                            <p class="text-muted mb-0 mt-1">{{ $period->deskripsi }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="#ModalEditPeriodeAkademik" data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm rounded-pill px-3"
                                                wire:click="$emit('loadDataPeriodeAkademik', {{ $period->ms_periode_akademik_id }})">
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
                                                    <i class="ri-calendar-close-line"></i>
                                                </span>
                                            </div>
                                            <h5 class="mt-2">Belum Ada Periode Akademik</h5>
                                            <p class="text-muted mb-0">
                                                Tambahkan Semester 1 atau Semester 2 untuk jenjang dan tahun ajaran terpilih.
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
                            <span class="fw-semibold">{{ $periods->firstItem() ?? 0 }}</span>
                            –
                            <span class="fw-semibold">{{ $periods->lastItem() ?? 0 }}</span>
                            dari
                            <span class="fw-semibold">{{ $periods->total() }}</span>
                            periode
                        </div>
                        {{ $periods->links() }}
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
                <h5 class="mt-2">Silakan Pilih Jenjang dan Tahun Ajar</h5>
                <p class="text-muted mb-0">
                    Pilih parameter di atas untuk melihat dan mengelola periode akademik.
                </p>
            </div>
        @endif
    </div>
</div>
