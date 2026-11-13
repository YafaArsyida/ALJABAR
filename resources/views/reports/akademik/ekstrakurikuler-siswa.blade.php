<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 14mm 10mm 16mm;
        }

        body {
            color: #0f172a;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
        }

        .report-title {
            color: #0f172a;
            font-size: 18px;
            font-weight: bold;
            margin: 3px 0;
        }

        .muted {
            color: #64748b;
        }

        .summary {
            background-color: #eff6ff;
            margin: 10px 0;
            padding: 8px;
        }

        .records {
            border-collapse: collapse;
            width: 100%;
        }

        .records thead {
            display: table-header-group;
        }

        .records th {
            background-color: #1e3a5f;
            border: 1px solid #1e3a5f;
            color: #fff;
            padding: 7px 5px;
            text-align: left;
        }

        .records td {
            border-bottom: 1px solid #e2e8f0;
            padding: 6px 5px;
            vertical-align: top;
        }

        .records .row-alt td {
            background-color: #f8fafc;
        }

        .center {
            text-align: center;
        }

        .empty {
            color: #64748b;
            padding: 14px !important;
            text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td>
                <div class="muted">LAPORAN EKSTRAKURIKULER</div>
                <div class="report-title">{{ $judul }}</div>
                <div>{{ $namaEkstrakurikuler }} &mdash; {{ $jenjang }} / {{ $tahunAjar }}</div>
            </td>
            <td class="muted" align="right" valign="top">
                DICETAK<br>
                <strong>{{ $dicetakPada }}</strong>
            </td>
        </tr>
    </table>

    <table class="summary" width="100%">
        <tr>
            <td>
                <strong>Jumlah siswa:</strong> {{ $jumlahSiswa }}
                &nbsp;&nbsp; <strong>Pencarian:</strong> {{ $pencarian }}
            </td>
        </tr>
    </table>

    <table class="records">
        <thead>
            <tr>
                <th class="center" width="5%">No.</th>
                <th width="40%">Nama Siswa</th>
                <th width="15%">Kelas</th>
                <th width="20%">Ekstrakurikuler</th>
                <th width="20%">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr class="{{ $loop->even ? 'row-alt' : '' }}">
                    <td class="center muted">{{ $item['nomor'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['kelas'] }}</td>
                    <td>{{ $item['ekstrakurikuler'] }}</td>
                    <td>Rp{{ $item['biaya'] }}</td>
                </tr>
            @empty
                <tr>
                    <td class="empty" colspan="5">Tidak ada siswa pada kriteria laporan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
