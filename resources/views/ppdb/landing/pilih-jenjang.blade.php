<!doctype html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Jenjang SPMB</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo/yayasan.webp') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(145deg, #f8fafc, #eef2ff);
        }

        .jenjang-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .jenjang-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(15, 23, 42, 0.12);
        }
    </style>
</head>
<body>
    <nav class="navbar bg-white shadow-sm">
        <div class="container">
            <a class="d-flex align-items-center gap-2 fw-bold text-body text-decoration-none"
                href="{{ route('ppdb.landing') }}">
                <img src="{{ asset('assets/logo/yayasan.webp') }}"
                    alt="Logo sekolah"
                    width="40"
                    height="40"
                    class="rounded-3 object-fit-cover">
                <span>
                    {{ config('app.name') }}
                    <small class="d-block text-muted fw-semibold text-uppercase">SPMB Online</small>
                </span>
            </a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 680px;">
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3">
                Penerimaan Murid Baru
            </span>
            <h1 class="display-6 fw-bold mb-3">Pilih Jenjang Pendidikan</h1>
            <p class="text-muted fs-5 mb-0">
                Pilih jenjang untuk melihat informasi dan pendaftaran SPMB.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-xl-4">
                <a href="{{ route('ppdb.sd') }}" class="card jenjang-card h-100 border-0 shadow-sm rounded-4 text-decoration-none text-body">
                    <div class="card-body p-4 p-lg-5">
                        <div class="avatar-lg mb-4">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-4 fs-2">
                                <i class="ri-school-line"></i>
                            </div>
                        </div>
                        <h2 class="h4 fw-bold">Sekolah Dasar (SD)</h2>
                        <p class="text-muted mb-4">
                            Informasi dan pendaftaran untuk jenjang Sekolah Dasar.
                        </p>
                        <span class="text-primary fw-semibold">
                            Lihat SPMB SD <i class="ri-arrow-right-line ms-1"></i>
                        </span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-4">
                <a href="{{ route('ppdb.tk') }}" class="card jenjang-card h-100 border-0 shadow-sm rounded-4 text-decoration-none text-body">
                    <div class="card-body p-4 p-lg-5">
                        <div class="avatar-lg mb-4">
                            <div class="avatar-title bg-success-subtle text-success rounded-4 fs-2">
                                <i class="ri-seedling-line"></i>
                            </div>
                        </div>
                        <h2 class="h4 fw-bold">Taman Kanak-Kanak (TK)</h2>
                        <p class="text-muted mb-4">
                            Informasi dan pendaftaran untuk jenjang Taman Kanak-Kanak.
                        </p>
                        <span class="text-success fw-semibold">
                            Lihat SPMB TK <i class="ri-arrow-right-line ms-1"></i>
                        </span>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-4">
                <a href="{{ route('ppdb.kb') }}" class="card jenjang-card h-100 border-0 shadow-sm rounded-4 text-decoration-none text-body">
                    <div class="card-body p-4 p-lg-5">
                        <div class="avatar-lg mb-4">
                            <div class="avatar-title bg-warning-subtle text-warning rounded-4 fs-2">
                                <i class="ri-user-smile-line"></i>
                            </div>
                        </div>
                        <h2 class="h4 fw-bold">Kelompok Bermain (KB)</h2>
                        <p class="text-muted mb-4">
                            Informasi dan pendaftaran untuk jenjang Kelompok Bermain.
                        </p>
                        <span class="text-warning fw-semibold">
                            Lihat SPMB KB <i class="ri-arrow-right-line ms-1"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </main>
</body>
</html>
