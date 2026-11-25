@extends('template_portal_ppdb.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-xxl-12">

                {{-- HEADER --}}
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-transparent border-bottom-0 pb-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-sm">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                    <i class="ri-user-star-line"></i>
                                </div>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Selamat Datang, Bapak/Ibu
                                </h5>

                                <small class="text-muted">
                                    Pantau perkembangan pendataan putra-putri Anda melalui portal SPMB.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-3">
                        @if ($pendaftaran)
                            @php
                                $statusInfo = [
                                    'draft' => [
                                        'label' => 'Belum Dikirim',
                                        'class' => 'bg-secondary-subtle text-secondary',
                                        'icon' => 'ri-draft-line',
                                        'deskripsi' => 'Lengkapi data dan kirim formulir pendataan Anda.',
                                    ],
                                    'pengecekan' => [
                                        'label' => 'Terdaftar',
                                        'class' => 'bg-primary-subtle text-primary',
                                        'icon' => 'ri-checkbox-circle-line',
                                        'deskripsi' => 'Pendataan berhasil dikirim.',
                                    ],
                                    'perbaikan' => [
                                        'label' => 'Perlu Revisi',
                                        'class' => 'bg-danger-subtle text-danger',
                                        'icon' => 'ri-edit-line',
                                        'deskripsi' => 'Silakan perbarui data sesuai catatan sekolah.',
                                    ],
                                    'diterima' => [
                                        'label' => 'Diterima',
                                        'class' => 'bg-success-subtle text-success',
                                        'icon' => 'ri-checkbox-circle-line',
                                        'deskripsi' => 'Calon siswa telah diterima di sekolah.',
                                    ],
                                    'ditolak' => [
                                        'label' => 'Tidak Diterima',
                                        'class' => 'bg-danger-subtle text-danger',
                                        'icon' => 'ri-close-circle-line',
                                        'deskripsi' => 'Hubungi sekolah untuk informasi lebih lanjut.',
                                    ],
                                ];

                                $info = $statusInfo[$pendaftaran->status] ?? [
                                    'label' => 'Dalam Proses',
                                    'class' => 'bg-secondary-subtle text-secondary',
                                    'icon' => 'ri-information-line',
                                    'deskripsi' => 'Silakan periksa status pendataan secara berkala.',
                                ];

                                $bolehEdit = in_array($pendaftaran->status, [
                                    'draft',
                                    'perbaikan',
                                ]);
                            @endphp

                            <div class="border rounded-4 p-3 p-md-4">
                                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                                    <div class="flex-grow-1">
                                        <div class="text-muted small mb-1">
                                            Nomor Pendataan
                                        </div>

                                        <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                                            <h4 class="text-primary fw-bold mb-0">
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

                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <div class="avatar-xs flex-shrink-0">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="ri-user-3-line"></i>
                                                </div>
                                            </div>

                                            <div class="fw-semibold">
                                                {{ $pendaftaran->ppdb_calon_siswa->nama_siswa ?? 'Data siswa belum diisi' }}
                                            </div>
                                        </div>

                                        @if ($pendaftaran->ppdb_jalur)
                                            <div class="d-flex align-items-center gap-2 mb-3">
                                                <div class="avatar-xs flex-shrink-0">
                                                    <div class="avatar-title bg-secondary-subtle text-secondary rounded-circle">
                                                        <i class="ri-route-line"></i>
                                                    </div>
                                                </div>

                                                <div class="fw-semibold">
                                                    {{ $pendaftaran->ppdb_jalur->nama_jalur }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="border-top d-lg-none"></div>

                                    <div class="flex-shrink-0" style="min-width: 240px;">
                                        <div class="mb-2">
                                            <span class="badge {{ $info['class'] }} rounded-pill px-3 py-2">
                                                <i class="{{ $info['icon'] }} me-1"></i>
                                                {{ $info['label'] }}
                                            </span>
                                        </div>

                                        <p class="text-muted small mb-3">
                                            {{ $info['deskripsi'] }}
                                        </p>

                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('ppdb.pendaftaran.status', [
                                                'jenjang' => $jenjang->slug,
                                            ]) }}"
                                                class="btn btn-outline-primary rounded-pill">
                                                <i class="ri-file-list-3-line me-1"></i>
                                                Lihat Status
                                            </a>

                                            <a href="{{ route('ppdb.pendaftaran.review', [
                                                'jenjang' => $jenjang->slug,
                                            ]) }}"
                                                class="btn btn-primary rounded-pill">
                                                <i class="ri-eye-line me-1"></i>
                                                Preview Data
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 py-md-5">
                                <div class="avatar-lg mx-auto mb-3">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                        <i class="ri-file-add-line fs-1"></i>
                                    </div>
                                </div>

                                <h5 class="fw-semibold mb-2">
                                    Belum Ada Pendataan
                                </h5>

                                <p class="text-muted mb-4 mx-auto" style="max-width: 380px;">
                                    Mulai proses SPMB dengan memilih jalur yang tersedia.
                                </p>

                                @if ($periode)
                                    <a href="{{ route('ppdb.pendaftaran.jalur', [
                                        'jenjang' => $jenjang->slug,
                                    ]) }}"
                                        class="btn btn-primary rounded-pill px-4">
                                        <i class="ri-arrow-right-line me-1"></i>
                                        Mulai Pendataan
                                    </a>
                                @else
                                    <div class="d-inline-flex align-items-center gap-2 text-muted small">
                                        <i class="ri-information-line"></i>
                                        <span>Belum ada periode SPMB yang dibuka saat ini.</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                </div>

                @if ($pendaftaran)

                    {{-- PERINGATAN PERBAIKAN --}}
                    @if ($perluPerbaikan)
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="avatar-sm flex-shrink-0">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-20">
                                            <i class="ri-error-warning-line"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold mb-2">
                                            Perbaikan Data Diperlukan
                                        </h5>

                                        <p class="text-muted mb-3">
                                            Panitia meminta Anda memperbaiki data pendataan.
                                            Silakan baca catatan berikut dan perbarui data
                                            sebelum mengirim ulang.
                                        </p>

                                        @if (filled($pendaftaran->catatan_perbaikan))
                                            <div class="bg-warning-subtle rounded-3 p-3 mb-3">
                                                <small class="fw-semibold d-block mb-1">
                                                    Catatan dari Panitia
                                                </small>

                                                <p class="mb-0 text-break">
                                                    {{ $pendaftaran->catatan_perbaikan }}
                                                </p>
                                            </div>
                                        @endif

                                        <a href="{{ route('ppdb.pendaftaran.data-siswa', [
                                            'jenjang' => $jenjang->slug,
                                        ]) }}"
                                            class="btn btn-warning rounded-pill px-4">
                                            <i class="ri-edit-line me-1"></i>
                                            Lihat Instruksi Perbaikan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- PROGRES PENDAFTARAN --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-transparent">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                        <i class="ri-list-check-2"></i>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        Progres Pendataan
                                    </h5>

                                    <small class="text-muted">
                                        Pantau tahapan pengisian data calon siswa.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @php
                                $steps = [
                                    1 => [
                                        'label' => 'Jalur Pendataan',
                                        'route' => 'ppdb.pendaftaran.jalur',
                                        'icon' => 'ri-route-line',
                                    ],
                                    2 => [
                                        'label' => 'Data Calon Siswa',
                                        'route' => 'ppdb.pendaftaran.data-siswa',
                                        'icon' => 'ri-user-3-line',
                                    ],
                                    3 => [
                                        'label' => 'Orang Tua/Wali',
                                        'route' => 'ppdb.pendaftaran.orang-tua',
                                        'icon' => 'ri-parent-line',
                                    ],
                                    4 => [
                                        'label' => 'Alamat',
                                        'route' => 'ppdb.pendaftaran.alamat',
                                        'icon' => 'ri-map-pin-line',
                                    ],
                                    5 => [
                                        'label' => 'Pendidikan',
                                        'route' => 'ppdb.pendaftaran.pendidikan',
                                        'icon' => 'ri-school-line',
                                    ],
                                    6 => [
                                        'label' => 'Berkas',
                                        'route' => 'ppdb.pendaftaran.berkas',
                                        'icon' => 'ri-file-paper-2-line',
                                    ],
                                    7 => [
                                        'label' => 'Review Data',
                                        'route' => 'ppdb.pendaftaran.review',
                                        'icon' => 'ri-checkbox-circle-line',
                                    ],
                                    8 => [
                                        'label' => 'Status Pendataan',
                                        'route' => 'ppdb.pendaftaran.status',
                                        'icon' => 'ri-time-line',
                                    ],
                                ];

                            @endphp

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">
                                    Tahap {{ $currentStep }} dari {{ $totalStep }}
                                </span>

                                <span class="fw-semibold text-primary">
                                    {{ $progressPersen }}%
                                </span>
                            </div>

                            <div class="progress rounded-pill mb-4" style="height: 8px;">
                                <div class="progress-bar bg-primary rounded-pill"
                                    role="progressbar"
                                    style="width: {{ $progressPersen }}%"
                                    aria-valuenow="{{ $progressPersen }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>

                            <div class="row g-3">
                                @foreach ($steps as $step => $item)
                                    @php
                                        $label = $item['label'];

                                        $sudahDikirim = in_array($status, [
                                            'pengecekan',
                                            'diterima',
                                        ]);

                                        $stepSelesaiSampai = $sudahDikirim
                                            ? max($currentStep, 7)
                                            : $currentStep - 1;

                                        $selesai = $step <= $stepSelesaiSampai;
                                        $aktif = ! $selesai && $step === $currentStep;

                                        $iconClass = $selesai
                                            ? 'bg-success-subtle text-success'
                                            : ($aktif
                                                ? 'bg-primary-subtle text-primary'
                                                : 'bg-light text-muted');

                                        $icon = $selesai
                                            ? 'ri-check-line'
                                            : ($aktif
                                                ? 'ri-time-line'
                                                : 'ri-checkbox-blank-circle-line');

                                        // Tahap yang boleh dibuka.
                                        $bolehDibuka = $step <= $currentStep;

                                        // Setelah dikirim, form tidak boleh dibuka kembali.
                                        if ($sudahDikirim && $step <= 7) {
                                            $bolehDibuka = false;
                                        }

                                        // Status perbaikan boleh mengakses form untuk memperbaiki data.
                                        if ($status === 'perbaikan' && $step >= 2 && $step <= 6) {
                                            $bolehDibuka = true;
                                        }

                                        $slugJenjang = $pendaftaran->ppdb_periode->ms_jenjang->slug ?? null;

                                        $url = $bolehDibuka
                                            && $slugJenjang
                                            && \Illuminate\Support\Facades\Route::has($item['route'])
                                                ? route($item['route'], [
                                                    'jenjang' => $slugJenjang,
                                                ])
                                                : null;
                                    @endphp

                                    <div class="col-12 col-sm-6 col-lg-3">
                                        @if ($url)
                                            <a href="{{ $url }}"
                                                class="text-reset text-decoration-none d-block h-100">
                                        @endif

                                        <div class="border rounded-4 p-3 h-100 {{ $url ? 'cursor-pointer' : '' }}">
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title {{ $iconClass }} rounded-circle">
                                                        <i class="{{ $icon }}"></i>
                                                    </div>
                                                </div>

                                                <small class="text-muted">
                                                    Tahap {{ $step }}
                                                </small>
                                            </div>

                                            <div class="fw-semibold mb-1">
                                                {{ $label }}
                                            </div>

                                            <small class="{{ $selesai ? 'text-success' : ($aktif ? 'text-primary' : 'text-muted') }}">
                                                {{ $selesai ? 'Selesai' : ($aktif ? 'Tahap saat ini' : 'Belum dicapai') }}
                                            </small>

                                            {{-- @if ($url)
                                                <div class="text-primary small mt-2">
                                                    Buka tahap <i class="ri-arrow-right-line align-middle"></i>
                                                </div>
                                            @endif --}}
                                        </div>

                                        @if ($url)
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>


                            @if ($status === 'draft' || $status === 'perbaikan')
                                <div class="mt-4">
                                    <a href="{{ route('ppdb.pendaftaran.data-siswa', [
                                            'jenjang' => $jenjang->slug,
                                        ]) }}"
                                        class="btn btn-primary rounded-pill px-4">
                                        <i class="ri-edit-line me-1"></i>
                                        {{ $status === 'perbaikan' ? 'Perbaiki Data' : 'Lanjutkan Pendataan' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- INFORMASI JADWAL PPDB --}}

                @if ($periode)
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
                                    <h5 class="fw-bold mb-1">Jadwal Proses SPMB</h5>
                                    <small class="text-muted">
                                        Tahapan SPMB Tahun Ajaran 2027/2028.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($jenjang->slug === 'sd')
                                {{-- TIMELINE SD --}}
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Nov</h4>
                                        <small class="text-muted">2026</small>
                                    </div>

                                    <div class="pb-4 border-bottom w-100">
                                        <h6 class="fw-semibold mb-1">Pendataan Dibuka</h6>
                                        <small class="text-muted">
                                            Pendataan SPMB dimulai pada November 2026.
                                            Calon peserta didik mengikuti proses pendataan
                                            sesuai arahan pihak sekolah.
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 pt-4">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Jan–Feb</h4>
                                        <small class="text-muted">2027</small>
                                    </div>

                                    <div class="pb-4 border-bottom w-100">
                                        <h6 class="fw-semibold mb-1">Pengukuran Seragam</h6>
                                        <small class="text-muted">
                                            Pengukuran seragam dan pembayaran buku
                                            untuk kebutuhan satu tahun.
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 pt-4">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Mar–Apr</h4>
                                        <small class="text-muted">2027</small>
                                    </div>

                                    <div class="pb-4 border-bottom w-100">
                                        <h6 class="fw-semibold mb-1">Skrining Psikologi</h6>
                                        <small class="text-muted">
                                            Pelaksanaan skrining serta pembayaran kegiatan,
                                            SPP Juli, dan perlengkapan.
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 pt-4">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Mei–Jun</h4>
                                        <small class="text-muted">2027</small>
                                    </div>

                                    <div class="w-100">
                                        <h6 class="fw-semibold mb-1">Persiapan Tahun Ajaran Baru</h6>
                                        <small class="text-muted">
                                            Pengambilan buku, seragam, dan Golden Gate,
                                            serta pembayaran alat penunjang pendidikan
                                            dan biaya pengembangan.
                                        </small>
                                    </div>
                                </div>

                            @else
                                {{-- TIMELINE KB A, KB B, DAN TK A --}}
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Des–Jan</h4>
                                        <small class="text-muted">2026–2027</small>
                                    </div>

                                    <div class="pb-4 border-bottom w-100">
                                        <h6 class="fw-semibold mb-1">Tahap Pendaftaran</h6>
                                        <small class="text-muted">
                                            Pendataan calon peserta didik serta pembayaran
                                            biaya awal sesuai jenjang.
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 pt-4">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Feb–Mar</h4>
                                        <small class="text-muted">2027</small>
                                    </div>

                                    <div class="pb-4 border-bottom w-100">
                                        <h6 class="fw-semibold mb-1">Tahap 1</h6>
                                        <small class="text-muted">
                                            Pembayaran biaya perlengkapan pendidikan dan
                                            kegiatan selama satu tahun sesuai jenjang.
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 pt-4">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Apr–Mei</h4>
                                        <small class="text-muted">2027</small>
                                    </div>

                                    <div class="pb-4 border-bottom w-100">
                                        <h6 class="fw-semibold mb-1">Tahap 2</h6>
                                        <small class="text-muted">
                                            Pembayaran Syahriah bulan Juli dan Alat Permainan
                                            Edukatif (APE).
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 pt-4">
                                    <div class="flex-shrink-0 text-center" style="width: 64px;">
                                        <h4 class="fw-bold text-primary mb-0">Jun–Jul</h4>
                                        <small class="text-muted">2027</small>
                                    </div>

                                    <div class="w-100">
                                        <h6 class="fw-semibold mb-1">Tahap 3</h6>
                                        <small class="text-muted">
                                            Pembayaran biaya pengembangan sebagai persiapan
                                            memasuki tahun ajaran baru.
                                        </small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection
