
{{-- MODAL DETAIL SISWA EKSTRAKURIKULER --}}
<div wire:ignore.self class="modal fade" id="detailSiswaEkstrakurikuler" tabindex="-1"
    aria-labelledby="detailSiswaEkstrakurikulerLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-user-star-line fs-18"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="detailSiswaEkstrakurikulerLabel">
                            Detail Peserta
                        </h5>
                        <small class="text-muted">
                            Informasi siswa dan keikutsertaan ekstrakurikuler.
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

                {{-- PROFILE SISWA --}}
                <div class="text-center mb-4">
                    <div class="avatar-lg mx-auto mb-3">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-user-3-line fs-24"></i>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-1">
                        {{ $nama_siswa ?: '-' }}
                    </h5>

                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                        Peserta Ekstrakurikuler
                    </span>
                </div>

                {{-- INFORMASI PESERTA --}}
                <div class="mb-3">

                    {{-- KELAS --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="text-muted small mb-1">
                            Kelas
                        </div>
                        <div class="fw-medium text-dark">
                            <i class="ri-graduation-cap-line text-primary me-2"></i>
                            {{ $nama_kelas ?: '-' }}
                        </div>
                    </div>

                    {{-- EKSTRAKURIKULER --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="text-muted small mb-1">
                            Ekstrakurikuler
                        </div>
                        <div class="fw-medium text-dark">
                            <i class="ri-trophy-line text-info me-2"></i>
                            @if ($ekstrakurikulerSiswa)
                                {{ $ekstrakurikulerSiswa->ms_ekstrakurikuler->nama_ekstrakurikuler ?? '-' }}
                            @else
                                Belum memilih
                            @endif
                        </div>
                    </div>

                    {{-- BIAYA --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="text-muted small mb-1">
                            Biaya Ekstrakurikuler
                        </div>
                        <div class="fw-medium text-dark">
                            <i class="ri-money-dollar-circle-line text-success me-2"></i>
                            @if ($ekstrakurikulerSiswa)
                                Rp{{ number_format($ekstrakurikulerSiswa->ms_ekstrakurikuler->biaya ?? 0, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    {{-- TANGGAL TERDAFTAR --}}
                    <div class="border rounded-4 p-3">
                        <div class="text-muted small mb-1">
                            Tanggal Terdaftar
                        </div>
                        <div class="fw-medium text-dark">
                            <i class="ri-calendar-check-line text-warning me-2"></i>
                            {{ $created_at ?: '-' }}
                        </div>
                    </div>

                </div>
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
