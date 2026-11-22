@extends('template_akademik.v_template')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row align-items-center mb-4">
            <div class="col">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm">
                        <span class="avatar-title rounded-3 bg-primary-subtle text-primary fs-22">
                            <i class="mdi {{ $page['icon'] }}"></i>
                        </span>
                    </div>
                    <div>
                        <h4 class="mb-1">{{ $page['title'] }}</h4>
                        <p class="text-muted mb-0">{{ $page['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-auto mt-3 mt-sm-0">
                <span class="badge bg-warning-subtle text-warning fs-12">
                    <i class="mdi mdi-eye-outline me-1"></i> Pratinjau statis
                </span>
            </div>
        </div>

        <div class="row">
            @foreach ($page['stats'] as $stat)
                <div class="col-xl-4 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">{{ $stat['label'] }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="text-{{ $stat['color'] }} fs-18"><i class="mdi {{ $stat['icon'] }}"></i></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-3">
                                <div>
                                    <h4 class="fs-22 fw-semibold mb-1">{{ $stat['value'] }}</h4>
                                    <span class="text-muted fs-13">{{ $stat['note'] }}</span>
                                </div>
                                <span class="avatar-sm">
                                    <span class="avatar-title rounded-circle bg-{{ $stat['color'] }}-subtle text-{{ $stat['color'] }} fs-20">
                                        <i class="mdi {{ $stat['icon'] }}"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h5 class="card-title mb-1">{{ $page['title'] }}</h5>
                        <p class="text-muted mb-0 fs-13">Data berikut merupakan contoh tampilan dan belum tersimpan ke database.</p>
                    </div>
                    <button type="button" class="btn btn-primary" disabled title="Fitur akan tersedia setelah modul dihubungkan ke data">
                        <i class="ri-add-line align-bottom me-1"></i> {{ $page['addLabel'] }}
                    </button>
                </div>
            </div>
            <div class="card-body border-top border-top-dashed">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-sm">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="Pencarian akan tersedia setelah data terhubung" disabled>
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <button type="button" class="btn btn-soft-secondary" disabled>
                            <i class="ri-filter-3-line me-1 align-bottom"></i> Filter
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                @foreach ($page['columns'] as $label)
                                    <th scope="col" class="text-nowrap">{{ $label }}</th>
                                @endforeach
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($page['rows'] as $row)
                                <tr>
                                    @foreach ($page['columns'] as $key => $label)
                                        <td class="text-nowrap">
                                            @if ($key === 'status')
                                                @php
                                                    $statusColor = in_array($row[$key], ['Aktif', 'Terjadwal'], true)
                                                        ? 'success'
                                                        : (in_array($row[$key], ['Akan Datang', 'Cuti'], true) ? 'warning' : 'secondary');
                                                @endphp
                                                <span class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }}">{{ $row[$key] }}</span>
                                            @else
                                                {{ $row[$key] }}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-soft-secondary" disabled aria-label="Detail">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-primary" disabled aria-label="Ubah">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer border-0">
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-muted fs-13">Menampilkan {{ count($page['rows']) }} data contoh</span>
                    <span class="text-muted fs-13">Aksi dan filter belum aktif</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
