
<div class="card border-0 shadow-sm rounded-4 mb-4">

    {{-- HEADER --}}
    <div class="card-header bg-transparent border-bottom p-3 p-lg-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            {{-- TITLE --}}
            <div>
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-file-chart-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Laporan SPMB - Calon Siswa Diterima
                        </h5>

                        <small class="text-muted">
                            Daftar calon siswa yang diterima serta fasilitas untuk mencetak kartu dan formulir pendataan.
                        </small>
                    </div>
                </div>
            </div>

            {{-- UNDUH LAPORAN --}}
            @if ($selectedJenjang && $selectedPeriode && $periode)
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <button
                        type="button"
                        class="btn btn-danger rounded-pill px-4 d-inline-flex align-items-center gap-2"
                        wire:click="unduhLaporan"
                        wire:loading.attr="disabled"
                        wire:target="unduhLaporan">
                        <span wire:loading.remove wire:target="unduhLaporan">
                            <i class="ri-file-pdf-line"></i>
                            Unduh Laporan PDF
                        </span>
                        <span wire:loading wire:target="unduhLaporan">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Menyiapkan PDF...
                        </span>
                    </button>
                </div>
            @endif

        </div>
    </div>

    <div class="card-body">

        {{-- PARAMETER BELUM DIPILIH --}}
        @if (!$selectedJenjang)
            <div class="text-center py-4">
                <div class="avatar-md mx-auto mb-3">
                    <div class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-filter-3-line"></i>
                    </div>
                </div>

                <h6 class="mb-1">Pilih Parameter Laporan</h6>

                <p class="text-muted mb-0">
                    Silakan pilih jenjang terlebih dahulu
                    untuk menampilkan laporan calon siswa yang diterima pada SPMB.
                </p>
            </div>
        @elseif (!$selectedPeriode)
            <div class="text-center py-4">
                <div class="avatar-md mx-auto mb-3">
                    <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-24">
                        <i class="ri-calendar-close-line"></i>
                    </div>
                </div>

                <h6 class="mb-1">Pilih Periode</h6>

                <p class="text-muted mb-0">
                    Tidak ada periode aktif. Pilih periode lain yang tersedia untuk melihat laporan.
                </p>
            </div>
        {{-- PERIODE TIDAK TERSEDIA --}}
        @elseif (!$periode)

            <div class="text-center py-4">
                <div class="avatar-md mx-auto mb-3">
                    <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-24">
                        <i class="ri-calendar-close-line"></i>
                    </div>
                </div>

                <h6 class="mb-1">Periode SPMB Tidak Tersedia</h6>

                <p class="text-muted mb-0">
                    Periode SPMB yang dipilih tidak tersedia atau bukan milik jenjang tersebut.
                </p>
            </div>

        @else            
            {{-- PENCARIAN DAN FILTER JALUR --}}
            <div class="row g-3 mb-3">

                {{-- PENCARIAN --}}
                <div class="col-xxl-8 col-md-12">
                    <label
                        for="searchData"
                        class="form-label small text-muted text-uppercase fw-medium mb-2">
                        Pencarian
                    </label>

                    <div class="search-box">
                        <input
                            type="text"
                            id="searchData"
                            class="form-control search"
                            placeholder="Cari nama atau nomor pendataan..."
                            wire:model.debounce.400ms="search">

                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>

                {{-- FILTER JALUR --}}
                <div class="col-xxl-4 col-md-6">
                    <label
                        for="filterJalur"
                        class="form-label small text-muted text-uppercase fw-medium mb-2">
                        Jalur Seleksi
                    </label>

                    <select
                        id="filterJalur"
                        class="form-select"
                        wire:model="filterJalur">

                        <option value="">Semua Jalur</option>

                        @foreach ($daftarJalur as $jalur)
                            <option value="{{ $jalur->ppdb_jalur_id }}">
                                {{ $jalur->nama_jalur }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- RESET FILTER --}}
                {{-- @if ($search || $filterJalur !== '')
                    <div class="col-12">
                        <button
                            type="button"
                            class="btn btn-light rounded-pill px-3"
                            wire:click="resetFilter">

                            <i class="ri-refresh-line me-1"></i>
                            Reset Filter
                        </button>
                    </div>
                @endif --}}

            </div>
            {{-- END FILTER --}}

            {{-- LOADING --}}
            <div
                wire:loading.delay
                wire:target="search,filterJalur,gotoPage,nextPage,previousPage"
                class="text-muted small mb-3">

                <span class="spinner-border spinner-border-sm me-1"></span>
                Memuat laporan SPMB...
            </div>

            {{-- TABEL --}}
            <div class="live-preview">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap align-middle">

                        <thead class="table-light">
                            <tr class="text-uppercase">
                                <th class="text-center" style="width: 60px;">
                                    No.
                                </th>
                                <th>Calon Siswa</th>
                                <th>Nomor Pendataan</th>
                                <th>Jalur</th>
                                <th>Status</th>
                                <th>Kontak Orang Tua/Wali</th>
                                <th>Sumber Pendataan</th>
                                <th class="text-center" style="min-width: 420px;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pendaftar as $item)

                                <tr wire:key="laporan-{{ $item->ppdb_pendaftaran_id }}">

                                    {{-- NOMOR --}}
                                    <td class="text-center text-muted">
                                        {{ $pendaftar->firstItem() + $loop->index }}
                                    </td>

                                    {{-- CALON SISWA --}}
                                    <td class="fw-medium">
                                        {{ $item->ppdb_calon_siswa->nama_siswa ?? 'Data siswa belum lengkap' }}
                                    </td>

                                    {{-- NOMOR PENDAFTARAN --}}
                                    <td>
                                        {{ $item->nomor_pendaftaran }}
                                    </td>

                                    {{-- JALUR --}}
                                    <td>
                                        {{ $item->ppdb_jalur->nama_jalur ?? '-' }}
                                    </td>

                                    {{-- STATUS PENDAFTARAN --}}
                                    <td class="text-nowrap text-success">
                                        <i class="ri-check-double-line fs-17 align-middle me-1"></i>
                                        Diterima
                                    </td>

                                    {{-- KONTAK ORANG TUA/WALI --}}
                                    <td>
                                        @php
                                            $orangTua = $item->ppdb_orangtua;
                                            $kontakWhatsApp = [
                                                'Ayah' => $orangTua->telepon_ayah ?? null,
                                                'Ibu' => $orangTua->telepon_ibu ?? null,
                                                'Wali' => $orangTua->telepon_wali ?? null,
                                            ];
                                        @endphp

                                        @foreach ($kontakWhatsApp as $label => $nomor)
                                            <div class="text-nowrap">
                                                <span class="text-muted">{{ $label }}:</span>
                                                {{ filled($nomor) ? $nomor : '-' }}
                                            </div>
                                        @endforeach
                                    </td>

                                    {{-- SUMBER PENDATAAN --}}
                                    <td class="text-nowrap">
                                        @if ($item->ms_pengguna_id)
                                            Portal Orang Tua
                                        @else
                                            Dibantu Petugas
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2 flex-nowrap">

                                            {{-- CETAK KARTU ALJABAR --}}
                                            <a
                                                href="{{ route('ppdb.kartu-aljabar.pdf', [
                                                    'pendaftaranId' => $item->ppdb_pendaftaran_id,
                                                ]) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-outline-primary btn-sm rounded-pill px-3 text-nowrap"
                                                title="Cetak Kartu Aljabar"
                                            >
                                                <i class="ri-printer-line align-bottom me-1"></i>
                                                Kartu
                                            </a>

                                            {{-- CETAK FORMULIR PENDAFTARAN --}}
                                            <a
                                                href="{{ route('ppdb.formulir-pendaftaran.pdf', [
                                                    'pendaftaranId' => $item->ppdb_pendaftaran_id,
                                                ]) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-danger btn-sm rounded-pill px-3 text-nowrap"
                                                title="Cetak Formulir Pendataan">

                                                <i class="ri-printer-line me-1"></i>
                                                Formulir
                                            </a>

                                            {{-- UNDUH BERKAS PENDATAAN --}}
                                            <a
                                                href="{{ route('ppdb.admin.laporan.berkas.zip', [
                                                    'pendaftaranId' => $item->ppdb_pendaftaran_id,
                                                ]) }}"
                                                class="btn btn-soft-primary btn-sm rounded-pill px-3 text-nowrap"
                                                title="Unduh berkas pendataan"
                                            >
                                                <i class="ri-download-2-line me-1"></i>
                                                Berkas
                                            </a>

                                            {{-- KONFIRMASI PENDATAAN --}}
                                            <button
                                                type="button"
                                                class="btn btn-soft-success btn-sm rounded-pill px-3 text-nowrap"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalKonfirmasiPendataan-{{ $item->ppdb_pendaftaran_id }}"
                                                title="Konfirmasi pendataan">
                                                <i class="ri-whatsapp-line me-1"></i>
                                                Konfirmasi
                                            </button>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center py-5">

                                        <div class="avatar-md mx-auto mb-3">
                                            <div class="avatar-title bg-light text-muted rounded-circle fs-24">
                                                <i class="ri-file-search-line"></i>
                                            </div>
                                        </div>

                                        <h6 class="mb-1">
                                            Data Calon Siswa Diterima Belum Tersedia
                                        </h6>

                                        <p class="text-muted mb-3">
                                            @if (trim($search) !== '')
                                                Tidak ditemukan calon siswa yang diterima
                                                yang sesuai dengan pencarian.
                                            @else
                                                Belum ada calon siswa yang diterima
                                                pada periode SPMB ini.
                                            @endif
                                        </p>

                                        @if (trim($search) !== '')
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-light rounded-pill px-3"
                                                wire:click="resetFilter">

                                                <i class="ri-refresh-line me-1"></i>
                                                Reset Pencarian
                                            </button>
                                        @endif

                                    </td>
                                </tr>

                            @endforelse
                        </tbody>

                    </table>
                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <div class="text-muted fs-13">
                                Menampilkan
                                <span class="fw-semibold">
                                    {{ $pendaftar->firstItem() ?? 0 }}
                                </span>
                                -
                                <span class="fw-semibold">
                                    {{ $pendaftar->lastItem() ?? 0 }}
                                </span>
                                dari
                                <span class="fw-semibold">
                                    {{ $pendaftar->total() }}
                                </span>
                                calon siswa diterima
                            </div>

                            <div>
                                {{ $pendaftar->links() }}
                            </div>

                        </div>
                    </div>

                    @foreach ($pendaftar as $item)
                        @php
                            $tanggalKonfirmasi = $item->submitted_at ?? $item->created_at;
                            $pesanKonfirmasi = "Nama siswa: "
                                . ($item->ppdb_calon_siswa->nama_siswa ?? '-')
                                . "\nNomor pendataan: "
                                . ($item->nomor_pendaftaran ?? '-')
                                . "\nTanggal pendataan: "
                                . ($tanggalKonfirmasi
                                    ? \Carbon\Carbon::parse($tanggalKonfirmasi)
                                        ->locale('id')
                                        ->translatedFormat('d F Y')
                                    : '-');
                            $tautanGrup = $periode->tautan_grup;
                            $skemaTautanGrup = is_string($tautanGrup)
                                ? strtolower((string) parse_url($tautanGrup, PHP_URL_SCHEME))
                                : '';
                            $tautanGrupValid = in_array($skemaTautanGrup, ['http', 'https'], true)
                                && filter_var($tautanGrup, FILTER_VALIDATE_URL);
                            $modalId = 'modalKonfirmasiPendataan-' . $item->ppdb_pendaftaran_id;
                            $tombolGrupId = 'tombolMasukGrup-' . $item->ppdb_pendaftaran_id;
                        @endphp

                        <div
                            wire:ignore.self
                            class="modal fade"
                            id="{{ $modalId }}"
                            tabindex="-1"
                            aria-labelledby="{{ $modalId }}Label"
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
                                        <h3 class="fw-bold mb-2" id="{{ $modalId }}Label">
                                            Bergabung ke Grup SPMB
                                        </h3>
                                        <p class="text-muted mb-4">
                                            @if ($tautanGrupValid)
                                                Salin pesan ini, lalu buka grup WhatsApp SPMB untuk mengirim konfirmasi menggunakan WhatsApp petugas.
                                            @else
                                                Tautan grup WhatsApp untuk periode ini belum tersedia. Silakan hubungi pengelola SPMB.
                                            @endif
                                        </p>
                                        <div class="border rounded-4 p-3 text-start mb-3">
                                            <div class="text-muted small mb-1">Pesan konfirmasi</div>
                                            <div class="fw-medium text-break" style="white-space: pre-line">{{ $pesanKonfirmasi }}</div>
                                        </div>

                                        <button
                                            type="button"
                                            class="btn btn-outline-primary rounded-pill px-4"
                                            onclick="copyToClipboard(@js($pesanKonfirmasi), 'Pesan konfirmasi').then(disalin => { const tombol = document.getElementById(@js($tombolGrupId)); if (disalin && tombol) tombol.classList.remove('d-none'); });">
                                            <i class="ri-file-copy-line me-1"></i>
                                            Salin Pesan
                                        </button>
                                    </div>

                                    @if ($tautanGrupValid)
                                        <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                                            <a
                                                id="{{ $tombolGrupId }}"
                                                href="{{ $tautanGrup }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-success rounded-pill px-4 d-none">
                                                <i class="ri-whatsapp-line me-1"></i>
                                                Konfirmasi Masuk Grup
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
