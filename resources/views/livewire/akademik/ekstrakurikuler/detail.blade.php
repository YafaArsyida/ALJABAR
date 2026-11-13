
{{-- MODAL DETAIL EKSTRAKURIKULER --}}
<div wire:ignore.self class="modal fade" id="detailEkstrakurikuler" tabindex="-1"
    aria-labelledby="detailEkstrakurikulerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-trophy-line fs-18"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="detailEkstrakurikulerLabel">
                            Detail Ekstrakurikuler
                        </h5>
                        <small class="text-muted">
                            Informasi identitas, penyelenggaraan, biaya, dan kapasitas ekstrakurikuler.
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
            <div class="modal-body">
                @if ($ekstrakurikuler)

                    {{-- PROFIL EKSTRAKURIKULER --}}
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-trophy-line fs-24"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-1">
                            {{ $ekstrakurikuler->nama_ekstrakurikuler }}
                        </h5>

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            Ekstrakurikuler
                        </span>
                    </div>

                    {{-- INFORMASI UMUM --}}
                    <div class="mb-3">

                        {{-- JENJANG --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Jenjang Pendidikan
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-school-line text-primary me-2"></i>
                                {{ $ekstrakurikuler->ms_jenjang?->nama_jenjang ?: '-' }}
                            </div>
                        </div>

                        {{-- TAHUN AJARAN --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Tahun Ajaran
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-calendar-line text-success me-2"></i>
                                {{ $ekstrakurikuler->ms_tahun_ajar?->nama_tahun_ajar ?: '-' }}
                            </div>
                        </div>

                        {{-- BIAYA --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Biaya Ekstrakurikuler
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-money-dollar-circle-line text-warning me-2"></i>
                                Rp{{ number_format($ekstrakurikuler->biaya ?? 0, 0, ',', '.') }}
                            </div>
                        </div>

                        {{-- KUOTA --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Kuota Peserta
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-group-line text-info me-2"></i>
                                {{ $ekstrakurikuler->kuota ?? 0 }} siswa
                            </div>
                        </div>

                        {{-- TERDAFTAR --}}
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">
                                Jumlah Siswa Terdaftar
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-user-follow-line text-primary me-2"></i>
                                {{ $ekstrakurikuler->total_peserta ?? 0 }} siswa
                            </div>
                        </div>

                        {{-- SISA KUOTA --}}
                        <div class="border rounded-4 p-3">
                            <div class="text-muted small mb-1">
                                Sisa Kuota
                            </div>
                            <div class="fw-medium text-dark">
                                <i class="ri-user-add-line text-success me-2"></i>
                                {{ max(0, ($ekstrakurikuler->kuota ?? 0) - ($ekstrakurikuler->total_peserta ?? 0)) }}
                                siswa
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
                                    Deskripsi Ekstrakurikuler
                                </div>
                                <small class="text-muted">
                                    Keterangan tambahan mengenai kegiatan ekstrakurikuler.
                                </small>
                            </div>
                        </div>

                        <div class="text-muted small text-break">
                            {{ $ekstrakurikuler->deskripsi ?: 'Tidak ada deskripsi ekstrakurikuler.' }}
                        </div>
                    </div>

                @else
                    {{-- DATA TIDAK DITEMUKAN --}}
                    <div class="text-center py-5 px-3">
                        <lord-icon
                            src="https://cdn.lordicon.com/gsqxdxog.json"
                            trigger="loop"
                            colors="primary:#878a99,secondary:#c8c8c8"
                            style="width:75px;height:75px">
                        </lord-icon>

                        <h5 class="fw-semibold mt-3 mb-1">
                            Data Tidak Ditemukan
                        </h5>
                        <p class="text-muted small mb-0">
                            Data ekstrakurikuler tidak tersedia.
                        </p>
                    </div>
                @endif
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>

                @if ($ekstrakurikuler)
                    <button type="button"
                        class="btn btn-primary rounded-pill px-4"
                        wire:click="cetakEkstrakurikuler"
                        wire:loading.attr="disabled"
                        wire:target="cetakEkstrakurikuler">

                        <span wire:loading.remove wire:target="cetakEkstrakurikuler">
                            <i class="ri-printer-line me-1"></i>
                            Cetak
                        </span>

                        <span wire:loading wire:target="cetakEkstrakurikuler">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyiapkan...
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
