
<div wire:ignore.self class="modal fade" id="ModalDetailKelas" tabindex="-1"
    aria-labelledby="ModalDetailKelasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-building-4-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalDetailKelasLabel">
                            Daftar Siswa
                        </h5>
                        <small class="text-muted">
                            Kelas {{ $namaKelasCurrent ?? 'Kelas' }}
                        </small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal"
                    aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                {{-- PENCARIAN --}}
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="searchSiswaDetail"
                            class="form-label small text-muted text-uppercase fw-medium mb-2">
                            Pencarian Siswa
                        </label>

                        <div class="search-box">
                            <input type="text"
                                id="searchSiswaDetail"
                                class="form-control search"
                                wire:model.debounce.300ms="searchSiswaDetail"
                                placeholder="Cari nama siswa...">

                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                </div>

                {{-- TABEL DATA SISWA --}}
                <div class="live-preview">

                    @if (!$selectedKelasDetail)

                        {{-- BELUM MEMILIH KELAS --}}
                        <div class="text-center py-4">
                            <lord-icon
                                src="https://cdn.lordicon.com/msoeawqm.json"
                                trigger="loop"
                                colors="primary:#405189,secondary:#08a88a"
                                style="width:75px;height:75px">
                            </lord-icon>

                            <h5 class="mt-2 fw-semibold">
                                Silakan Pilih Kelas
                            </h5>
                            <p class="text-muted small mb-0">
                                Untuk melihat data siswa, harap pilih kelas terlebih dahulu.
                            </p>
                        </div>

                    @else

                        <div class="table-responsive">
                            <table class="table table-hover nowrap align-middle"
                                style="width:100%">

                                <thead class="table-light">
                                    <tr>
                                        <th class="text-uppercase" width="30px">No.</th>
                                        <th class="text-uppercase">Siswa</th>
                                        <th class="text-uppercase">Kelas</th>
                                        <th class="text-uppercase">Jenjang</th>
                                        <th class="text-uppercase">Tahun Ajar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($siswaDetailList as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <span class="fw-medium">
                                                    {{ $item->ms_siswa->nama_siswa }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $item->ms_kelas->nama_kelas ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $item->ms_jenjang->nama_jenjang ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{ $item->ms_tahun_ajar->nama_tahun_ajar ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <div class="text-center py-4">
                                                    <lord-icon
                                                        src="https://cdn.lordicon.com/msoeawqm.json"
                                                        trigger="loop"
                                                        colors="primary:#405189,secondary:#08a88a"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>

                                                    <h6 class="mt-2 fw-semibold">
                                                        Tidak Ada Data
                                                    </h6>
                                                    <p class="text-muted small mb-0">
                                                        Belum ada siswa dalam kelas ini.
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                    @endif

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
