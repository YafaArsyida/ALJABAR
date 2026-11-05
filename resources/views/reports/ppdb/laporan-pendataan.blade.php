<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 14mm 10mm 16mm;
        }

        body {
            color: #0f172a;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
        }

        .report-kicker {
            color: #64748b;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .report-title {
            color: #0f172a;
            font-size: 18px;
            font-weight: bold;
            margin: 3px 0;
        }

        .printed {
            color: #64748b;
            font-size: 8px;
            text-align: right;
        }

        .printed strong {
            color: #0f172a;
            font-size: 10px;
        }

        .filters {
            border-collapse: separate;
            border-spacing: 4px;
            margin: 8px -4px;
            width: 100%;
        }

        .filter-cell {
            background-color: #f1f5f9;
            padding: 7px;
            vertical-align: top;
        }

        .filter-label {
            color: #64748b;
            font-size: 7px;
            font-weight: bold;
        }

        .summary {
            background-color: #eff6ff;
            margin: 8px 0;
            padding: 8px;
        }

        .summary-label {
            color: #64748b;
            font-size: 7px;
            font-weight: bold;
        }

        .summary-value {
            color: #1d4ed8;
            font-size: 12px;
            font-weight: bold;
            margin-top: 4px;
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
            font-size: 8px;
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

        .muted {
            color: #64748b;
        }

        .empty {
            color: #64748b;
            padding: 14px !important;
            text-align: center;
        }

        .page-footer {
            bottom: -9mm;
            color: #94a3b8;
            font-size: 7px;
            position: fixed;
            right: 0;
            text-align: right;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="page-footer">{{ $judul }}</div>

    <table width="100%">
        <tr>
            <td width="70%">
                <div class="report-kicker">LAPORAN SPMB</div>
                <div class="report-title">{{ $judul }}</div>
                <div>{{ $jenjang }}</div>
            </td>
            <td class="printed" width="30%" valign="top">
                DICETAK<br>
                <strong>{{ $dicetakPada }}</strong>
            </td>
        </tr>
    </table>

    <table class="filters">
        <tr>
            <td class="filter-cell" width="25%">
                <span class="filter-label">PERIODE SPMB</span><br>
                <strong>{{ $periode }}</strong>
            </td>
            <td class="filter-cell" width="25%">
                <span class="filter-label">JALUR SELEKSI</span><br>
                <strong>{{ $jalur }}</strong>
            </td>
            <td class="filter-cell" width="50%">
                <span class="filter-label">PENCARIAN</span><br>
                <strong>{{ $pencarian }}</strong>
            </td>
        </tr>
    </table>

    <table class="summary" width="100%">
        <tr>
            <td>
                <div class="summary-label">JUMLAH CALON SISWA DITERIMA</div>
                <div class="summary-value">{{ $jumlahCalonSiswa }}</div>
            </td>
        </tr>
    </table>

    <table class="records">
        <thead>
            <tr>
                <th class="center" width="5%">No.</th>
                <th width="27%">Nama Calon Siswa</th>
                <th width="20%">Nomor Pendataan</th>
                <th width="18%">Jalur Seleksi</th>
                <th width="15%">Tanggal Pendataan</th>
                <th width="15%">Kontak Orang Tua</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr class="{{ $loop->even ? 'row-alt' : '' }}">
                    <td class="center muted">{{ $item['nomor'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['nomorPendataan'] }}</td>
                    <td>{{ $item['jalur'] }}</td>
                    <td>{{ $item['tanggalPendataan'] }}</td>
                    <td>{{ $item['telepon'] }}</td>
                </tr>
            @empty
                <tr>
                    <td class="empty" colspan="6">Tidak ada calon siswa diterima pada kriteria laporan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
