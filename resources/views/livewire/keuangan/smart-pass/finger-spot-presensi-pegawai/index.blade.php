<div class="card">
    <div class="card-header bg-transparent border-bottom p-3 p-lg-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3 flex-grow-1">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="ri-fingerprint-line"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">SmartPass X FingerSpot Pegawai</h5>
                    <small class="text-muted">Tinjau dan ekspor data presensi pegawai.</small>
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap flex-shrink-0">
                <button wire:click="cetakLaporan" class="btn btn-primary rounded-pill px-4 d-inline-flex align-items-center gap-1">
                    <i class="ri-printer-line align-bottom"></i>
                    <span>Cetak Laporan</span>
                </button>
                <button data-bs-toggle="modal" data-bs-target="#ExportLaporanExcel" class="btn btn-primary rounded-pill px-4"><i
                        class="ri-file-excel-2-line pb-0"></i> Export</button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row g-3 align-items-end mb-3">
            <!-- Dropdown Kelas -->
            {{-- <div class="col-xxl-2 col-sm-6">
                <label for="selectJabatan" class="form-label">Jabatan</label>
                <select id="selectJabatan" wire:model="selectedJabatan" class="form-select">
                    <option value="">Semua Jabatan</option>
                    @foreach($jabatan as $j)
                    <option value="{{ $j->ms_jabatan_id }}">{{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div> --}}
            <!-- Input Pencarian -->
            <div class="col-xxl-6 col-sm-6">
                <label for="searchInput" class="form-label">Pencarian</label>
                <div class="position-relative">
                    <input type="text" id="searchInput" class="form-control ps-4" wire:model.debounce.300ms="search"
                        placeholder="Cari nama, deskripsi, atau lainnya...">
                    <i class="ri-search-line position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                </div>
            </div>
            <!-- Filter Periode -->
            <div class="col-xxl-4">
                <label class="form-label fw-semibold">Periode</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="date" id="startDate" class="form-control" wire:model="startDate" value="">
                    <span class="text-muted">–</span>
                    <input type="date" id="endDate" class="form-control" wire:model="endDate" value="">
                    <div class="col-auto">
                        <button type="button" class="btn btn-soft-secondary btn-icon rounded-circle"
                            wire:click="resetTanggal" title="Reset Tanggal">
                            <i class="ri-refresh-line fs-16"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="live-preview">
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th width="50px">No</th>
                            <th>Tanggal / Jam</th>
                            <th>Pegawai</th>
                            <th>Jabatan</th>
                            <th>Type</th>
                            <th>Cloud ID</th>
                            <th>Verify Method</th>
                            <th>Status Scan</th>
                            <th>Raw Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presensi as $index => $row)
                        <tr>
                            <td>{{ ($presensi->firstItem() + $index) }}</td>
                            <td>{{ $row->scan_time ? $row->scan_time->format('d-m-Y H:i:s') : '-' }}</td>
                            <td>{{ $row->ms_pegawai->nama_pegawai ?? '-' }}</td>
                            <td>{{ $row->ms_pegawai->ms_jabatan->nama_jabatan ?? '-' }}</td>
                            <td>{{ $row->type }}</td>
                            <td>{{ $row->cloud_id }}</td>
                            <td>{{ $row->verify_method }}</td>
                            <td>{{ $row->status_scan }}</td>
                            <td>
                                <pre class="mb-0">{{ json_encode($row->raw, JSON_PRETTY_PRINT) }}</pre>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-3">
                                Tidak ada data presensi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->
                {{ $presensi->links() }}
            </div>
        </div>

    </div>
</div>