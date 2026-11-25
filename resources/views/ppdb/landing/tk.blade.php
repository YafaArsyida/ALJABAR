<!doctype html>
<html lang="id" data-layout="vertical" data-topbar="light" data-sidebar="light" data-bs-theme="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
    <head>
        <meta charset="utf-8" />
        <title>SPMB {{ $jenjang->nama_jenjang }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Informasi Sistem Penerimaan Murid Baru (SPMB) Tahun Ajaran 2027/2028 di {{ $jenjang->nama_jenjang }}.">
        <link rel="shortcut icon" href="{{asset('assets')}}/logo/tk.png">
        <script src="{{ asset('assets') }}/js/layout.js"></script>
        <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/custom.min.css" rel="stylesheet" type="text/css" />
        
        @livewireStyles
        
        <style>
            .ppdb-page .ppdb-brand img {
                width: 38px;
                height: 38px;
                object-fit: contain;
            }

            .ppdb-page .ppdb-brand small {
                font-size: 0.7rem;
                letter-spacing: 0.14em;
            }

            .ppdb-page .ppdb-secondary-cta {
                background: rgba(255,255,255,0.08);
                border: 1px solid rgba(255,255,255,0.30);
                color: #fff;
            }

                        
            .ppdb-page .ppdb-hero {
                position: relative;
                overflow: hidden;
                background: #0f172a;
                min-height: 640px;
                display: flex;
                align-items: center;
                isolation: isolate;
            }

            .ppdb-page .ppdb-hero::before {
                content: "";
                position: absolute;
                inset: 0;
                background-image: url('{{ asset('assets/logo/background-tk.jpeg') }}');
                background-size: cover;
                background-position: center;
                transform: scale(1.05);
                z-index: -2;
            }

            /* Overlay untuk meningkatkan keterbacaan teks */
            .ppdb-page .ppdb-hero::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(
                    90deg,
                    rgba(15, 23, 42, 0.92) 0%,
                    rgba(15, 23, 42, 0.78) 45%,
                    rgba(15, 23, 42, 0.42) 100%
                );
                z-index: -1;
            }


            .ppdb-page .ppdb-hero-content {
                position: relative;
                z-index: 1;
                padding-top: 5rem;
                padding-bottom: 5rem;
            }

            .ppdb-page .ppdb-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                border-radius: 999px;
                background: rgba(255,255,255,0.14);
                color: #fff;
                border: 1px solid rgba(255,255,255,0.18);
                padding: 0.55rem 0.9rem;
                font-size: 0.8rem;
                letter-spacing: 0.06em;
                text-transform: uppercase;
                font-weight: 700;
            }

            .ppdb-page .ppdb-hero h1 {
                font-size: clamp(2.6rem, 4vw, 4.5rem);
                line-height: 1.1;
                letter-spacing: -0.05em;
                color: #fff;
                margin-bottom: 1rem;
            }

            .ppdb-page .ppdb-hero p {
                color: rgba(255,255,255,0.84);
                font-size: 1.08rem;
                max-width: 660px;
                margin-bottom: 1.4rem;
            }

            .ppdb-page .ppdb-status-pill {
                background: rgba(16, 185, 129, 0.16);
                border: 1px solid rgba(52, 211, 153, 0.4);
                color: #d1fae5;
            }

            .ppdb-page .ppdb-status-pill .dot {
                display: block;
                flex: 0 0 10px;
                width: 10px;
                height: 10px;
                background: #34d399;
                border-radius: 50%;
                box-shadow: 0 0 0 8px rgba(52, 211, 153, 0.12);
            }

            .ppdb-page .ppdb-hero-card img {
                width: 100%;
                min-height: 440px;
                object-fit: cover;
            }

            .ppdb-page .ppdb-hero-card {
                background: rgba(255,255,255,0.12);
                border: 1px solid rgba(255,255,255,0.18);
                overflow: hidden;
                backdrop-filter: blur(10px);
            }

            .ppdb-page .ppdb-schedule {
                position: relative;
                margin-top: 1rem;
            }

            .ppdb-page .ppdb-schedule::before {
                content: "";
                position: absolute;
                left: 22px;
                top: 12px;
                bottom: 12px;
                width: 2px;
                background: var(--vz-border-color);
            }

            .ppdb-page .ppdb-timeline-item {
                position: relative;
                padding-left: 4.5rem;
                margin-bottom: 1.4rem;
            }

            .ppdb-page .ppdb-timeline-item:last-child {
                margin-bottom: 0;
            }

            .ppdb-page .ppdb-timeline-item .date {
                position: absolute;
                left: 0;
                width: 46px;
                height: 46px;
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                font-weight: 700;
            }

            .ppdb-page .ppdb-timeline-item .content strong {
                display: block;
                font-size: 1rem;
                margin-bottom: 0.25rem;
                letter-spacing: -0.02em;
            }

            .ppdb-page .ppdb-status-panel {
                position: relative;
                overflow: hidden;
                background: linear-gradient(120deg, var(--vz-primary) 0%, color-mix(in srgb, var(--vz-primary), #0f172a 28%) 100%);
                color: #fff;
            }

            .ppdb-page .ppdb-status-panel::after {
                content: "";
                position: absolute;
                width: 380px;
                height: 380px;
                right: -150px;
                top: -220px;
                border-radius: 50%;
                border: 1px solid rgba(255, 255, 255, 0.12);
                box-shadow: 0 0 0 36px rgba(255, 255, 255, 0.025), 0 0 0 72px rgba(255, 255, 255, 0.02);
                pointer-events: none;
            }

            .ppdb-page .ppdb-status-copy,
            .ppdb-page .ppdb-status-lookup {
                position: relative;
                z-index: 1;
            }

            .ppdb-page .ppdb-status-kicker {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: rgba(255, 255, 255, 0.82);
                font-size: 0.82rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                margin-bottom: 1rem;
            }

            .ppdb-page .ppdb-status-kicker i {
                font-size: 1.1rem;
            }

            .ppdb-page .ppdb-status-copy > p {
                max-width: 430px;
                line-height: 1.7;
            }

            .ppdb-page .ppdb-cta {
                position: relative;
                overflow: hidden;
                isolation: isolate;
                background: #0f172a;
                min-height: 280px;
                display: flex;
                align-items: center;
            }

            /* Foto sekolah + overlay gradien */
            .ppdb-page .ppdb-cta::before {
                content: "";
                position: absolute;
                inset: 0;
                background:
                    linear-gradient(
                        120deg,
                        rgba(15, 23, 42, 0.92) 0%,
                        rgba(15, 23, 42, 0.78) 48%,
                        rgba(15, 23, 42, 0.48) 100%
                    ),
                    url('{{ asset('assets/logo/background-tk.jpeg') }}');

                background-size: cover;
                background-position: center;
                transform: scale(1.04);
                z-index: -1;
            }

            /* Konten CTA */
            .ppdb-page .ppdb-cta-content {
                position: relative;
                z-index: 1;
                max-width: 700px;
                color: #fff;
            }

            .ppdb-page .ppdb-cta-content p {
                color: rgba(255, 255, 255, 0.78);
                line-height: 1.8;
                max-width: 620px;
            }

            /* Tampilan mobile */
            @media (max-width: 575.98px) {
                .ppdb-page .ppdb-cta {
                    min-height: 300px;
                    padding: 1.5rem !important;
                }

                .ppdb-page .ppdb-cta::before {
                    background:
                        linear-gradient(
                            120deg,
                            rgba(15, 23, 42, 0.93),
                            rgba(15, 23, 42, 0.76)
                        ),
                        url('{{ asset('assets/logo/background-tk.jpeg') }}');

                    background-size: cover;
                    background-position: center;
                }

                .ppdb-page .ppdb-cta-content h2 {
                    font-size: 1.65rem;
                    line-height: 1.35;
                }
            }
            ```

            .ppdb-page .ppdb-cta-content h2 {
                font-size: clamp(2rem, 3vw, 3rem);
                letter-spacing: -0.04em;
                margin-bottom: 0.8rem;
            }

            .ppdb-page .ppdb-cta-content p {
                color: rgba(255,255,255,0.86);
                font-size: 1.04rem;
                margin-bottom: 1.3rem;
                max-width: 560px;
            }

            .ppdb-page .ppdb-help {
                z-index: 1030;
                right: 1rem;
                bottom: 1rem;
                right: max(1rem, env(safe-area-inset-right));
                bottom: max(1rem, env(safe-area-inset-bottom));
            }

            .ppdb-page .ppdb-help i {
                font-size: 1.5rem;
            }

            .ppdb-page .ppdb-step-number {
                display: block;
                margin-bottom: 1.25rem;
                color: var(--vz-primary);
                font-size: 2.5rem;
                font-weight: 800;
                letter-spacing: -0.08em;
                line-height: 1;
            }

            @media (max-width: 991.98px) {
                .ppdb-page .ppdb-hero {
                    min-height: auto;
                }

                .ppdb-page .ppdb-hero-content {
                    padding-top: 4rem;
                    padding-bottom: 4rem;
                }
            }

            @media (max-width: 575.98px) {
                .ppdb-page .ppdb-hero h1 {
                    font-size: 2.5rem;
                }

            }
        </style>
    </head>

    <body>
        <div class="ppdb-page">
            <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
                <div class="container">
                    <a class="ppdb-brand d-flex align-items-center gap-2 fw-bold text-body text-decoration-none">
                        <img class="avatar-sm rounded-3 object-fit-cover"
                            src="{{ asset('assets/logo/tk.png') }}"
                            alt="Logo sekolah">

                        <div class="lh-sm">
                            <span>KB IT & TK IT Al Hidayah</span>
                            <small class="d-block text-muted fw-semibold text-uppercase">
                                SPMB 2027/2028
                            </small>
                        </div>
                    </a>

                    <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#ppdbNavbar"
                        aria-controls="ppdbNavbar"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="ppdbNavbar">
                        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#beranda">
                                    Beranda
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#profil">
                                    Profil Sekolah
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#program">
                                    Program Unggulan
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#biaya">
                                    Biaya SPMB
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#jadwal">
                                    Jadwal & Alur
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#persyaratan">
                                    Persyaratan
                                </a>
                            </li>

                            {{-- Action --}}
                            @auth
                                @if (Auth::user()->peran == 'ADMIN' || Auth::user()->peran == 'SUPERADMIN')
                                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                        <a href="{{ route('ppdb.admin.dashboard') }}"
                                            class="btn btn-primary rounded-pill px-3">
                                            <i class="ri-home-line me-1"></i>
                                            Dashboard Admin
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                        <a href="{{ route('ppdb.dashboard', [
                                            'jenjang' => $jenjang->slug,
                                        ]) }}"
                                            class="btn btn-primary rounded-pill px-3">
                                            <i class="ri-home-line me-1"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                    <a href="{{ route('ppdb.login', [
                                        'jenjang' => $jenjang->slug,
                                    ]) }}"
                                        class="btn btn-outline-dark rounded-pill px-3">
                                        Login
                                    </a>
                                </li>

                                <li class="nav-item mt-2 mt-lg-0">
                                    <a href="{{ route('ppdb.daftar', [
                                        'jenjang' => $jenjang->slug,
                                    ]) }}"
                                        class="btn btn-primary rounded-pill px-3">
                                        Mulai Pendataan
                                    </a>
                                </li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </nav>

            <main id="beranda">
                <section class="ppdb-hero" id="beranda">
                    <div class="container ppdb-hero-content">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-7">
                                <span class="ppdb-badge">
                                    <i class="ri-calendar-check-line"></i>
                                    SPMB Tahun Ajaran 2027/2028
                                </span>

                                <h1>
                                    Menumbuhkan Generasi Islami, Cerdas, dan Ceria
                                </h1>

                                <p>
                                    KB IT & TK IT Al Hidayah mendampingi anak bermain, belajar, mengenal nilai-nilai
                                    Islam, dan mengembangkan potensinya. Bersama keluarga, kami
                                    menumbuhkan karakter baik sebagai bekal masa depan.
                                </p>

                                <div class="ppdb-hero-cta d-grid d-sm-flex gap-3 mt-4">
                                    @auth
                                        @if (Auth::user()->peran == 'ADMIN' || Auth::user()->peran == 'SUPERADMIN')
                                            <a href="{{ route('ppdb.admin.dashboard') }}"
                                                class="btn btn-primary rounded-pill">
                                                <i class="ri-home-line me-1"></i>
                                                Dashboard Admin
                                            </a>
                                        @else
                                            <a href="{{ route('ppdb.dashboard', [
                                                'jenjang' => $jenjang->slug,
                                            ]) }}"
                                                class="btn btn-primary rounded-pill">
                                                <i class="ri-home-line me-1"></i>
                                                Dashboard SPMB
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('ppdb.daftar', [
                                            'jenjang' => $jenjang->slug,
                                        ]) }}"
                                            class="btn btn-primary rounded-pill">
                                            <i class="ri-user-add-line me-1"></i>
                                            Mulai Pendataan
                                        </a>
                                    @endauth

                                    <a href="#jadwal"
                                        class="btn ppdb-secondary-cta rounded-pill">
                                        <i class="ri-calendar-line me-1"></i>
                                        Lihat Alur Pendataan
                                    </a>
                                </div>

                                <div class="ppdb-status d-flex flex-column flex-sm-row flex-wrap gap-3 align-items-sm-center mt-4 text-white">
                                    <div class="ppdb-status-pill d-inline-flex align-items-center gap-2 rounded-pill px-3 py-2 fw-semibold">
                                        <span class="dot"></span>
                                        Pendataan Dibuka Desember 2026
                                    </div>

                                    <div class="text-white-50">
                                        Tahun Ajaran 2027/2028
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="ppdb-hero-card rounded-4 shadow-sm">
                                    <img src="{{ asset('assets/logo/hero-tk.jpeg') }}"
                                        alt="Kegiatan peserta didik KB IT & TK IT Al Hidayah">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-5 pt-0 mt-n4">
                    <div class="container">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="row g-0">

                                    @php
                                        $quickInfo = [
                                            [
                                                'icon' => 'ri-calendar-check-line',
                                                'label' => 'Pendataan Dibuka',
                                                'value' => 'Desember 2026',
                                            ],
                                            [
                                                'icon' => 'ri-ruler-line',
                                                'label' => 'Pengukuran Seragam',
                                                'value' => 'Maret – April 2027',
                                            ],
                                            [
                                                'icon' => 'ri-shirt-line',
                                                'label' => 'Pembagian Seragam',
                                                'value' => 'Mei – Juni 2027',
                                            ],
                                            [
                                                'icon' => 'ri-graduation-cap-line',
                                                'label' => 'Awalussanah',
                                                'value' => 'Mei – Juni 2027',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($quickInfo as $index => $info)
                                        <div class="col-lg col-md-6 col-12">
                                            <div class="p-3 p-xl-4 h-100 border-end border-bottom position-relative">

                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-5">
                                                            <i class="{{ $info['icon'] }}"></i>
                                                        </div>
                                                    </div>

                                                    <div class="min-w-0">
                                                        <div class="text-muted fw-medium fs-12 mb-2 text-uppercase">
                                                            {{ $info['label'] }}
                                                        </div>

                                                        <div class="fw-bold text-body fs-15 lh-sm">
                                                            {{ $info['value'] }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-5" id="profil">
                    <div class="container">

                        {{-- Header Profil --}}
                        <div class="text-center mx-auto mb-5" style="max-width: 760px;">
                            <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                Profil Sekolah
                            </span>

                            <h2 class="display-6 fw-bold mb-3">
                                Mengenal KB IT & TK IT Al Hidayah
                            </h2>

                            <p class="text-muted lh-lg mb-0">
                                KB IT & TK IT Al Hidayah mendampingi anak belajar, bermain,
                                mengenal nilai-nilai Islam, dan mengembangkan potensinya.
                                Bersama keluarga, kami menumbuhkan karakter baik sebagai
                                bekal tumbuh kembang anak.
                            </p>
                        </div>

                        {{-- Visi Sekolah --}}
                        <div class="card border-0 rounded-4 shadow-sm mb-5 overflow-hidden">
                            <div class="card-body p-4 p-lg-5">
                                <div class="row align-items-center g-4">
                                    <div class="col-md-auto text-center">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-primary-subtle text-primary rounded-4 fs-2">
                                                <i class="ri-eye-line"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <span class="text-primary text-uppercase fw-semibold small">
                                            Visi Sekolah
                                        </span>

                                        <h3 class="fs-4 fw-bold mt-2 mb-0 lh-base">
                                            <i class="ri-double-quotes-l text-primary fs-3 me-1" aria-hidden="true"></i>
                                            Terwujudnya pendidikan anak usia dini yang unggul dalam iman, ilmu, dan akhlak mulia
                                            <i class="ri-double-quotes-r text-primary fs-3 ms-1" aria-hidden="true"></i>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Misi Sekolah --}}
                        <div class="mb-4">
                            <div class="text-center mx-auto" style="max-width: 680px;">
                                <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                    Misi Sekolah
                                </span>

                                <h3 class="fw-bold mb-2">
                                    Nilai yang Kami Tanamkan
                                </h3>

                                <p class="text-muted mb-0">
                                    Empat komitmen dalam mendampingi tumbuh kembang anak
                                    melalui pendidikan yang Islami dan menyenangkan.
                                </p>
                            </div>
                        </div>

                        @php
                            $missions = [
                                [
                                    'icon' => 'ri-heart-3-line',
                                    'title' => 'Keimanan dan Akhlak',
                                    'text' => 'Menanamkan keimanan, membekali ilmu, dan membiasakan akhlak mulia.',
                                ],
                                [
                                    'icon' => 'ri-book-open-line',
                                    'title' => 'Nilai-Nilai Islam',
                                    'text' => 'Mengajarkan nilai-nilai Islam sesuai Al-Qur’an dan Sunah.',
                                ],
                                [
                                    'icon' => 'ri-shield-star-line',
                                    'title' => 'Pelayanan Pendidikan',
                                    'text' => 'Mewujudkan pelayanan pendidikan yang optimal dan profesional.',
                                ],
                                [
                                    'icon' => 'ri-hand-heart-line',
                                    'title' => 'Keteladanan Islami',
                                    'text' => 'Mengajarkan akhlak Islami melalui keteladanan dan pembiasaan.',
                                ],
                                [
                                    'icon' => 'ri-lightbulb-line',
                                    'title' => 'Potensi dan Bakat',
                                    'text' => 'Mengembangkan pengetahuan, potensi, dan bakat anak sesuai tingkat perkembangannya.',
                                ],
                            ];
                        @endphp

                        <div class="row g-3 g-lg-4">
                            @foreach ($missions as $mission)
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="card h-100 border rounded-4 shadow-none mb-0">
                                        <div class="card-body p-4">
                                            <div class="avatar-md mb-3">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                    <i class="{{ $mission['icon'] }}"></i>
                                                </div>
                                            </div>

                                            <h4 class="fs-5 fw-semibold mb-2">
                                                {{ $mission['title'] }}
                                            </h4>

                                            <p class="text-muted lh-lg mb-0">
                                                {{ $mission['text'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
                                
                <section class="py-5 bg-white" id="program">
                    <div class="container">

                        {{-- Header Program Unggulan --}}
                        <div class="text-center mx-auto mb-5" style="max-width: 720px;">
                            <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                Program Unggulan
                            </span>

                            <h2 class="display-6 fw-bold mb-3">
                                Belajar, Bermain, dan Tumbuh Bersama
                            </h2>

                            <p class="text-muted mb-0 lh-lg">
                                Kegiatan belajar yang menyenangkan untuk mengenalkan nilai-nilai
                                Islam, mengembangkan potensi, dan membangun kemandirian anak.
                            </p>
                        </div>

                        @php
                            $programs = [
                                [
                                    'icon' => 'ri-heart-3-line',
                                    'title' => 'Pembiasaan Islami',
                                    'description' => 'Mengenal Asmaul Husna, sholawat, doa harian, serta praktik wudu dan salat.',
                                ],
                                [
                                    'icon' => 'ri-book-open-line',
                                    'title' => 'Belajar Membaca',
                                    'description' => 'Mengenal huruf dan bacaan melalui Buku Baca Al Hidayah (BBA) dan Iqro.',
                                ],
                                [
                                    'icon' => 'ri-leaf-line',
                                    'title' => 'Pembelajaran Sentra',
                                    'description' => 'Mengembangkan kreativitas dan kemampuan anak melalui kegiatan bermain dan bereksplorasi.',
                                ],
                                [
                                    'icon' => 'ri-book-read-line',
                                    'title' => 'Read Aloud',
                                    'description' => 'Menumbuhkan minat baca, kemampuan berbahasa, dan imajinasi melalui kegiatan membacakan cerita.',
                                ],
                                [
                                    'icon' => 'ri-restaurant-line',
                                    'title' => 'Mindful Eating',
                                    'description' => 'Membiasakan anak makan dengan tertib, mandiri, dan menghargai makanan.',
                                ],
                                [
                                    'icon' => 'ri-sun-line',
                                    'title' => 'Jumat Spesial',
                                    'description' => 'Kegiatan senam, jalan sehat, membaca, penimbangan, dan permainan tradisional.',
                                ],
                                [
                                    'icon' => 'ri-compass-3-line',
                                    'title' => 'Fun Eksplorasi',
                                    'description' => 'Memberikan pengalaman belajar langsung melalui kegiatan mengenal lingkungan sekitar.',
                                ],
                                [
                                    'icon' => 'ri-hand-heart-line',
                                    'title' => 'Pembiasaan Kemandirian',
                                    'description' => 'Melatih anak membangun kebiasaan baik sejak datang hingga pulang sekolah.',
                                ],
                            ];
                        @endphp

                        {{-- Daftar Program --}}
                        <div class="row g-4">
                            @foreach ($programs as $program)
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="card h-100 border rounded-4 shadow-none mb-0">
                                        <div class="card-body p-4">

                                            <div class="avatar-md mb-4">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                    <i class="{{ $program['icon'] }}"></i>
                                                </div>
                                            </div>

                                            <h3 class="fs-5 fw-semibold mb-2">
                                                {{ $program['title'] }}
                                            </h3>

                                            <p class="text-muted lh-lg mb-0">
                                                {{ $program['description'] }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Penutup --}}
                        <div class="text-center mt-4">
                            <p class="text-muted small mb-0">
                                Setiap kegiatan menjadi kesempatan bagi anak untuk belajar,
                                mencoba hal baru, dan mengembangkan potensinya.
                            </p>
                        </div>

                    </div>
                </section>

                <section class="py-5" id="biaya">
                    <div class="container">

                        {{-- Header --}}
                        <div class="text-center mx-auto mb-5" style="max-width: 720px;">
                            <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                Informasi Biaya
                            </span>

                            <h2 class="display-6 fw-bold mb-3">
                                Biaya Pendataan TK 2027/2028
                            </h2>

                            <p class="text-muted lh-lg mb-0">
                                Berikut rincian biaya pendidikan TK IT Al Hidayah
                                yang dibayarkan secara bertahap.
                            </p>
                        </div>

                        {{-- Ringkasan Biaya --}}
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-4 shadow-none mb-0">
                                    <div class="card-body p-4 p-lg-5">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="avatar-md flex-shrink-0">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                    <i class="ri-user-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="fs-5 fw-semibold mb-1">
                                                    Calon Siswa Laki-laki
                                                </h3>
                                                <p class="text-muted small mb-0">
                                                    Biaya seragam <strong>Rp585.000</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <h4 class="display-6 fw-bold text-primary mb-2">
                                            Rp3.345.000
                                        </h4>

                                        <p class="text-muted small mb-0">
                                            Total biaya pendidikan sesuai rincian tahap pembayaran.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border rounded-4 shadow-none mb-0">
                                    <div class="card-body p-4 p-lg-5">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="avatar-md flex-shrink-0">
                                                <div class="avatar-title bg-success-subtle text-success rounded-3 fs-4">
                                                    <i class="ri-user-heart-line"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="fs-5 fw-semibold mb-1">
                                                    Calon Siswi Perempuan
                                                </h3>
                                                <p class="text-muted small mb-0">
                                                    Biaya seragam <strong>Rp699.000</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <h4 class="display-6 fw-bold text-success mb-2">
                                            Rp3.459.000
                                        </h4>

                                        <p class="text-muted small mb-0">
                                            Total biaya pendidikan sesuai rincian tahap pembayaran.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Rincian Pembayaran --}}
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="avatar-md flex-shrink-0">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                    <i class="ri-file-list-3-line"></i>
                                </div>
                            </div>

                            <div>
                                <h3 class="fs-4 fw-bold mb-1">
                                    Rincian Pembayaran
                                </h3>
                                <p class="text-muted mb-0">
                                    Pembayaran dibagi menjadi empat tahap.
                                </p>
                            </div>
                        </div>

                        @php
                            $tahapanBiaya = [
                                [
                                    'tahap' => 'Tahap Pendataan',
                                    'periode' => 'Desember 2026 – Januari 2027',
                                    'icon' => 'ri-clipboard-line',
                                    'items' => [
                                        ['nama' => 'Biaya pendataan', 'nominal' => 120000],
                                        ['nama' => 'Seragam 4 stel (laki-laki)', 'nominal' => 585000],
                                    ],
                                ],
                                [
                                    'tahap' => 'Tahap 1',
                                    'periode' => 'Februari – Maret 2027',
                                    'icon' => 'ri-book-2-line',
                                    'items' => [
                                        ['nama' => 'Alat tulis dan perlengkapan', 'nominal' => 575000],
                                        ['nama' => 'Kegiatan tahunan', 'nominal' => 400000],
                                    ],
                                ],
                                [
                                    'tahap' => 'Tahap 2',
                                    'periode' => 'April – Mei 2027',
                                    'icon' => 'ri-calendar-check-line',
                                    'items' => [
                                        ['nama' => 'Syahriah bulan Juli', 'nominal' => 295000],
                                        ['nama' => 'Alat Permainan Edukatif (APE)', 'nominal' => 520000],
                                    ],
                                ],
                                [
                                    'tahap' => 'Tahap 3',
                                    'periode' => 'Juni – Juli 2027',
                                    'icon' => 'ri-graduation-cap-line',
                                    'items' => [
                                        ['nama' => 'Pengembangan', 'nominal' => 850000],
                                    ],
                                ],
                            ];
                        @endphp

                        <div class="row g-4">
                            @foreach ($tahapanBiaya as $tahap)
                                <div class="col-lg-6">
                                    <div class="card h-100 border rounded-4 shadow-none mb-0">
                                        <div class="card-header bg-transparent border-bottom p-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-md flex-shrink-0">
                                                    <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                        <i class="{{ $tahap['icon'] }}"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h4 class="fs-5 fw-semibold mb-1">
                                                        {{ $tahap['tahap'] }}
                                                    </h4>
                                                    <p class="text-muted small mb-0">
                                                        {{ $tahap['periode'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body p-4">
                                            @foreach ($tahap['items'] as $item)
                                                <div class="d-flex justify-content-between align-items-start gap-3 {{ !$loop->last ? 'mb-3 pb-3 border-bottom' : '' }}">
                                                    <span class="text-muted">
                                                        {{ $item['nama'] }}
                                                    </span>

                                                    <span class="fw-semibold text-nowrap">
                                                        Rp{{ number_format($item['nominal'], 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            @endforeach

                                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4 pt-3 border-top">
                                                <span class="fw-bold fs-6 text-body">
                                                    Total tahap
                                                </span>

                                                <span class="fw-bold fs-5 text-body text-nowrap">
                                                    Rp{{ number_format(collect($tahap['items'])->sum('nominal'), 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Catatan --}}
                        <div class="alert alert-light border rounded-4 mt-4 mb-0" role="note">
                            <div class="d-flex align-items-start gap-3">
                                <i class="ri-information-line fs-4 text-primary"></i>
                                <div>
                                    <h4 class="fs-6 fw-semibold mb-1">
                                        Informasi Biaya
                                    </h4>
                                    <p class="text-muted small mb-0 lh-lg">
                                        Biaya seragam calon siswa laki-laki sebesar
                                        <strong class="text-body">Rp585.000</strong>
                                        dan calon siswi perempuan sebesar
                                        <strong class="text-body">Rp699.000</strong>.
                                        Total biaya dapat berbeda sesuai jenis seragam.
                                        Silakan menghubungi panitia untuk informasi pembayaran.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                
                <section class="py-5" id="jadwal">
                    <div class="container">

                        {{-- Header --}}
                        <div class="text-center mx-auto mb-5" style="max-width: 720px;">
                            <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                Jadwal dan Alur
                            </span>

                            <h2 class="display-6 fw-bold mb-3">
                                Alur Pendataan 2027/2028
                            </h2>

                            <p class="text-muted lh-lg mb-0">
                                Kenali tahapan pendataan, kegiatan, dan persiapan
                                calon peserta didik KB IT & TK IT Al Hidayah tahun ajaran 2027/2028.
                            </p>
                        </div>

                        {{-- Fase Pendataan --}}
                        <div class="row g-4 mb-5">

                            {{-- Tahap Pendataan --}}
                            <div class="col-lg-6">
                                <div class="card h-100 border rounded-4 shadow-none mb-0">
                                    <div class="card-body p-4 p-lg-5">

                                        <div class="d-flex align-items-start gap-3 mb-4">
                                            <div class="avatar-md flex-shrink-0">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                    <i class="ri-calendar-event-line"></i>
                                                </div>
                                            </div>

                                            <div>
                                                <span class="badge bg-primary-subtle text-primary mb-2">
                                                    Desember 2026 – Januari 2027
                                                </span>

                                                <h3 class="fs-4 fw-bold mb-1">
                                                    Tahap Pendataan
                                                </h3>

                                                <p class="text-muted small mb-0">
                                                    Pendaftaran dan pengisian data calon peserta didik.
                                                </p>
                                            </div>
                                        </div>

                                        @php
                                            $registrationSteps = [
                                                'Menyiapkan data calon peserta didik dan orang tua.',
                                                'Menyiapkan dokumen persyaratan pendataan.',
                                                'Mengisi formulir pendataan.',
                                                'Melengkapi dan mengunggah berkas persyaratan.',
                                                'Memastikan seluruh data telah diisi dengan benar.',
                                            ];
                                        @endphp

                                        <div class="d-flex flex-column gap-3">
                                            @foreach ($registrationSteps as $step)
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="avatar-xs flex-shrink-0">
                                                        <div class="avatar-title bg-light text-primary rounded-circle fw-semibold">
                                                            {{ $loop->iteration }}
                                                        </div>
                                                    </div>

                                                    <p class="text-muted mb-0 lh-lg">
                                                        {{ $step }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="alert alert-light border rounded-3 mt-4 mb-0">
                                            <div class="d-flex align-items-start gap-2">
                                                <i class="ri-information-line text-primary fs-5"></i>
                                                <p class="small text-muted mb-0 lh-lg">
                                                    Pastikan data dan dokumen calon peserta didik
                                                    telah dilengkapi sebelum mengirim formulir pendataan.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Tahapan Kegiatan --}}
                            <div class="col-lg-6">
                                <div class="card h-100 border rounded-4 shadow-none mb-0">
                                    <div class="card-body p-4 p-lg-5">

                                        {{-- Header --}}
                                        <div class="d-flex align-items-start gap-3 mb-4">
                                            <div class="avatar-md flex-shrink-0">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                    <i class="ri-calendar-check-line"></i>
                                                </div>
                                            </div>

                                            <div>
                                                <span class="badge bg-primary-subtle text-primary mb-2">
                                                    Maret – Juni 2027
                                                </span>

                                                <h3 class="fs-4 fw-bold mb-1">
                                                    Tahapan Kegiatan
                                                </h3>

                                                <p class="text-muted small mb-0">
                                                    Persiapan sebelum tahun ajaran baru.
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Daftar Tahapan --}}
                                        @php
                                            $activitySteps = [
                                                [
                                                    'judul' => 'Pengukuran Seragam',
                                                    'periode' => 'Maret – April 2027',
                                                    'deskripsi' => 'Pengukuran seragam calon peserta didik.',
                                                ],
                                                [
                                                    'judul' => 'Asesmen Diagnostik',
                                                    'periode' => 'Maret – April 2027',
                                                    'deskripsi' => 'Mengenal kemampuan dan kebutuhan belajar awal anak.',
                                                ],
                                                [
                                                    'judul' => 'Awalussanah',
                                                    'periode' => 'Mei – Juni 2027',
                                                    'deskripsi' => 'Kegiatan penyambutan anak dan pengenalan lingkungan sekolah.',
                                                ],
                                                [
                                                    'judul' => 'Pembagian Seragam',
                                                    'periode' => 'Mei – Juni 2027',
                                                    'deskripsi' => 'Penyerahan seragam untuk persiapan masuk sekolah.',
                                                ],
                                            ];
                                        @endphp

                                        <div class="d-flex flex-column gap-3">
                                            @foreach ($activitySteps as $step)
                                                <div class="d-flex align-items-start gap-3">
                                                    <div class="avatar-xs flex-shrink-0">
                                                        <div class="avatar-title bg-light text-primary rounded-circle fw-semibold">
                                                            {{ $loop->iteration }}
                                                        </div>
                                                    </div>

                                                    <div class="min-w-0">
                                                        <div class="fw-semibold text-body mb-1">
                                                            {{ $step['judul'] }}
                                                        </div>

                                                        <div class="text-primary fs-12 fw-medium mb-1">
                                                            {{ $step['periode'] }}
                                                        </div>

                                                        <p class="text-muted small mb-0 lh-lg">
                                                            {{ $step['deskripsi'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Informasi --}}
                                        <div class="alert alert-light border rounded-3 mt-4 mb-0">
                                            <div class="d-flex align-items-start gap-2">
                                                <i class="ri-information-line text-primary fs-5"></i>
                                                <p class="small text-muted mb-0 lh-lg">
                                                    Informasi jadwal kegiatan selanjutnya akan
                                                    disampaikan oleh pihak sekolah kepada orang tua.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div class="card border-0 rounded-4 bg-primary-subtle mb-0">
                            <div class="card-body p-4 p-lg-5">
                                <div class="row align-items-center g-3">
                                    <div class="col-lg">
                                        <h3 class="fs-4 fw-bold mb-2">
                                            Siapkan Persyaratan Pendataan
                                        </h3>

                                        <p class="text-muted mb-0 lh-lg">
                                            Lengkapi dokumen calon peserta didik
                                            agar proses pendataan berjalan lancar.
                                        </p>
                                    </div>

                                    <div class="col-lg-auto">
                                        <a href="#persyaratan"
                                            class="btn btn-primary rounded-pill px-4 py-2 fw-medium">
                                            Lihat Persyaratan
                                            <i class="ri-arrow-right-line align-middle ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="py-5 bg-white" id="persyaratan">
                    <div class="container">

                        {{-- Header --}}
                        <div class="text-center mx-auto mb-5" style="max-width: 720px;">
                            <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                Persyaratan SPMB
                            </span>

                            <h2 class="display-6 fw-bold mb-3">
                                Siapkan Dokumen Pendataan
                            </h2>

                            <p class="text-muted lh-lg mb-0">
                                Siapkan dokumen berikut untuk memudahkan proses pendataan
                                calon peserta didik KB IT & TK IT Al Hidayah.
                            </p>
                        </div>

                        <div class="row g-4">

                            {{-- Dokumen Fisik --}}
                            <div class="col-lg-7">
                                <div class="card h-100 border rounded-4 shadow-none mb-0">
                                    <div class="card-body p-4 p-lg-5">

                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <div class="avatar-md flex-shrink-0">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                                    <i class="ri-file-list-3-line"></i>
                                                </div>
                                            </div>

                                            <div>
                                                <h3 class="fs-5 fw-semibold mb-1">
                                                    Dokumen Persyaratan
                                                </h3>
                                                <p class="text-muted small mb-0">
                                                    Berkas yang perlu disiapkan
                                                </p>
                                            </div>
                                        </div>

                                        @php
                                            $documents = [
                                                [
                                                    'title' => 'Akta kelahiran anak',
                                                    'detail' => 'Fotokopi 2 lembar',
                                                ],
                                                [
                                                    'title' => 'Kartu Keluarga (KK)',
                                                    'detail' => 'Fotokopi 2 lembar',
                                                ],
                                                [
                                                    'title' => 'KTP ayah dan ibu',
                                                    'detail' => 'Fotokopi masing-masing 1 lembar',
                                                ],
                                                [
                                                    'title' => 'Pas foto anak',
                                                    'detail' => 'Ukuran 3 × 4, background sesuai ketentuan, 3 lembar',
                                                ],
                                                [
                                                    'title' => 'Materai Rp10.000',
                                                    'detail' => '1 lembar',
                                                ],
                                            ];
                                        @endphp

                                        <div class="d-flex flex-column gap-3">
                                            @foreach ($documents as $document)
                                                <div class="d-flex align-items-start gap-3">
                                                    <i class="ri-checkbox-circle-line text-primary fs-5 mt-1"></i>

                                                    <div>
                                                        <h4 class="fs-6 fw-semibold mb-1">
                                                            {{ $document['title'] }}
                                                        </h4>

                                                        <p class="text-muted small mb-0 lh-lg">
                                                            {{ $document['detail'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="alert alert-light border rounded-3 mt-4 mb-0">
                                            <div class="d-flex align-items-start gap-2">
                                                <i class="ri-information-line text-primary fs-5"></i>
                                                <p class="small text-muted mb-0 lh-lg">
                                                    Siapkan juga dokumen dalam bentuk digital
                                                    untuk keperluan pendataan online.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Berkas Digital dan Kategori --}}
                            <div class="col-lg-5">
                                <div class="d-flex flex-column gap-4 h-100">

                                    {{-- Berkas Digital --}}
                                    <div class="card border rounded-4 shadow-none mb-0">
                                        <div class="card-body p-4">

                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <div class="avatar-md flex-shrink-0">
                                                    <div class="avatar-title bg-info-subtle text-info rounded-3 fs-4">
                                                        <i class="ri-folder-upload-line"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h3 class="fs-5 fw-semibold mb-1">
                                                        Berkas Digital
                                                    </h3>
                                                    <p class="text-muted small mb-0">
                                                        Siapkan softfile dokumen
                                                    </p>
                                                </div>
                                            </div>

                                            <p class="text-muted lh-lg mb-3">
                                                Siapkan salinan digital dari dokumen berikut:
                                            </p>

                                            <ul class="list-unstyled mb-0">
                                                @foreach (['Kartu Keluarga (KK)', 'Pas foto anak', 'Akta kelahiran anak'] as $item)
                                                    <li class="d-flex align-items-start gap-2 mb-2">
                                                        <i class="ri-check-line text-info fs-5"></i>
                                                        <span>{{ $item }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>

                                    {{-- Kategori Siswa --}}
                                    <div class="card border rounded-4 shadow-none mb-0">
                                        <div class="card-body p-4">

                                            <div class="d-flex align-items-center gap-3 mb-3">
                                                <div class="avatar-md flex-shrink-0">
                                                    <div class="avatar-title bg-success-subtle text-success rounded-3 fs-4">
                                                        <i class="ri-group-line"></i>
                                                    </div>
                                                </div>

                                                <div>
                                                    <h3 class="fs-5 fw-semibold mb-1">
                                                        Kategori Siswa
                                                    </h3>
                                                    <p class="text-muted small mb-0">
                                                        Kategori pendataan
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column gap-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="ri-checkbox-circle-line text-success fs-5"></i>
                                                    <span class="fw-medium">Reguler</span>
                                                </div>

                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="ri-checkbox-circle-line text-success fs-5"></i>
                                                    <span class="fw-medium">Kakak dan Beradik</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- Alur Pendataan --}}
                        <div class="card border rounded-4 shadow-none mt-4 mb-0">
                            <div class="card-body p-4 p-lg-5">

                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="avatar-md flex-shrink-0">
                                        <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-4">
                                            <i class="ri-list-check-2"></i>
                                        </div>
                                    </div>

                                    <div>
                                        <h3 class="fs-5 fw-semibold mb-1">
                                            Syarat Pendataan SPMB
                                        </h3>
                                        <p class="text-muted small mb-0">
                                            Dua langkah utama pendataan
                                        </p>
                                    </div>
                                </div>

                                @php
                                    $registrationSteps = [
                                        'Mengisi formulir pendataan.',
                                        'Mengumpulkan persyaratan SPMB.',
                                    ];
                                @endphp

                                <div class="row g-3">
                                    @foreach ($registrationSteps as $step)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center gap-3 bg-light rounded-3 p-3 h-100">
                                                <div class="avatar-sm flex-shrink-0">
                                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fw-semibold">
                                                        {{ $loop->iteration }}
                                                    </div>
                                                </div>

                                                <span class="text-body fw-medium">
                                                    {{ $step }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        {{-- Informasi Biaya --}}
                        <div class="alert alert-light border rounded-4 mt-4 mb-0">
                            <div class="d-flex align-items-start gap-3">
                                <i class="ri-information-line fs-4 text-primary"></i>

                                <div>
                                    <h4 class="fs-6 fw-semibold mb-1">
                                        Informasi Biaya Awal
                                    </h4>

                                    <p class="text-muted small lh-lg mb-0">
                                        Ketentuan biaya awal berbeda sesuai kelompok kelas:
                                        KB B dan TK A membayar biaya pendaftaran dan seragam,
                                        sedangkan KB A membayar biaya pendaftaran dan ATK.
                                        Rincian biaya dapat dilihat pada bagian Informasi Biaya.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>


                <section class="py-5" id="ppdb-status">
                    <div class="container">
                        <div class="ppdb-status-panel rounded-4 p-4 p-lg-5 shadow">
                            <div class="row align-items-center g-4">
                                <div class="col-lg-6 ppdb-status-copy">
                                    <span class="ppdb-status-kicker">
                                        <i class="ri-search-eye-line"></i>
                                        Layanan Pendataan
                                    </span>

                                    <h3 class="fs-2 fw-bold text-white">
                                        Pantau Status Pendataan Calon Peserta Didik
                                    </h3>

                                    <p class="text-white-50">
                                        Gunakan fitur ini untuk memeriksa status pendataan
                                        calon peserta didik melalui portal SPMB KB IT & TK IT Al Hidayah
                                        Tahun Ajaran 2027/2028.
                                    </p>

                                    <div class="ppdb-status-points d-flex flex-wrap gap-3 text-white-50">
                                        <span class="d-inline-flex align-items-center gap-2">
                                            <i class="ri-checkbox-circle-line text-success"></i>
                                            Informasi status pendataan
                                        </span>

                                        <span class="d-inline-flex align-items-center gap-2">
                                            <i class="ri-checkbox-circle-line text-success"></i>
                                            Informasi proses seleksi
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    @livewire('p-p-d-b.landing.status-pendaftaran', [
                                        'jenjangSlug' => $jenjang->slug,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                @php
                    $faqs = [
                        [
                            'question' => 'Kapan pendataan SPMB dibuka?',
                            'answer' => 'Pendataan SPMB KB IT & TK IT Al Hidayah Tahun Ajaran 2027/2028 dibuka pada Desember 2026. Silakan mengikuti informasi dan jadwal pendataan yang disampaikan oleh pihak sekolah.',
                        ],
                        [
                            'question' => 'Bagaimana cara mengikuti pendataan?',
                            'answer' => 'Orang tua mengisi formulir pendataan secara online, kemudian melengkapi dan menyerahkan persyaratan SPMB sesuai ketentuan. Silakan ikuti tahapan yang dijelaskan pada bagian Alur Pendataan.',
                        ],
                        [
                            'question' => 'Dokumen apa saja yang perlu disiapkan?',
                            'answer' => 'Persyaratan meliputi fotokopi akta kelahiran sebanyak 2 lembar, fotokopi Kartu Keluarga sebanyak 2 lembar, fotokopi KTP ayah dan ibu masing-masing 1 lembar, serta pas foto calon siswa ukuran 3×4 sebanyak 3 lembar. Siapkan juga berkas digital Kartu Keluarga, foto anak, dan akta kelahiran.',
                        ],
                        [
                            'question' => 'Apa saja kategori pendataan SPMB?',
                            'answer' => 'Pendataan SPMB memiliki dua kategori, yaitu Reguler dan Kakak dan Beradik. Silakan pilih kategori yang sesuai dengan kondisi calon peserta didik.',
                        ],
                        [
                            'question' => 'Berapa biaya awal SPMB?',
                            'answer' => 'Pembayaran awal berbeda sesuai kelompok calon peserta didik. KB B dan TK A membayar biaya pendaftaran serta seragam, sedangkan KB A membayar biaya pendaftaran serta ATK. Rincian biaya dapat dilihat pada bagian Biaya SPMB.',
                        ],
                        [
                            'question' => 'Kapan pengukuran seragam dan asesmen diagnostik dilaksanakan?',
                            'answer' => 'Pengukuran seragam dan asesmen diagnostik dijadwalkan pada Maret–April 2027. Kegiatan ini menjadi bagian dari persiapan anak sebelum memulai kegiatan belajar di sekolah.',
                        ],
                        [
                            'question' => 'Kapan Awalussanah dan pembagian seragam dilaksanakan?',
                            'answer' => 'Kegiatan Awalussanah dan pembagian seragam dijadwalkan pada Mei–Juni 2027. Informasi lebih lanjut mengenai pelaksanaannya akan disampaikan oleh pihak sekolah.',
                        ],
                        [
                            'question' => 'Bagaimana jika saya membutuhkan informasi lebih lanjut?',
                            'answer' => 'Orang tua dapat menghubungi pihak KB IT & TK IT Al Hidayah melalui kontak resmi sekolah untuk memperoleh informasi lebih lanjut mengenai pendataan SPMB.',
                        ],
                    ];
                @endphp

                <section class="py-5" id="faq">
                    <div class="container">
                        <div class="text-center mx-auto mb-5" style="max-width: 650px;">
                            <span class="d-inline-block text-primary text-uppercase fw-semibold small mb-2">
                                FAQ
                            </span>

                            <h2 class="display-6 fw-bold mb-3">
                                Pertanyaan yang Sering Diajukan
                            </h2>

                            <p class="text-muted mb-0">
                                Informasi penting untuk membantu orang tua mempersiapkan
                                pendataan calon peserta didik baru.
                            </p>
                        </div>

                        <div class="accordion ppdb-faq" id="ppdbFaq">
                            @foreach ($faqs as $index => $faq)
                                <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                                    <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                        <button
                                            class="accordion-button fw-semibold {{ $index !== 0 ? 'collapsed' : '' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faqCollapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="faqCollapse{{ $index }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>

                                    <div
                                        id="faqCollapse{{ $index }}"
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                        aria-labelledby="faqHeading{{ $index }}"
                                        data-bs-parent="#ppdbFaq">
                                        <div class="accordion-body text-muted lh-lg">
                                            {{ $faq['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section class="py-5" id="daftar">
                    <div class="container">
                        <div class="ppdb-cta rounded-4 p-4 p-lg-5">
                            <div class="ppdb-cta-content">
                                <span class="ppdb-badge d-inline-flex mb-3">
                                    SPMB Tahun Ajaran 2027/2028
                                </span>

                                <h2 class="text-white">
                                    Bersiap Menjadi Bagian dari KB IT & TK IT Al Hidayah
                                </h2>

                                <p>
                                    Awali perjalanan belajar dan tumbuh kembang putra-putri Anda
                                    bersama KB IT & TK IT Al Hidayah. Pendataan dimulai Desember 2026.
                                    Siapkan persyaratan dan ikuti alur pendataan yang tersedia.
                                </p>

                                <div class="d-flex flex-wrap gap-2">
                                    @auth
                                        @if (in_array(auth()->user()->peran, ['SUPERADMIN', 'ADMIN']))
                                            <a href="{{ route('ppdb.admin.dashboard') }}"
                                                class="btn btn-primary rounded-pill">
                                                <i class="ri-dashboard-line me-1"></i>
                                                Dashboard Admin
                                            </a>
                                        @else
                                            <a href="{{ route('ppdb.dashboard', [
                                                'jenjang' => $jenjang->slug,
                                            ]) }}"
                                                class="btn btn-primary rounded-pill">
                                                <i class="ri-home-line me-1"></i>
                                                Dashboard SPMB
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('ppdb.daftar', [
                                            'jenjang' => $jenjang->slug,
                                        ]) }}"
                                            class="btn btn-primary rounded-pill">
                                            <i class="ri-user-add-line me-1"></i>
                                            Mulai Pendataan
                                        </a>
                                    @endauth

                                    <a href="#jadwal"
                                        class="btn ppdb-secondary-cta rounded-pill">
                                        <i class="ri-calendar-check-line me-1"></i>
                                        Lihat Alur Pendataan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </main>
                        
            <footer class="custom-footer bg-dark position-relative">
                <div class="container">

                    {{-- Main Footer --}}
                    <div class="row py-5 gy-4">

                        {{-- Informasi Sekolah --}}
                        <div class="col-lg-5 col-md-6">
                            <div>
                                <div class="mb-4">
                                    <img
                                        src="{{ asset('assets/logo/tk.png') }}"
                                        alt="Logo {{ $jenjang->nama_jenjang }}"
                                        height="50"
                                        class="rounded-2">
                                </div>

                                <p class="text-white fs-15 fw-medium mb-2">
                                    KB IT & TK IT Al Hidayah
                                </p>

                                <p class="text-white-50 ff-secondary mb-4"
                                    style="max-width: 420px;">
                                    Informasi SPMB Tahun Ajaran 2027/2028.
                                    Kenali profil sekolah, program unggulan, biaya,
                                    jadwal, dan persyaratan pendataan calon peserta didik.
                                </p>

                                <div class="d-flex align-items-start gap-2 text-white-50 mb-3">
                                    <i class="ri-map-pin-line text-white fs-18 mt-1"></i>
                                    <span class="ff-secondary fs-13">
                                        {{ $jenjang->alamat }}
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2 text-white-50">
                                    <i class="ri-whatsapp-line text-white fs-18"></i>
                                    <a
                                        href="https://wa.me/6282226266864"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="link-light ff-secondary fs-13">
                                        0822-2626-6864
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Navigasi Informasi --}}
                        <div class="col-lg-3 col-md-3 col-6">
                            <div>
                                <h5 class="text-white mb-4">
                                    Informasi
                                </h5>

                                <ul class="list-unstyled ff-secondary footer-list fs-14 mb-0">
                                    <li class="mb-2">
                                        <a href="#beranda">Beranda</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#profil">Profil Sekolah</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#program">Program Unggulan</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#biaya">Biaya SPMB</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#jadwal">Jadwal & Alur Pendataan</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#persyaratan">Persyaratan</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#faq">Pertanyaan Umum</a>
                                    </li>
                                    <li>
                                        <a href="#ppdb-status">Cek Status Pendataan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- CTA SPMB --}}
                        <div class="col-lg-4 col-md-3">
                            <div>
                                <h5 class="text-white mb-3">
                                    Bergabung Bersama Kami
                                </h5>

                                <p class="text-white-50 ff-secondary fs-14 mb-4">
                                    Awali perjalanan belajar dan tumbuh kembang
                                    putra-putri Anda bersama KB IT & TK IT Al Hidayah.
                                    Siapkan persyaratan dan ikuti pendataan
                                    Tahun Ajaran 2027/2028.
                                </p>

                                <div class="d-flex flex-wrap gap-2">
                                    @auth
                                        @if (in_array(auth()->user()->peran, ['SUPERADMIN', 'ADMIN']))
                                            <a
                                                href="{{ route('ppdb.admin.dashboard') }}"
                                                class="btn btn-primary rounded-pill px-4">
                                                <i class="ri-dashboard-line align-middle me-1"></i>
                                                Dashboard Admin
                                            </a>
                                        @else
                                            <a
                                                href="{{ route('ppdb.dashboard', [
                                                    'jenjang' => $jenjang->slug,
                                                ]) }}"
                                                class="btn btn-primary rounded-pill px-4">
                                                <i class="ri-home-line align-middle me-1"></i>
                                                Dashboard SPMB
                                            </a>
                                        @endif
                                    @else
                                        <a
                                            href="{{ route('ppdb.daftar', [
                                                'jenjang' => $jenjang->slug,
                                            ]) }}"
                                            class="btn btn-primary rounded-pill px-4">
                                            <i class="ri-pencil-line align-middle me-1"></i>
                                            Mulai Pendataan
                                            <i class="ri-arrow-right-line align-middle ms-1"></i>
                                        </a>
                                    @endauth

                                    <a
                                        href="#ppdb-status"
                                        class="btn btn-outline-light rounded-pill px-4">
                                        <i class="ri-search-line align-middle me-1"></i>
                                        Cek Status
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Divider --}}
                    <div class="border-top border-secondary opacity-25"></div>

                    {{-- Bottom Footer --}}
                    <div class="row align-items-center py-4 gy-3">

                        {{-- Copyright --}}
                        <div class="col-sm-6">
                            <p class="copy-rights mb-0 text-white-50 ff-secondary fs-13">
                                &copy; {{ date('Y') }}
                                KB IT & TK IT Al Hidayah.
                                Hak cipta dilindungi.
                            </p>
                        </div>

                        {{-- Footer Links --}}
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <a href="#beranda" class="link-light me-3">
                                    Beranda
                                </a>

                                @auth
                                    @if (in_array(auth()->user()->peran, ['SUPERADMIN', 'ADMIN']))
                                        <a
                                            href="{{ route('ppdb.admin.dashboard') }}"
                                            class="link-light me-3">
                                            Dashboard Admin
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('ppdb.dashboard', [
                                                'jenjang' => $jenjang->slug,
                                            ]) }}"
                                            class="link-light me-3">
                                            Dashboard SPMB
                                        </a>
                                    @endif
                                @else
                                    <a
                                        href="{{ route('ppdb.daftar', [
                                            'jenjang' => $jenjang->slug,
                                        ]) }}"
                                        class="link-light me-3">
                                        Mulai Pendataan SPMB
                                    </a>
                                @endauth

                                <a href="#ppdb-status" class="link-light">
                                    Cek Status
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>


            <a
                class="btn btn-success rounded-pill shadow-lg d-inline-flex align-items-center gap-2 px-4 py-3 fw-semibold position-fixed ppdb-help"
                href="https://wa.me/6282226266864?text={{ rawurlencode('Assalamu’alaikum, saya ingin bertanya mengenai SPMB TK/KB IT Al Hidayah Tahun Ajaran 2027/2028.') }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Hubungi panitia SPMB melalui WhatsApp"
                title="Hubungi panitia SPMB melalui WhatsApp">

                <i class="ri-whatsapp-line" aria-hidden="true"></i>
                <span>Bantuan SPMB</span>
            </a>
        </div>
        <script src="{{ asset('assets') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        @livewireScripts

        <script>
            window.addEventListener('show-modal', (event) => {
                const modalElement = document.getElementById(event.detail.modalId);

                if (!modalElement) {
                    console.error('Elemen modal tidak ditemukan:', event.detail.modalId);
                    return;
                }

                if (!window.bootstrap) {
                    console.error('Bootstrap JS belum tersedia.');
                    return;
                }

                window.bootstrap.Modal
                    .getOrCreateInstance(modalElement)
                    .show();
            });
        </script>
    </body>

</html>
