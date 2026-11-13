
<div wire:ignore.self class="modal fade" id="ModalDetailJalur" tabindex="-1"
    aria-labelledby="ModalDetailJalurLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-git-branch-line fs-18"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="ModalDetailJalurLabel">
                            Detail Jalur Seleksi SPMB
                        </h5>
                        <small class="text-muted">
                            Informasi jalur seleksi, kuota, biaya, dan periode SPMB.
                        </small>
                    </div>
                </div>

                <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body px-4 pt-2 pb-4">
                @if ($jalurDetail)

                    {{-- IDENTITAS JALUR --}}
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                <i class="ri-git-branch-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2">
                            {{ $jalurDetail->nama_jalur ?: '-' }}
                        </h5>

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $jalurDetail->kode_jalur ?: '-' }}
                        </span>
                    </div>

                    {{-- INFORMASI JALUR --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-information-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Informasi Jalur</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Kode Jalur</div>
                            <div class="fw-medium text-dark text-break">
                                {{ $jalurDetail->kode_jalur ?: '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Nama Jalur</div>
                            <div class="fw-medium text-dark text-break">
                                {{ $jalurDetail->nama_jalur ?: '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Deskripsi</div>
                            <div class="text-dark text-break" style="white-space: pre-line;">
                                {{ filled($jalurDetail->deskripsi) ? $jalurDetail->deskripsi : '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- PERIODE SPMB --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-info-subtle text-info rounded-circle">
                                    <i class="ri-calendar-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Periode SPMB</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Nama Periode</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-event-line text-muted me-1"></i>
                                {{ $jalurDetail->ppdb_periode?->nama_periode ?: '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Jenjang Pendidikan</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-school-line text-muted me-1"></i>
                                {{ $jalurDetail->ppdb_periode?->ms_jenjang?->nama_jenjang ?: '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- KUOTA DAN BIAYA --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                    <i class="ri-wallet-3-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Kuota dan Biaya</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Kuota Calon Siswa</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-group-line text-muted me-1"></i>
                                {{ number_format($jalurDetail->kuota ?? 0, 0, ',', '.') }} siswa
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Biaya SPMB</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-money-rupiah-circle-line text-muted me-1"></i>
                                Rp {{ number_format((float) $jalurDetail->biaya_pendaftaran, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- STATUS JALUR --}}
                    <div class="border rounded-4 p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                    <i class="ri-toggle-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Status Jalur</h6>
                        </div>

                        <div class="text-muted small mb-2">Status</div>

                        @if (in_array($jalurDetail->status, ['Aktif', 1, '1', true], true))
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                <i class="ri-checkbox-circle-line me-1"></i>
                                Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                                <i class="ri-close-circle-line me-1"></i>
                                Tidak Aktif
                            </span>
                        @endif
                    </div>

                @else
                    {{-- EMPTY STATE --}}
                    <div class="text-center py-5 px-3">
                        <div class="avatar-md mx-auto mb-3">
                            <div class="avatar-title bg-light text-muted rounded-circle fs-24">
                                <i class="ri-git-branch-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-semibold mb-1">
                            Data Jalur Tidak Ditemukan
                        </h5>
                        <p class="text-muted small mb-0">
                            Jalur yang dipilih tidak tersedia atau telah dihapus.
                        </p>
                    </div>
                @endif
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
