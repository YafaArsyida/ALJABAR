
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    {{-- HEADER --}}
    <div class="card-header border-bottom">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            {{-- TITLE --}}
            <div class="d-flex align-items-center gap-3">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="ri-group-line"></i>
                    </div>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">
                        Data Siswa
                    </h5>
                    <small class="text-muted">
                        Kelola data siswa dan informasi akademik berdasarkan kelas.
                    </small>
                </div>
            </div>

            {{-- ACTION --}}
            @if ($selectedJenjang && $selectedTahunAjar)
                <div class="d-flex align-items-center flex-wrap gap-2">

                    {{-- IMPORT SISWA --}}
                    <button type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#ModalImportSiswa"
                        wire:click.prevent="$emit('showImportSiswa', {{ $selectedJenjang }}, {{ $selectedTahunAjar }})"
                        class="btn btn-soft-primary border rounded-pill px-4">
                        <i class="ri-contacts-line me-1"></i>
                        Import Siswa
                    </button>

                    {{-- EXPORT --}}
                    <button type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#ModalIndexSiswa"
                        class="btn btn-soft-success rounded-pill px-4">
                        <i class="ri-file-excel-2-line me-1"></i>
                        Export
                    </button>

                    {{-- SISWA BARU --}}
                    <button type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#ModalAddSiswa"
                        wire:click.prevent="$emit('showCreateSiswa', {{ $selectedJenjang }}, {{ $selectedTahunAjar }})"
                        class="btn btn-primary rounded-pill px-4">
                        <i class="ri-play-list-add-line me-1"></i>
                        Siswa Baru
                    </button>

                </div>
            @endif

        </div>
    </div>

    {{-- BODY --}}
    <div class="card-body">

        {{-- FILTER DATA --}}
        <div class="row g-3 mb-3">

            {{-- PENCARIAN --}}
            <div class="col-12 col-lg-6">
                <label for="searchData"
                    class="form-label small text-muted text-uppercase fw-medium mb-2">
                    Pencarian
                </label>

                <div class="search-box">
                    <input type="text"
                        id="searchData"
                        class="form-control search"
                        wire:model.debounce.300ms="search"
                        placeholder="Cari nama, deskripsi, atau lainnya...">

                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>

            {{-- FILTER KELAS --}}
            <div class="col-6 col-lg-3">
                <label for="filterKelas"
                    class="form-label small text-muted text-uppercase fw-medium mb-2">
                    Kelas
                </label>

                <select id="filterKelas"
                    wire:model="selectedKelas"
                    class="form-select"
                    style="cursor: pointer;"
                    data-bs-toggle="tooltip"
                    data-bs-trigger="hover"
                    data-bs-placement="top"
                    title="Pilih Kelas">
                    <option value="">Semua Kelas</option>
                    @foreach ($select_kelas as $item)
                        <option value="{{ $item->ms_kelas_id }}">
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- JUMLAH DATA --}}
            <div class="col-6 col-lg-3">
                <label for="perPage"
                    class="form-label small text-muted text-uppercase fw-medium mb-2">
                    Tampilkan
                </label>

                <select id="perPage"
                    wire:model="perPage"
                    class="form-select"
                    style="cursor: pointer;">
                    <option value="10">10 Data</option>
                    <option value="20">20 Data</option>
                    <option value="30">30 Data</option>
                    <option value="40">40 Data</option>
                    <option value="50">50 Data</option>
                    <option value="75">75 Data</option>
                    <option value="100">100 Data</option>
                </select>
            </div>

        </div>

        <div
            wire:loading.delay
            wire:target="search,selectedKelas,gotoPage,nextPage,previousPage,perPage,refreshJenjangs"
            class="text-muted small mb-3"
        >
            <span class="spinner-border spinner-border-sm me-1"></span>
            Memuat data siswa...
        </div>
        
        {{-- DATA SISWA --}}
        <div class="live-preview">

            {{-- JENJANG DAN TAHUN AJAR BELUM DIPILIH --}}
            @if (!$selectedJenjang || !$selectedTahunAjar)

                <div class="text-center py-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/msoeawqm.json"
                        trigger="loop"
                        colors="primary:#405189,secondary:#08a88a"
                        style="width:75px;height:75px">
                    </lord-icon>

                    <h5 class="mt-2 fw-semibold">
                        Silakan Pilih Jenjang dan Tahun Ajar
                    </h5>
                    <p class="text-muted small mb-0">
                        Untuk melihat data siswa, harap pilih Jenjang dan Tahun Ajar terlebih dahulu.
                    </p>
                </div>

            @else

                {{-- TABEL DATA SISWA --}}
                <div class="table-responsive">
                    <table id="DataIndexSiswa"
                        class="table table-hover table-nowrap align-middle mb-0"
                        style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" class="text-center" style="width:50px;">Hapus</th>
                                <th scope="col">Siswa</th>
                                <th scope="col">Jenjang</th>
                                <th scope="col">Tahun Ajar</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Telepon</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($siswas as $key => $item)
                                <tr>
                                    <td>
                                        {{ $siswas->firstItem() + $key }}.
                                    </td>

                                    {{-- HAPUS --}}
                                    <td class="text-center">
                                        <a href="#ModalDeleteSiswa"
                                            data-bs-toggle="modal"
                                            class="text-danger d-inline-block remove-item-btn"
                                            wire:click.prevent="$emit('confirmDeleteSiswa', {{ $item->ms_penempatan_siswa_id }})"
                                            data-bs-trigger="hover"
                                            data-bs-placement="top"
                                            title="Hapus Siswa">
                                            <i class="ri-delete-bin-5-fill fs-14"></i>
                                        </a>
                                    </td>

                                    {{-- SISWA --}}
                                    <td class="fw-medium">
                                        {{ $item->ms_siswa->nama_siswa }}
                                    </td>

                                    {{-- JENJANG --}}
                                    <td>
                                        {{ $item->ms_jenjang->nama_jenjang }}
                                    </td>

                                    {{-- TAHUN AJAR --}}
                                    <td>
                                        {{ $item->ms_tahun_ajar->nama_tahun_ajar }}
                                    </td>

                                    {{-- KELAS --}}
                                    <td>
                                        {{ $item->ms_kelas->nama_kelas }}
                                    </td>

                                    {{-- TELEPON --}}
                                    <td>
                                        <span class="fw-semibold text-success">
                                            {{ $item->ms_siswa->telepon }}
                                        </span>
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- DETAIL --}}
                                            <a href="#ModalDetailSiswa"
                                                data-bs-toggle="modal"
                                                class="btn btn-soft-primary border btn-sm rounded-pill px-3"
                                                title="Detail Siswa"
                                                wire:click.prevent="$emit('showDetailSiswa', {{ $item->ms_penempatan_siswa_id }})">
                                                <i class="ri-eye-line me-1"></i>
                                                Detail
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="#ModalEditSiswa"
                                                data-bs-toggle="modal"
                                                class="btn btn-primary btn-sm rounded-pill px-3"
                                                title="Edit Siswa"
                                                wire:click="$emit('loadDataSiswa', {{ $item->ms_penempatan_siswa_id }})">
                                                <i class="ri-mark-pen-line me-1"></i>
                                                Edit
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                {{-- DATA KOSONG --}}
                                <tr>
                                    <td colspan="8">
                                        <div class="text-center py-4">
                                            <lord-icon
                                                src="https://cdn.lordicon.com/msoeawqm.json"
                                                trigger="loop"
                                                colors="primary:#405189,secondary:#08a88a"
                                                style="width:75px;height:75px">
                                            </lord-icon>

                                            <h5 class="fw-semibold mt-2 mb-2">
                                                Maaf, Tidak Ada Data yang Ditemukan
                                            </h5>
                                            <p class="text-muted small mb-0">
                                                Kami telah mencari keseluruhan data,
                                                namun tidak ditemukan hasil yang sesuai.
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">

                    <div class="text-muted small">
                        Menampilkan
                        <span class="fw-semibold">
                            {{ $siswas->firstItem() ?? 0 }}
                        </span>
                        -
                        <span class="fw-semibold">
                            {{ $siswas->lastItem() ?? 0 }}
                        </span>
                        dari
                        <span class="fw-semibold">
                            {{ $siswas->total() }}
                        </span>
                        data siswa
                    </div>

                    <div>
                        {{ $siswas->links() }}
                    </div>

                </div>

            @endif
        </div>
    </div>

    {{-- MODAL EXPORT --}}
    <div class="modal fade" id="ModalIndexSiswa" tabindex="-1"
        aria-labelledby="exportRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header border-0 pb-0">
                    <button type="button"
                        class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal"
                        aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                {{-- BODY --}}
                <div class="modal-body px-4 pb-5 pt-2 text-center">

                    {{-- ICON --}}
                    <div class="mb-4">
                        <div class="avatar-xl mx-auto">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <lord-icon
                                    src="https://cdn.lordicon.com/fjvfsqea.json"
                                    trigger="loop"
                                    colors="primary:#405189,secondary:#0ab39c"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                        </div>
                    </div>

                    {{-- TITLE --}}
                    <div class="mb-2">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                            Konfirmasi Export
                        </span>

                        <h3 class="fw-bold mb-2" id="exportRecordLabel">
                            Export Administrasi Siswa?
                        </h3>

                        <p class="text-muted mb-0 lh-lg px-lg-4">
                            Data yang diekspor akan mengikuti filter dan tabel yang
                            sedang ditampilkan, sehingga hasil export sesuai dengan
                            data yang Anda lihat saat ini.
                        </p>
                    </div>

                    {{-- INFORMATION --}}
                    <div class="alert alert-light border rounded-4 text-start mt-4 mb-0">
                        <div class="d-flex align-items-start gap-3">
                            <div class="flex-shrink-0">
                                <i class="ri-information-line text-primary fs-20"></i>
                            </div>

                            <div>
                                <h6 class="fw-semibold mb-1">
                                    Informasi
                                </h6>
                                <p class="text-muted mb-0 fs-13">
                                    Pastikan filter jenjang, tahun ajar, kelas, maupun
                                    pencarian sudah sesuai sebelum melakukan export.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Batal
                    </button>

                    <button type="button"
                        class="btn btn-primary rounded-pill px-4"
                        id="ExportIndexSiswa"
                        data-bs-dismiss="modal">
                        <i class="ri-download-2-line me-1"></i>
                        Ya, Export
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- SCRIPT EXPORT --}}
    <script>
        document.getElementById('ExportIndexSiswa').addEventListener('click', function () {
            alertify.success("Menyiapkan Dokumen");

            setTimeout(function () {
                var table = document.getElementById("DataIndexSiswa");

                var data = [];
                // Kolom yang ingin diexport
                var exportCols = [1,3,4,5,6];

                // Ambil header
                var headers = [];
                for(var i=0; i<exportCols.length; i++){
                    headers.push(table.tHead.rows[0].cells[exportCols[i]].innerText.trim());
                }
                data.push(headers);

                // Ambil data tbody
                for(var i=0; i<table.tBodies[0].rows.length; i++){
                    var row = table.tBodies[0].rows[i];
                    var rowData = [];
                    for(var j=0; j<exportCols.length; j++){
                        rowData.push(row.cells[exportCols[j]].innerText.trim());
                    }
                    data.push(rowData);
                }

                // Ambil data tfoot (jika ada)
                if(table.tFoot){
                    for(var i=0; i<table.tFoot.rows.length; i++){
                        var row = table.tFoot.rows[i];
                        var rowData = [];
                        for(var j=0; j<exportCols.length; j++){
                            rowData.push(row.cells[exportCols[j]].innerText.trim());
                        }
                        data.push(rowData);
                    }
                }

                // Buat workbook
                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.aoa_to_sheet(data);
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

                XLSX.writeFile(wb, "Laporan-Administrasi-Siswa.xlsx");

            }, 1000);
        });
    </script>

</div>
