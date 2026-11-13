<div class="flex-grow-1">
    <div class="d-flex align-items-center gap-3">
        <div class="avatar-md flex-shrink-0">
            <div class="avatar-title bg-primary-subtle text-primary rounded-3 fs-3">
                <i class="ri-government-line"></i>
            </div>
        </div>

        <div>
            <h5 class="fw-bold mb-1">{{ $heading }}</h5>
            @if (!$showTahunAjar)
                <p class="text-muted mb-0">
                    {{ $jenjang->nama_jenjang ?? 'Pilih jenjang untuk melihat konteks transaksi.' }}
                </p>
            @elseif ($jenjang && $tahunAjar)
                <p class="text-muted mb-0">
                    {{ $jenjang->nama_jenjang }} &middot;
                    Tahun ajar {{ $tahunAjar->nama_tahun_ajar }}
                </p>
                <div class="small text-muted mt-1">
                    Periode:
                    {{ $tahunAjar->tanggal_mulai
                        ? \Carbon\Carbon::parse($tahunAjar->tanggal_mulai)->translatedFormat('d F Y')
                        : '-' }}
                    –
                    {{ $tahunAjar->tanggal_selesai
                        ? \Carbon\Carbon::parse($tahunAjar->tanggal_selesai)->translatedFormat('d F Y')
                        : '-' }}
                </div>
            @else
                <p class="text-muted mb-0">
                    Pilih jenjang dan tahun ajar untuk melihat konteks dashboard.
                </p>
            @endif
        </div>
    </div>
</div>
