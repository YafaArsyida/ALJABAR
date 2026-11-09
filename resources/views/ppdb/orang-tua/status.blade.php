@extends('template_portal_ppdb.v_template')

@section('title', 'Status Pendataan SPMB')

@section('content')

<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-xxl-12">
                @include('ppdb.orang-tua.layouts.progress-pendaftaran', [
                    'stepAktif' => $stepAktif
                ])
                
                {{-- Status Utama --}}
                @php
                    $statusConfig = [
                        'draft' => [
                            'label' => 'Belum Dikirim',
                            'badge' => 'bg-secondary-subtle text-secondary',
                            'icon' => 'ri-draft-line',
                            'iconClass' => 'bg-secondary-subtle text-secondary',
                            'judul' => 'Pendataan Belum Dikirim',
                            'deskripsi' => 'Silakan lengkapi dan kirim data SPMB Anda.',
                        ],
                        // 'pengecekan' => [
                        //     'label' => 'Sedang Dicek',
                        //     'badge' => 'bg-warning-subtle text-warning',
                        //     'icon' => 'ri-time-line',
                        //     'iconClass' => 'bg-warning-subtle text-warning',
                        //     'judul' => 'Data SPMB Berhasil Dikirim',
                        //     'deskripsi' => 'Data SPMB Anda sedang menunggu proses verifikasi oleh panitia.',
                        // ],
                        'pengecekan' => [
                            'label' => 'Terdaftar',
                            'badge' => 'bg-primary-subtle text-primary',
                            'icon' => 'ri-checkbox-circle-line',
                            'iconClass' => 'bg-primary-subtle text-primary',
                            'judul' => 'Pendataan Berhasil!',
                            'deskripsi' => 'Silakan menunggu jadwal pengukuran seragam dan skrining psikologi.',
                        ],
                        'perbaikan' => [
                            'label' => 'Perlu Perbaikan',
                            'badge' => 'bg-danger-subtle text-danger',
                            'icon' => 'ri-edit-circle-line',
                            'iconClass' => 'bg-danger-subtle text-danger',
                            'judul' => 'Data SPMB Memerlukan Perbaikan',
                            'deskripsi' => 'Silakan periksa informasi dan lakukan perbaikan sesuai catatan panitia.',
                        ],
                        'diterima' => [
                            'label' => 'Diterima',
                            'badge' => 'bg-success-subtle text-success',
                            'icon' => 'ri-checkbox-circle-line',
                            'iconClass' => 'bg-success-subtle text-success',
                            'judul' => 'Calon Siswa Diterima',
                            'deskripsi' => 'Selamat, calon siswa telah dinyatakan diterima melalui SPMB.',
                        ],
                        'ditolak' => [
                            'label' => 'Ditolak',
                            'badge' => 'bg-danger-subtle text-danger',
                            'icon' => 'ri-close-circle-line',
                            'iconClass' => 'bg-danger-subtle text-danger',
                            'judul' => 'Calon Siswa Belum Diterima',
                            'deskripsi' => 'Silakan lihat informasi hasil seleksi yang disampaikan oleh panitia.',
                        ],
                    ];

                    $status = strtolower($pendaftaran->status);

                    $config = $statusConfig[$status] ?? [
                        'label' => ucfirst($status),
                        'badge' => 'bg-secondary-subtle text-secondary',
                        'icon' => 'ri-information-line',
                        'iconClass' => 'bg-secondary-subtle text-secondary',
                        'judul' => 'Informasi Status SPMB',
                        'deskripsi' => 'Silakan periksa informasi terbaru mengenai pendataan Anda.',
                    ];
                @endphp

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                    {{-- HEADER STATUS --}}
                    <div class="card-header bg-transparent">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title {{ $config['iconClass'] }} rounded-circle fs-20">
                                        <i class="{{ $config['icon'] }}"></i>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        {{ $config['judul'] }}
                                    </h5>

                                    <small class="text-muted">
                                        {{ $config['deskripsi'] }}
                                    </small>
                                </div>
                            </div>

                            <span class="badge {{ $config['badge'] }} rounded-pill px-3 py-2">
                                {{ $config['label'] }}
                            </span>

                        </div>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            {{-- NOMOR DAN AKSI --}}
                            
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <small class="text-muted d-block mb-1">
                                        Nomor Pendataan
                                    </small>

                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h4 class="fw-bold text-primary mb-0">
                                            {{ $pendaftaran->nomor_pendaftaran ?? '-' }}
                                        </h4>

                                        @if (!empty($pendaftaran->nomor_pendaftaran))
                                            <button type="button"
                                                class="btn btn-sm btn-light btn-icon rounded-circle"
                                                title="Salin nomor pendataan"
                                                onclick="copyToClipboard(@js($pendaftaran->nomor_pendaftaran))">
                                                <i class="ri-file-copy-line"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <p class="text-muted mb-4">
                                    Gunakan nomor ini untuk memantau perkembangan
                                    proses SPMB dan melihat informasi pendataan Anda.
                                </p>


                                @if ($pendaftaran->status === 'perbaikan' && filled($pendaftaran->catatan_perbaikan))
                                    <div class="border rounded-4 p-3 my-3">
                                        <div class="d-flex gap-3">
                                            <div class="avatar-sm flex-shrink-0">
                                                <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                                                    <i class="ri-message-2-line"></i>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h6 class="fw-semibold mb-2">
                                                    Catatan dari Panitia
                                                </h6>

                                                <p class="text-muted mb-0 text-break">
                                                    {{ $pendaftaran->catatan_perbaikan }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex flex-column flex-sm-row flex-wrap gap-2">
                                    {{-- PERBAIKAN DATA --}}
                                    @if (in_array($status, ['draft', 'perbaikan']))
                                        <a href="{{ route('ppdb.pendaftaran.review', [
                                            'jenjang' => $pendaftaran->ppdb_periode->ms_jenjang->slug,
                                        ]) }}"
                                            class="btn btn-primary rounded-pill px-4">
                                            <i class="ri-edit-line me-1"></i>
                                            {{ $status === 'perbaikan' ? 'Perbaiki Data' : 'Lanjutkan Pendataan' }}
                                        </a>
                                    @else
                                        {{-- PREVIEW PENDAFTARAN --}}
                                        <a href="{{ route('ppdb.pendaftaran.review', [
                                            'jenjang' => $pendaftaran->ppdb_periode->ms_jenjang->slug,
                                        ]) }}"
                                            class="btn btn-outline-primary rounded-pill px-4">
                                            <i class="ri-eye-line me-1"></i>
                                            Lihat Ringkasan Pendataan
                                        </a>
                                    @endif

                                    {{-- KIRIM ULANG UNTUK VERIFIKASI --}}
                                    @if ($status === 'perbaikan')
                                        <button type="button"
                                            class="btn btn-danger rounded-pill px-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalKirimUlang">
                                            <i class="ri-send-plane-line me-1"></i>
                                            Perbaikan Selesai
                                        </button>
                                    @endif

                                    {{-- CETAK KARTU --}}
                                    @if ($pendaftaran->status !== 'draft')
                                        <button type="button"
                                            class="btn btn-success rounded-pill px-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalKonfirmasiPendataan">
                                            <i class="ri-whatsapp-line me-1"></i>
                                            Konfirmasi Pendataan
                                        </button>

                                        <a
                                            href="{{ route('ppdb.kartu-aljabar.pdf', [
                                                'pendaftaranId' => $pendaftaran->ppdb_pendaftaran_id,
                                            ]) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-primary rounded-pill px-4"
                                        >
                                            <i class="ri-printer-line me-1"></i>
                                            Cetak Kartu Aljabar
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- RINGKASAN PENDAFTARAN --}}
                            <div class="col-lg-5">
                                <div class="card border shadow-none rounded-4 mb-0">
                                    <div class="card-body">

                                        <div class="d-flex justify-content-between gap-3 mb-3">
                                            <span class="text-muted">Tanggal Pengiriman Data</span>
                                            <strong class="text-end">
                                                {{ $pendaftaran->submitted_at
                                                    ? \Carbon\Carbon::parse($pendaftaran->submitted_at)->translatedFormat('d F Y')
                                                    : '-' }}
                                            </strong>
                                        </div>

                                        <div class="d-flex justify-content-between gap-3 mb-3">
                                            <span class="text-muted">Nama Calon Siswa</span>
                                            <strong class="text-end">
                                                {{ $pendaftaran->ppdb_calon_siswa->nama_siswa ?? '-' }}
                                            </strong>
                                        </div>

                                        <div class="d-flex justify-content-between gap-3 mb-3">
                                            <span class="text-muted">Jalur</span>
                                            <strong class="text-end">
                                                {{ $pendaftaran->ppdb_jalur->nama_jalur ?? '-' }}
                                            </strong>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center gap-3">
                                            <span class="text-muted">Status</span>
                                            <span class="badge {{ $config['badge'] }} rounded-pill px-3 py-1">
                                                {{ $config['label'] }}
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- Timeline --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                    <i class="ri-calendar-event-line"></i>
                                </div>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Jadwal Proses SPMB
                                </h5>
                                <small class="text-muted">
                                    Tahapan SPMB Tahun Ajaran 2027/2028.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- PENDATAAN --}}
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0 text-center" style="width: 64px;">
                                <h4 class="fw-bold text-primary mb-0">Nov</h4>
                                <small class="text-muted">2026</small>
                            </div>

                            <div class="pb-4 border-bottom w-100">
                                <h6 class="fw-semibold mb-1">
                                    Pendataan Dibuka
                                </h6>
                                <small class="text-muted">
                                    Pendataan SPMB dimulai pada November 2026.
                                    Calon peserta didik mengikuti proses pendataan
                                    sesuai arahan pihak sekolah.
                                </small>
                            </div>
                        </div>

                        {{-- PENGUKURAN SERAGAM --}}
                        <div class="d-flex gap-3 pt-4">
                            <div class="flex-shrink-0 text-center" style="width: 64px;">
                                <h4 class="fw-bold text-primary mb-0">Jan–Feb</h4>
                                <small class="text-muted">2027</small>
                            </div>

                            <div class="pb-4 border-bottom w-100">
                                <h6 class="fw-semibold mb-1">
                                    Pengukuran Seragam
                                </h6>
                                <small class="text-muted">
                                    Pengukuran seragam dan pembayaran buku
                                    untuk kebutuhan satu tahun.
                                </small>
                            </div>
                        </div>

                        {{-- SKRINING PSIKOLOGI --}}
                        <div class="d-flex gap-3 pt-4">
                            <div class="flex-shrink-0 text-center" style="width: 64px;">
                                <h4 class="fw-bold text-primary mb-0">Mar–Apr</h4>
                                <small class="text-muted">2027</small>
                            </div>

                            <div class="pb-4 border-bottom w-100">
                                <h6 class="fw-semibold mb-1">
                                    Skrining Psikologi
                                </h6>
                                <small class="text-muted">
                                    Pelaksanaan skrining serta pembayaran kegiatan,
                                    SPP Juli, dan perlengkapan.
                                </small>
                            </div>
                        </div>

                        {{-- PERSIAPAN TAHUN AJARAN BARU --}}
                        <div class="d-flex gap-3 pt-4">
                            <div class="flex-shrink-0 text-center" style="width: 64px;">
                                <h4 class="fw-bold text-primary mb-0">Mei–Jun</h4>
                                <small class="text-muted">2027</small>
                            </div>

                            <div class="w-100">
                                <h6 class="fw-semibold mb-1">
                                    Persiapan Tahun Ajaran Baru
                                </h6>
                                <small class="text-muted">
                                    Pengambilan buku, seragam, dan Golden Gate,
                                    serta pembayaran alat penunjang pendidikan
                                    dan biaya pengembangan.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('ppdb.orang-tua.partials.modal-konfirmasi-pendataan', [
        'pendaftaran' => $pendaftaran,
    ])

    @include('ppdb.orang-tua.partials.modal-kirim-ulang', [
        'pendaftaran' => $pendaftaran,
        'status' => $status,
    ])
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                alertify.success(@json(session('success')));
            });
        </script>
    @endif
</div>

@endsection