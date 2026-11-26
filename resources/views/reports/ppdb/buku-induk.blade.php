<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buku Induk Siswa</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 10mm 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 10.5pt;
            line-height: 1.25;
            color: #000;
            margin: 0;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        /* KOP DOKUMEN */
        .header {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-table td {
            border: none;
            vertical-align: middle;
            text-align: center;
            padding: 0;
        }

        .header-logo {
            width: 16%;
        }

        .header-logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .header-title {
            width: 68%;
        }

        .header-title h1 {
            font-size: 16pt;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header-title h2 {
            font-size: 12pt;
            margin-top: 4px;
            text-transform: uppercase;
        }

        .header-title p {
            font-size: 9pt;
            margin-top: 3px;
        }

        /* JUDUL BAGIAN */
        .section-title {
            font-weight: bold;
            font-size: 10.5pt;
            background: #ececec;
            border-bottom: 1px solid #b5b5b5;
            padding: 3px 7px;
            margin: 10px 0 0;
            page-break-after: avoid;
        }

        /* TABEL DATA */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .data-table td {
            border: none;
            padding: 3px 4px;
            vertical-align: top;
        }

        .data-table .number {
            width: 3%;
            text-align: center;
        }

        .data-table .label {
            width: 28%;
        }

        .data-table .sub-label {
            width: 22%;
            font-weight: normal;
        }

        .data-table .separator {
            width: 2%;
            text-align: center;
        }

        .data-table .photo-cell {
            width: 18%;
            padding-right: 0;
            text-align: right;
            vertical-align: top;
        }

        tr {
            page-break-inside: avoid;
        }

        /* AREA FOTO */
        .photo-box {
            width: 3cm;
            height: 4cm;
            border: 1px solid #000;
            margin-left: auto;
            overflow: hidden;
            text-align: center;
            font-size: 8pt;
            color: #555;
        }

        .photo-box img {
            display: block;
            width: 3cm;
            height: 4cm;
            object-fit: cover;
        }

        .photo-placeholder {
            padding-top: 55px;
        }

        .photo-caption {
            margin-top: 3px;
            font-size: 8pt;
            text-align: center;
            color: #555;
        }

        .nomor-induk-box {
            width: 100%;
            margin-top: 8px;
            border: 1px solid #333;
            box-sizing: border-box;
        }

        .nomor-induk-label {
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            padding: 4px 2px;
            border-bottom: 1px solid #333;
        }

        .nomor-induk-area {
            height: 30px;
        }
    </style>
</head>

<body>
    @php
        $jenjangAktif = $jenjang ?? null;
        $namaSekolah = filled($namaJenjang ?? null)
            ? $namaJenjang
            : ($jenjangAktif->nama_jenjang ?? '-');
        $sebutanJenjang = strtoupper((string) ($jenjangAktif->slug ?? '')) ?: 'Sekolah';

        $teks = function ($value) {
            return filled($value) ? $value : '-';
        };

        $tanggalIndonesia = function ($value) {
            if (! filled($value)) {
                return '-';
            }

            return \Carbon\Carbon::parse($value)
                ->locale('id')
                ->translatedFormat('d F Y');
        };

        $angka = function ($value) {
            return is_numeric($value)
                ? number_format((float) $value, 0, ',', '.')
                : null;
        };

        $pendidikanLabel = function ($value) {
            return match (strtoupper(trim((string) $value))) {
                'TIDAK_SEKOLAH' => 'Tidak Sekolah',
                'SD' => 'SD/Sederajat',
                'SMP' => 'SMP/Sederajat',
                'SMA' => 'SMA/SMK/Sederajat',
                'D1_D2_D3' => 'Diploma (D1/D2/D3)',
                'S1' => 'Sarjana (S1)',
                'S2' => 'Magister (S2)',
                'S3' => 'Doktor (S3)',
                '' => '-',
                default => (string) $value,
            };
        };

        $tempatLahir = trim((string) ($calonSiswa?->tempat_lahir ?? ''));
        $tanggalLahir = $calonSiswa?->tanggal_lahir
            ? $tanggalIndonesia($calonSiswa->tanggal_lahir)
            : null;
        $tempatTanggalLahir = collect([$tempatLahir, $tanggalLahir])
            ->filter(function ($value) {
                return filled($value);
            })
            ->implode(', ') ?: '-';

        $alamatParts = [];

        if (filled($alamat?->alamat_lengkap)) {
            $alamatParts[] = $alamat->alamat_lengkap;
        }

        if (filled($alamat?->rt) || filled($alamat?->rw)) {
            $alamatParts[] =
                'RT ' . ($alamat->rt ?: '-') .
                '/RW ' . ($alamat->rw ?: '-');
        }

        foreach (['kelurahan_desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos'] as $kolomAlamat) {
            if (filled($alamat?->{$kolomAlamat})) {
                $alamatParts[] = $alamat->{$kolomAlamat};
            }
        }

        $alamatLengkap = $alamatParts
            ? implode(', ', $alamatParts)
            : '-';

        $teleponSiswa = $orangTua?->telepon_ayah
            ?: ($orangTua?->telepon_ibu
                ?: ($orangTua?->telepon_wali ?: '-'));

        $tempatTinggal = match ($alamat?->jenis_tempat_tinggal) {
            'rumah_orang_tua' => 'Rumah Orang Tua',
            'rumah_wali' => 'Rumah Wali',
            'asrama' => 'Asrama',
            'panti_asuhan' => 'Panti Asuhan',
            'kos' => 'Kos',
            'kontrak' => 'Rumah Kontrak',
            default => filled($alamat?->jenis_tempat_tinggal)
                ? $alamat->jenis_tempat_tinggal
                : '-',
        };

        $beratBadan = $angka($calonSiswa?->berat_badan);
        $tinggiBadan = $angka($calonSiswa?->tinggi_badan);
        $beratTinggi = collect([
            $beratBadan !== null ? $beratBadan . ' kg' : null,
            $tinggiBadan !== null ? $tinggiBadan . ' cm' : null,
        ])->filter()->implode(' / ') ?: '-';

        $dataAnak = [
            ['Nama Lengkap', $teks($calonSiswa?->nama_siswa)],
            ['Nama Panggilan', $teks($calonSiswa?->nama_panggilan)],
            ['Jenis Kelamin', $teks($calonSiswa?->jenis_kelamin)],
            ['Tempat, Tanggal Lahir', $tempatTanggalLahir],
            ['Agama', $teks($calonSiswa?->agama)],
            ['Kewarganegaraan', $teks($calonSiswa?->kewarganegaraan)],
            ['Anak nomor ke', $teks($calonSiswa?->anak_ke)],
            ['Jumlah saudara kandung', $teks($calonSiswa?->jumlah_saudara_kandung)],
            ['Jumlah saudara tiri', $teks($calonSiswa?->jumlah_saudara_tiri)],
            ['Jumlah saudara angkat', '-'],
            ['Bahasa sehari-hari', '-'],
            ['Berat / tinggi badan', $beratTinggi],
            ['Golongan darah', '-'],
            ['Penyakit yang pernah diderita', $teks($calonSiswa?->penyakit)],
            ['Alamat tempat tinggal', $alamatLengkap],
            ['Telepon / nomor WA', $teleponSiswa],
            ['Bertempat tinggal pada', $tempatTinggal],
        ];

        $jenjangAsal = strtoupper(trim((string) ($pendidikan?->jenjang_asal ?? '')));
        $asalSekolah = trim((string) ($pendidikan?->asal_sekolah ?? ''));
        $normalisasiNama = function ($value) {
            return preg_replace('/[^A-Z0-9]/', '', strtoupper((string) $value));
        };

        $slugJenjang = strtoupper((string) ($jenjangAktif->slug ?? ''));
        $progresiNormal = ($slugJenjang === 'SD' && $jenjangAsal === 'TK')
            || ($slugJenjang === 'TK' && $jenjangAsal === 'KB');
        $sekolahSama = $asalSekolah !== ''
            && $normalisasiNama($asalSekolah) === $normalisasiNama($namaSekolah);
        $isPindahan = $asalSekolah !== '' && ! $progresiNormal && ! $sekolahSama;

        $statusMasuk = $isPindahan
            ? 'Pindahan'
            : 'Anak Didik Baru';

        $tanggalPindahan = filled($pendidikan?->asal_sekolah)
            && filled($pendidikan?->tahun_lulus)
                ? 'Tahun ' . $pendidikan->tahun_lulus
                : '-';

        // $tanggalDiterima = $pendaftaran->submitted_at ?? $pendaftaran->created_at;
        // $tanggalDiterima = $tanggalDiterima
        //     ? $tanggalIndonesia($tanggalDiterima)
        //     : '-';
        $tanggalDiterima = '1 Juli 2027'
    @endphp

    {{-- KOP DOKUMEN --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <img src="{{ public_path('assets/logo/' . ($logoSekolah ?? 'tk.png')) }}"
                        alt="Logo {{ $namaSekolah }}">
                </td>

                <td class="header-title">
                    <h1>Buku Induk Siswa</h1>
                    <h2>{{ $namaSekolah }}</h2>
                    @if (filled($alamatSekolah ?? null))
                        <p>{{ $alamatSekolah }}</p>
                    @endif
                </td>

                <td class="header-logo">
                    <img src="{{ public_path('assets/logo/yayasan.webp') }}"
                        alt="Logo Yayasan Al Hidayah">
                </td>
            </tr>
        </table>
    </div>

    {{-- A. KETERANGAN ANAK DIDIK --}}
    <div class="section-title">A. KETERANGAN ANAK DIDIK</div>

    <table class="data-table">

        <tbody>
            @foreach ($dataAnak as $index => $item)
                <tr>
                    <td class="number">{{ $index + 1 }}.</td>
                    <td class="label">{{ $item[0] }}</td>
                    <td class="separator">:</td>

                    @if ($index === 0)
                        <td class="value">{{ $item[1] }}</td>
                        <td class="photo-cell" rowspan="8">
                            <div class="photo-box">
                                @if ($fotoSiswa)
                                    <img src="{{ $fotoSiswa }}"
                                        alt="Foto {{ $calonSiswa?->nama_siswa ?? 'Siswa' }}">
                                @else
                                    <div class="photo-placeholder">
                                        FOTO<br>3 x 4
                                    </div>
                                @endif
                            </div>

                            <div class="nomor-induk-box">
                                {{-- <div class="nomor-induk-label">Nomor Induk</div> --}}
                                <div class="nomor-induk-area"></div>
                            </div>
                        </td>
                    @elseif ($index < 8)
                        <td class="value">{{ $item[1] }}</td>
                    @else
                        <td class="value" colspan="2">{{ $item[1] }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- B. ORANG TUA / WALI --}}
    <div class="section-title">B. ORANG TUA / WALI</div>
    <table class="data-table">
        <tbody>
            <tr>
                <td class="number">18.</td>
                <td class="label">Nama Orang Tua</td>
                <td class="sub-label">Ayah Kandung</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->nama_ayah) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Ibu Kandung</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->nama_ibu) }}</td>
            </tr>

            <tr>
                <td class="number">19.</td>
                <td class="label">Pendidikan Tertinggi</td>
                <td class="sub-label">Ayah Kandung</td>
                <td class="separator">:</td>
                <td class="value">{{ $pendidikanLabel($orangTua?->pendidikan_ayah) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Ibu Kandung</td>
                <td class="separator">:</td>
                <td class="value">{{ $pendidikanLabel($orangTua?->pendidikan_ibu) }}</td>
            </tr>

            <tr>
                <td class="number">20.</td>
                <td class="label">Pekerjaan Orang Tua</td>
                <td class="sub-label">Ayah Kandung</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->pekerjaan_ayah) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Ibu Kandung</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->pekerjaan_ibu) }}</td>
            </tr>

            <tr>
                <td class="number">21.</td>
                <td class="label">Wali Anak</td>
                <td class="sub-label">Nama</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->nama_wali) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Pendidikan Tertinggi</td>
                <td class="separator">:</td>
                <td class="value">{{ $pendidikanLabel($orangTua?->pendidikan_wali) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Hubungan Keluarga</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->hubungan_wali) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Pekerjaan</td>
                <td class="separator">:</td>
                <td class="value">{{ $teks($orangTua?->pekerjaan_wali) }}</td>
            </tr>
        </tbody>
    </table>

    {{-- C. ASAL MULA ANAK --}}
    <div class="section-title">C. ASAL MULA ANAK</div>
    <table class="data-table">
        <tbody>
            <tr>
                <td class="number">22.</td>
                <td class="label">Masuk {{ $sebutanJenjang }} ini sebagai</td>
                <td class="sub-label"></td>
                <td class="separator">:</td>
                <td class="value" colspan="3">{{ $statusMasuk }}</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td class="number">23.</td>
                <td class="label">Pindahan dari</td>
                <td class="sub-label">Nama Sekolah</td>
                <td class="separator">:</td>
                <td class="value" colspan="3">{{ $teks($pendidikan?->asal_sekolah) }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Tanggal</td>
                <td class="separator">:</td>
                <td class="value" colspan="3">{{ $tanggalPindahan }}</td>
            </tr>

            <tr>
                <td class="number">24.</td>
                <td class="label">Diterima di sekolah ini</td>
                <td class="sub-label">Tanggal</td>
                <td class="separator">:</td>
                <td class="value" colspan="3">{{ $tanggalDiterima }}</td>
            </tr>
            <tr>
                <td class="number"></td>
                <td class="label"></td>
                <td class="sub-label">Di kelompok / kelas</td>
                <td class="separator">:</td>
                <td class="value">-</td>
            </tr>
        </tbody>
    </table>

</body>

</html>

