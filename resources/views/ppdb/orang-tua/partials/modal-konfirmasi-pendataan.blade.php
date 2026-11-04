@if ($pendaftaran->status !== 'draft')
    @php
        $tanggalPendataan = $pendaftaran->submitted_at
            ? \Carbon\Carbon::parse($pendaftaran->submitted_at)->translatedFormat('d F Y')
            : '-';
        $pesanKonfirmasi = "Nama siswa: "
            . ($pendaftaran->ppdb_calon_siswa->nama_siswa ?? '-')
            . "\nNomor pendataan: "
            . ($pendaftaran->nomor_pendaftaran ?? '-')
            . "\nTanggal pendataan: "
            . $tanggalPendataan;
        $tautanGrup = $pendaftaran->ppdb_periode?->tautan_grup;
        $skemaTautanGrup = is_string($tautanGrup)
            ? strtolower((string) parse_url($tautanGrup, PHP_URL_SCHEME))
            : '';
        $tautanGrupValid = in_array($skemaTautanGrup, ['http', 'https'], true)
            && filter_var($tautanGrup, FILTER_VALIDATE_URL);
    @endphp

    <div
        wire:ignore.self
        class="modal fade"
        id="modalKonfirmasiPendataan"
        tabindex="-1"
        aria-labelledby="modalKonfirmasiPendataanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 pb-0">
                    <button
                        type="button"
                        class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal"
                        aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <div class="modal-body px-4 pb-4 pt-2 text-center">
                    <div class="mb-4">
                        <div class="avatar-xl mx-auto">
                            <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                <lord-icon
                                    src="https://cdn.lordicon.com/sbnjyzil.json"
                                    trigger="loop"
                                    colors="primary:#198754,secondary:#198754"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                        </div>
                    </div>

                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-3">
                        Konfirmasi Pendataan
                    </span>
                    <h3 class="fw-bold mb-2" id="modalKonfirmasiPendataanLabel">
                        Bergabung ke Grup SPMB
                    </h3>
                    <p class="text-muted mb-4">
                        @if ($tautanGrupValid)
                            Salin pesan konfirmasi, bergabung ke grup WhatsApp SPMB, lalu tempel dan kirim pesan tersebut untuk menyelesaikan pendataan.
                        @else
                            Tautan grup WhatsApp untuk periode ini belum tersedia. Silakan hubungi panitia SPMB untuk mendapatkan informasi lebih lanjut.
                        @endif
                    </p>
                    <div class="border rounded-4 p-3 text-start mb-3">
                        <div class="text-muted small mb-1">Pesan konfirmasi</div>
                        <div class="fw-medium text-break" style="white-space: pre-line">{{ $pesanKonfirmasi }}</div>
                    </div>

                    <button
                        type="button"
                        class="btn btn-outline-primary rounded-pill px-4"
                        onclick="copyToClipboard(@js($pesanKonfirmasi), 'Pesan konfirmasi').then(disalin => { const tombol = document.getElementById('tombolMasukGrup'); if (disalin && tombol) tombol.classList.remove('d-none'); });">
                        <i class="ri-file-copy-line me-1"></i>
                        Salin Pesan
                    </button>
                </div>

                <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                    @if ($tautanGrupValid)
                        <a
                            id="tombolMasukGrup"
                            href="{{ $tautanGrup }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-success rounded-pill px-4 d-none">
                            <i class="ri-whatsapp-line me-1"></i>
                            Konfirmasi Masuk Grup
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
