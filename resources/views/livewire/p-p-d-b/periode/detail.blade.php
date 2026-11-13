
<div wire:ignore.self class="modal fade" id="ModalDetailPeriode" tabindex="-1"
    aria-labelledby="ModalDetailPeriodeLabel" aria-hidden="true">
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
                        <h5 class="modal-title fw-bold mb-1" id="ModalDetailPeriodeLabel">
                            Detail Periode SPMB
                        </h5>
                        <small class="text-muted">
                            Informasi periode, jadwal pendataan, dan gelombang SPMB.
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
                @if ($periodeDetail)

                    {{-- IDENTITAS PERIODE --}}
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                <i class="ri-calendar-event-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2">
                            {{ $periodeDetail->nama_periode ?: '-' }}
                        </h5>

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $periodeDetail->ms_jenjang?->nama_jenjang ?: '-' }}
                        </span>
                    </div>

                    {{-- INFORMASI PERIODE --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-information-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Informasi Periode</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Nama Periode</div>
                            <div class="fw-medium text-dark text-break">
                                {{ $periodeDetail->nama_periode ?: '-' }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Jenjang Pendidikan</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-school-line text-muted me-1"></i>
                                {{ $periodeDetail->ms_jenjang?->nama_jenjang ?: '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Keterangan</div>
                            <div class="text-dark text-break">
                                {{ $periodeDetail->deskripsi ?: '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- TAUTAN GRUP WHATSAPP --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                    <i class="ri-whatsapp-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Grup WhatsApp</h6>
                        </div>

                        <div class="text-muted small mb-1">Tautan Grup WhatsApp</div>
                        <div class="fw-medium text-dark text-break">
                            @if ($periodeDetail->tautan_grup)
                                @php
                                    $skemaTautanGrup = strtolower(
                                        (string) parse_url(
                                            $periodeDetail->tautan_grup,
                                            PHP_URL_SCHEME
                                        )
                                    );
                                @endphp

                                @if (in_array($skemaTautanGrup, ['http', 'https'], true))
                                    <a href="{{ $periodeDetail->tautan_grup }}"
                                        target="_blank" rel="noopener noreferrer">
                                        {{ $periodeDetail->tautan_grup }}
                                        <i class="ri-external-link-line ms-1"></i>
                                    </a>
                                @else
                                    {{ $periodeDetail->tautan_grup }}
                                @endif
                            @else
                                <span class="text-muted">Belum diatur</span>
                            @endif
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
                                {{ $periodeDetail->tanggal_mulai
                                    ? \Carbon\Carbon::parse($periodeDetail->tanggal_mulai)->translatedFormat('d F Y')
                                    : '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Tanggal Selesai</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-close-line text-muted me-1"></i>
                                {{ $periodeDetail->tanggal_selesai
                                    ? \Carbon\Carbon::parse($periodeDetail->tanggal_selesai)->translatedFormat('d F Y')
                                    : '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- RINGKASAN PERIODE --}}
                    <div class="border rounded-4 p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                    <i class="ri-bar-chart-box-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Ringkasan Periode</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Jumlah Gelombang</div>
                            <div class="fw-medium text-dark">
                                <i class="ri-stack-line text-muted me-1"></i>
                                {{ $periodeDetail->ppdb_gelombang_count }} gelombang
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Status Periode</div>
                            <div>
                                @if ($periodeDetail->status === 'aktif')
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
                        </div>
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
                            Data Periode Tidak Ditemukan
                        </h5>
                        <p class="text-muted small mb-0">
                            Periode yang dipilih tidak tersedia atau telah dihapus.
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
