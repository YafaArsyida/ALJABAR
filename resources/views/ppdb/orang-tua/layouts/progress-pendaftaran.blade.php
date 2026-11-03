@php
    $steps = [
        1 => 'Pilih Jalur',
        2 => 'Data Siswa',
        3 => 'Orang Tua/Wali',
        4 => 'Alamat',
        5 => 'Pendidikan',
        6 => 'Berkas',
        7 => 'Review',
        8 => 'Pengiriman',
    ];

    $totalStep = count($steps);
    $stepAktif = max(1, min($stepAktif ?? 1, $totalStep));
    $persentase = round(($stepAktif / $totalStep) * 100);
    $currentStep = min(max((int) ($pendaftaran->current_step ?? 0), 0), $totalStep);
    $routeStep = [
        1 => 'ppdb.pendaftaran.jalur',
        2 => 'ppdb.pendaftaran.data-siswa',
        3 => 'ppdb.pendaftaran.orang-tua',
        4 => 'ppdb.pendaftaran.alamat',
        5 => 'ppdb.pendaftaran.pendidikan',
        6 => 'ppdb.pendaftaran.berkas',
        7 => 'ppdb.pendaftaran.review',
        8 => 'ppdb.pendaftaran.status',
    ];
@endphp

<div class="card border shadow-none rounded-4 mb-4">
    <div class="card-body">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-3">
            <div>
                <h6 class="fw-semibold mb-1">{{ $judulProgress ?? 'Progres Pendataan SPMB' }}</h6>
                <small class="text-muted">
                    {{ $deskripsiProgress ?? 'Lengkapi setiap langkah untuk menyelesaikan pendataan SPMB.' }}
                </small>
            </div>

            <span class="text-primary fw-semibold">
                {{ $persentase }}%
            </span>
        </div>

        <div
            class="progress rounded-pill"
            style="height: 8px;"
            role="progressbar"
            aria-label="{{ $labelProgress ?? 'Progres pendataan SPMB' }}"
            aria-valuenow="{{ $persentase }}"
            aria-valuemin="0"
            aria-valuemax="100"
        >
            <div
                class="progress-bar bg-primary"
                style="width: {{ $persentase }}%;"
            ></div>
        </div>

        <div class="d-flex flex-wrap gap-3 mt-3">
            @foreach ($steps as $nomor => $nama)
                @php
                    $selesai = $nomor < $stepAktif;
                    $aktif = $nomor === $stepAktif;
                    $bisaDibuka = $pendaftaran && $nomor <= $currentStep;
                @endphp

                @if ($bisaDibuka)
                    <a
                        href="{{ route($routeStep[$nomor], [
                            'jenjang' => request()->route('jenjang'),
                        ]) }}"
                        class="d-flex align-items-center gap-2 text-decoration-none
                            {{ $selesai ? 'text-success' : ($aktif ? 'text-primary' : 'text-muted') }}"
                        aria-label="Buka langkah {{ $nama }}"
                    >
                @else
                    <div class="d-flex align-items-center gap-2
                        {{ $selesai ? 'text-success' : ($aktif ? 'text-primary' : 'text-muted') }}">
                @endif

                    <div class="avatar-xs">
                        <div class="avatar-title rounded-circle fs-12
                            {{ $selesai
                                ? 'bg-success-subtle text-success'
                                : ($aktif
                                    ? 'bg-primary text-white'
                                    : 'bg-light text-muted') }}">

                            @if ($selesai)
                                <i class="ri-check-line"></i>
                            @else
                                {{ str_pad($nomor, 2, '0', STR_PAD_LEFT) }}
                            @endif
                        </div>
                    </div>

                    <span class="small {{ $aktif ? 'fw-semibold' : '' }}">
                        {{ $nama }}
                    </span>
                @if ($bisaDibuka)
                    </a>
                @else
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</div>