
<div wire:ignore.self class="modal fade" id="ModalDetailGelombang" tabindex="-1"
    aria-labelledby="ModalDetailGelombangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-calendar-event-line fs-18"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="ModalDetailGelombangLabel">
                            Detail Gelombang SPMB
                        </h5>
                        <small class="text-muted">
                            Informasi gelombang, jadwal pendataan, kuota, dan biaya SPMB.
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
                @if ($gelombangDetail)

                    {{-- IDENTITAS GELOMBANG --}}
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                <i class="ri-calendar-event-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2">
                            {{ $gelombangDetail->nama_gelombang ?: '-' }}
                        </h5>

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $gelombangDetail->ppdb_periode?->nama_periode ?: '-' }}
                        </span>
                    </div>

                    {{-- INFORMASI GELOMBANG --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-information-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Informasi Gelombang</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Nama Gelombang</div>
                            <div class="fw-medium text-dark text-break">
                                {{ $gelombangDetail->nama_gelombang ?: '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Periode SPMB</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-line text-muted me-1"></i>
                                {{ $gelombangDetail->ppdb_periode?->nama_periode ?: '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Jenjang Pendidikan</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-school-line text-muted me-1"></i>
                                {{ $gelombangDetail->ppdb_periode?->ms_jenjang?->nama_jenjang ?: '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- JADWAL PENDATAAN --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-info-subtle text-info rounded-circle">
                                    <i class="ri-calendar-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Jadwal Pendataan</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Tanggal Mulai</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-check-line text-muted me-1"></i>
                                {{ $gelombangDetail->tanggal_mulai
                                    ? \Carbon\Carbon::parse($gelombangDetail->tanggal_mulai)->translatedFormat('d F Y')
                                    : '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Tanggal Selesai</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-close-line text-muted me-1"></i>
                                {{ $gelombangDetail->tanggal_selesai
                                    ? \Carbon\Carbon::parse($gelombangDetail->tanggal_selesai)->translatedFormat('d F Y')
                                    : '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Durasi Pendataan</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-time-line text-muted me-1"></i>
                                @if ($gelombangDetail->tanggal_mulai && $gelombangDetail->tanggal_selesai)
                                    {{ \Carbon\Carbon::parse($gelombangDetail->tanggal_mulai)
                                        ->diffInDays(\Carbon\Carbon::parse($gelombangDetail->tanggal_selesai)) + 1 }}
                                    hari kalender
                                @else
                                    -
                                @endif
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
                            <div class="text-muted small mb-1">Kuota Penerimaan</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-group-line text-muted me-1"></i>
                                {{ number_format($gelombangDetail->kuota ?? 0, 0, ',', '.') }} siswa
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Biaya SPMB</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-money-rupiah-circle-line text-muted me-1"></i>
                                Rp {{ number_format((float) $gelombangDetail->biaya_pendaftaran, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- STATUS GELOMBANG --}}
                    <div class="border rounded-4 p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                    <i class="ri-toggle-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Status Gelombang</h6>
                        </div>

                        <div class="text-muted small mb-2">Status</div>

                        @if ($gelombangDetail->status === 'aktif')
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
                                <i class="ri-calendar-event-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-semibold mb-1">
                            Data Gelombang Tidak Ditemukan
                        </h5>
                        <p class="text-muted small mb-0">
                            Gelombang yang dipilih tidak tersedia atau telah dihapus.
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
