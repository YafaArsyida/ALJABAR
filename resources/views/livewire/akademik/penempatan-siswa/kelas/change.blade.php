
<div wire:ignore.self class="modal fade" id="ModalChangeKelas" tabindex="-1"
    aria-labelledby="ModalChangeKelasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-arrow-left-right-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="ModalChangeKelasLabel">
                            Pindahkan Siswa
                        </h5>
                        <small class="text-muted">
                            Pilih siswa dan kelas tujuan pemindahan.
                        </small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                {{-- FILTER DATA --}}
                <div class="row g-3 mb-3">

                    {{-- PENCARIAN SISWA --}}
                    <div class="col-lg-8 col-sm-6">
                        <label for="searchSiswa"
                            class="form-label small text-muted text-uppercase fw-medium mb-2">
                            Pencarian Siswa
                        </label>

                        <div class="search-box">
                            <input type="text"
                                id="searchSiswa"
                                class="form-control search"
                                wire:model.debounce.300ms="searchSiswa"
                                placeholder="Cari nama siswa...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>

                    {{-- KELAS TUJUAN --}}
                    <div class="col-lg-4 col-sm-6">
                        <label for="kelasTujuan"
                            class="form-label small text-muted text-uppercase fw-medium mb-2">
                            Kelas Tujuan
                        </label>

                        <select id="kelasTujuan"
                            wire:model="kelasTujuan"
                            class="form-select"
                            style="cursor: pointer"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Pilih Kelas Tujuan">
                            <option value="">Pilih Kelas Tujuan</option>
                            @foreach ($select_kelas as $kelas)
                                <option value="{{ $kelas->ms_kelas_id }}">
                                    {{ $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- DAFTAR SISWA --}}
                <div class="live-preview">

                    {{-- JENJANG DAN TAHUN AJAR BELUM DIPILIH --}}
                    @if (!$selectedJenjang || !$selectedTahunAjar)
                        <div class="text-center py-5 px-3">
                            <lord-icon
                                src="https://cdn.lordicon.com/msoeawqm.json"
                                trigger="loop"
                                colors="primary:#405189,secondary:#08a88a"
                                style="width:75px;height:75px">
                            </lord-icon>

                            <h5 class="fw-bold mt-2 mb-2">
                                Silakan Pilih Jenjang dan Tahun Ajar
                            </h5>
                            <p class="text-muted mb-0">
                                Untuk melihat data kelas, harap pilih Jenjang
                                dan Tahun Ajar terlebih dahulu.
                            </p>
                        </div>
                    @else

                        {{-- TABEL SISWA --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 60px;">
                                            <div class="form-check d-flex justify-content-center mb-0">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    id="checkAll"
                                                    wire:model="selectAll">
                                            </div>
                                        </th>
                                        <th scope="col">Siswa</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Jenjang</th>
                                        <th scope="col">Tahun Ajar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($siswas as $item)
                                        <tr>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center mb-0">
                                                    <input class="form-check-input"
                                                        type="checkbox"
                                                        wire:key="{{ $item->ms_penempatan_siswa_id }}"
                                                        wire:model="siswaSelected"
                                                        value="{{ $item->ms_penempatan_siswa_id }}">
                                                </div>
                                            </td>
                                            <td class="fw-medium">
                                                {{ $item->ms_siswa->nama_siswa }}
                                            </td>
                                            <td>
                                                {{ $item->ms_kelas->nama_kelas }}
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
                                                <div class="text-center py-5 px-3">
                                                    <lord-icon
                                                        src="https://cdn.lordicon.com/msoeawqm.json"
                                                        trigger="loop"
                                                        colors="primary:#405189,secondary:#08a88a"
                                                        style="width:75px;height:75px">
                                                    </lord-icon>

                                                    <h5 class="fw-bold mt-2 mb-2">
                                                        Maaf, Tidak Ada Data yang Ditemukan
                                                    </h5>
                                                    <p class="text-muted mb-0">
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

                <button type="button"
                    class="btn btn-primary rounded-pill px-4"
                    wire:click="pindahkanSiswa"
                    wire:loading.attr="disabled"
                    wire:target="pindahkanSiswa"
                    {{ count($siswaSelected) === 0 ? 'disabled' : '' }}>
                    <span wire:loading.remove wire:target="pindahkanSiswa">
                        <i class="ri-arrow-left-right-line me-1"></i>
                        Pindahkan ({{ count($siswaSelected) }})
                    </span>
                    <span wire:loading wire:target="pindahkanSiswa">
                        <span class="spinner-border spinner-border-sm me-1"></span>
                        Memindahkan...
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>
