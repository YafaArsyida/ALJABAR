
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Buku Induk Siswa</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 11pt;
            color: #222;
            line-height: 1.35;
        }


        /* IDENTITAS SISWA + FOTO */
        .student-intro-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .student-intro-table td {
            vertical-align: top;
            padding: 0;
        }

        .student-info-column {
            width: 79%;
            padding-right: 12px !important;
        }

        .student-photo-column {
            width: 21%;
            text-align: right;
        }

        .student-photo-box {
            width: 3cm;
            height: 4cm;
            border: 1px solid #999;
            margin-left: auto;
            text-align: center;
            overflow: hidden;
            font-size: 8pt;
            color: #888;
        }

        .student-photo-box img {
            width: 3cm;
            height: 4cm;
        }

        .student-intro-table .data-table {
            margin: 0;
        }

        .student-intro-table .data-table td {
            padding: 3px 4px;
        }

        .student-photo-caption {
            font-size: 8pt;
            text-align: center;
            margin-top: 4px;
            color: #666;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .header h2 {
            margin: 0;
            font-size: 16pt;
            text-transform: uppercase;
        }

        .header p {
            margin: 3px 0;
            font-size: 10pt;
        }

        .judul {
            text-align: center;
            margin-bottom: 18px;
        }

        .judul h3 {
            margin: 0;
            font-size: 14pt;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: bold;
            background: #eee;
            padding: 5px 7px;
            margin: 12px 0 6px;
            border: 1px solid #bbb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px 5px;
            vertical-align: top;
        }

        .label {
            width: 30%;
        }

        .separator {
            width: 10px;
        }

        .foto {
            width: 100px;
            height: 130px;
            border: 1px solid #999;
            text-align: center;
            vertical-align: middle;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 10pt;
        }
    </style>
</head>

<body>

    {{-- Identitas sekolah --}}
    <div class="header">
        <h2>BUKU INDUK SISWA</h2>
        <p>IDENTITAS DAN DATA ADMINISTRASI PESERTA DIDIK</p>
    </div>

    <div class="judul">
        <h3>Data Induk Peserta Didik</h3>
    </div>

    
    {{-- DATA PRIBADI --}}
    <div class="section-title">DATA PRIBADI</div>

    @php
        $dataPribadi = [
            ['Nama Lengkap Calon Peserta Didik', $calonSiswa->nama_siswa ?? '-'],
            ['Nama Panggilan', $calonSiswa->nama_panggilan ?? '-'],
            ['Jenis Kelamin', $calonSiswa->jenis_kelamin ?? '-'],
            ['Nomor Kartu Keluarga', $calonSiswa->no_kk ?? '-'],
            ['NIK (Nomor Induk Kependudukan)', $calonSiswa->nik ?? '-'],
            ['Tempat Lahir', $calonSiswa->tempat_lahir ?? '-'],
            [
                'Tanggal Lahir',
                !empty($calonSiswa->tanggal_lahir)
                    ? \Carbon\Carbon::parse($calonSiswa->tanggal_lahir)
                        ->locale('id')
                        ->translatedFormat('d F Y')
                    : '-',
            ],
            ['Cita-cita', $calonSiswa->cita_cita ?? '-'],
            ['Hobi', $calonSiswa->hobi ?? '-'],
            ['Agama', $calonSiswa->agama ?? '-'],
            ['Kewarganegaraan', $calonSiswa->kewarganegaraan ?? '-'],
            ['Anak Ke-', $calonSiswa->anak_ke ?? '-'],
            ['Jumlah Saudara Kandung', $calonSiswa->jumlah_saudara_kandung ?? '-'],
            ['Jumlah Saudara Tiri', $calonSiswa->jumlah_saudara_tiri ?? '-'],
            ['Anak Yatim/Piatu/Yatim Piatu', $calonSiswa->status_yatim_piatu ?? '-'],
            ['Berkebutuhan Khusus', $calonSiswa->berkebutuhan_khusus ?? '-'],
            ['Penyakit yang Pernah atau Sedang Diderita', $calonSiswa->penyakit ?? '-'],
            ['Alergi yang Diderita Anak', $calonSiswa->alergi ?? '-'],
            [
                'Tinggi Badan',
                is_numeric($calonSiswa->tinggi_badan ?? null)
                    ? number_format((float) $calonSiswa->tinggi_badan, 0, ',', '.') . ' cm'
                    : '-',
            ],
            [
                'Berat Badan',
                is_numeric($calonSiswa->berat_badan ?? null)
                    ? number_format((float) $calonSiswa->berat_badan, 0, ',', '.') . ' kg'
                    : '-',
            ],
            [
                'Tempat Tinggal',
                match ($alamat->jenis_tempat_tinggal ?? null) {
                    'rumah_orang_tua' => 'Rumah Orang Tua',
                    'rumah_wali' => 'Rumah Wali',
                    'asrama' => 'Asrama',
                    'panti_asuhan' => 'Panti Asuhan',
                    'kos' => 'Kos',
                    'kontrak' => 'Rumah Kontrak',
                    default => $alamat->jenis_tempat_tinggal ?? '-',
                },
            ],
            ['Alamat Jalan', $alamat->alamat_lengkap ?? '-'],
            [
                'RT/RW',
                isset($alamat)
                    ? (($alamat->rt ?? '-') . '/' . ($alamat->rw ?? '-'))
                    : '-',
            ],
            ['Nama Kelurahan/Desa', $alamat->kelurahan_desa ?? '-'],
            ['Kecamatan', $alamat->kecamatan ?? '-'],
            ['Kabupaten', $alamat->kabupaten ?? '-'],
            ['Kode Pos', $alamat->kode_pos ?? '-'],
            ['Penerima KPS/PKH/KIP', $calonSiswa->penerima_bantuan_sosial ?? '-'],
            ['No. KS/KKS/PKH/KIP (jika ada)', $calonSiswa->nomor_bantuan_sosial ?? '-'],
        ];
    @endphp

    {{-- IDENTITAS UTAMA DAN FOTO --}}
    <table class="student-intro-table">
        <tr>
            <td class="student-info-column">

                <table class="data-table">
                    <colgroup>
                        <col style="width: 25px;">
                        <col style="width: 35%;">
                        <col style="width: 10px;">
                        <col>
                    </colgroup>

                    <tbody>
                        @foreach (array_slice($dataPribadi, 0, 7) as $i => $item)
                            <tr>
                                <td class="number">{{ $i + 4 }}.</td>
                                <td class="label">{{ $item[0] }}</td>
                                <td class="separator">:</td>
                                <td class="value">{{ $item[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </td>

            <td class="student-photo-column">

                <div class="student-photo-box">
                    @if ($fotoSiswa)
                        <img src="{{ $fotoSiswa }}" alt="Foto Siswa">
                    @else
                        <div style="padding-top: 55px;">
                            FOTO SISWA
                        </div>
                    @endif
                </div>

                <div class="student-photo-caption">
                    Pas Foto
                </div>

            </td>
        </tr>
    </table>

    {{-- DATA PRIBADI LAINNYA --}}
    <table class="data-table">
        <colgroup>
            <col style="width: 25px;">
            <col style="width: 35%;">
            <col style="width: 10px;">
            <col>
        </colgroup>

        <tbody>
            @foreach (array_slice($dataPribadi, 7) as $i => $item)
                <tr>
                    <td class="number">{{ $i + 11 }}.</td>
                    <td class="label">{{ $item[0] }}</td>
                    <td class="separator">:</td>
                    <td class="value">{{ $item[1] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
