
<div wire:ignore.self
    class="modal fade"
    id="ModalDetailKelas"
    tabindex="-1"
    aria-labelledby="ModalDetailKelasLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-building-4-line fs-18"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="ModalDetailKelasLabel">
                            Detail Kelas
                        </h5>
                        <small class="text-muted">
                            Informasi identitas, penempatan akademik, dan ringkasan kelas.
                        </small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal"
                    aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body px-4 pt-2 pb-4">

                @if ($kelasDetail)

                    {{-- PROFILE --}}
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-building-4-line fs-24"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-1">
                            {{ $kelasDetail->nama_kelas ?: '-' }}
                        </h5>

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $kelasDetail->ms_jenjang?->nama_jenjang ?: 'Jenjang belum ditentukan' }}
                        </span>
                    </div>

                    {{-- INFORMASI KELAS --}}
                    <div class="mb-3">

                        {{-- NAMA KELAS --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Nama Kelas
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-building-4-line text-primary me-2"></i>
                                {{ $kelasDetail->nama_kelas ?: '-' }}
                            </div>
                        </div>

                        {{-- URUTAN --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Urutan Kelas
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-sort-number-asc text-info me-2"></i>
                                {{ $kelasDetail->urutan ?? '-' }}
                            </div>
                        </div>

                        {{-- JENJANG --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Jenjang Pendidikan
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-graduation-cap-line text-primary me-2"></i>
                                {{ $kelasDetail->ms_jenjang?->nama_jenjang ?: '-' }}
                            </div>
                        </div>

                        {{-- TAHUN AJARAN --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Tahun Ajaran
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-line text-success me-2"></i>
                                {{ $kelasDetail->ms_tahun_ajar?->nama_tahun_ajar ?: '-' }}
                            </div>
                        </div>

                        {{-- JUMLAH SISWA --}}
                        <div class="border rounded-4 p-3">
                            <div class="text-muted small mb-1">
                                Jumlah Siswa
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-group-line text-info me-2"></i>
                                {{ $jumlahSiswa }} siswa
                            </div>
                        </div>

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="border rounded-4 p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm flex-shrink-0">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-file-text-line"></i>
                                </div>
                            </div>

                            <div>
                                <div class="fw-semibold text-dark">
                                    Deskripsi Kelas
                                </div>
                                <small class="text-muted">
                                    Keterangan tambahan mengenai kelas.
                                </small>
                            </div>
                        </div>

                        <div class="text-muted small text-break">
                            {{ $kelasDetail->deskripsi ?: 'Tidak ada deskripsi kelas.' }}
                        </div>
                    </div>

                @endif

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
