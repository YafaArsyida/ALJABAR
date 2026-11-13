
<div wire:ignore.self class="modal fade" id="ModalImportTelepon" tabindex="-1"
    aria-labelledby="ModalImportTeleponLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-smartphone-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="ModalImportTeleponLabel">
                            Import Telepon Siswa {{ $namaKelas }}
                        </h5>
                        <small class="text-muted">
                            Unggah dan tinjau nomor telepon sebelum diperbarui.
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
            <div class="modal-body px-4 pt-2 pb-4">

                {{-- INFORMASI IMPORT --}}
                <div class="text-center mb-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/fjvfsqea.json"
                        trigger="loop"
                        colors="primary:#405189,secondary:#f06548"
                        style="width:80px;height:80px">
                    </lord-icon>

                    <h5 class="fw-bold mt-2 mb-2">
                        Import Nomor Telepon Siswa
                    </h5>
                    <p class="text-muted mb-0">
                        Unduh template sesuai kelas, isi kolom <strong>telepon</strong>,
                        kemudian unggah kembali file untuk melihat pratinjau perubahan
                        sebelum disimpan.
                    </p>
                </div>

                <div class="row g-3">

                    {{-- PETUNJUK --}}
                    <div class="col-lg-5">
                        <div class="border rounded-4 h-100 overflow-hidden">
                            <div class="px-3 py-3 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                            <i class="ri-list-check-2"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Langkah Pembaruan</h6>
                                        <small class="text-muted">
                                            Ikuti langkah berikut sebelum mengunggah data.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <div class="d-flex flex-column gap-3">

                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">1</span>
                                        <div class="small">
                                            Download template data siswa kelas
                                            <strong>{{ $namaKelas }}</strong>.
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">2</span>
                                        <div class="small">
                                            Isi atau perbarui kolom <strong>telepon</strong>.
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">3</span>
                                        <div class="small">
                                            Jangan mengubah <strong>ID Siswa</strong>
                                            maupun <strong>Nama Siswa</strong>.
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">4</span>
                                        <div class="small">
                                            Upload kembali file Excel yang telah diperbarui.
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">5</span>
                                        <div class="small">
                                            Periksa pratinjau perubahan sebelum menekan tombol
                                            <strong>Simpan</strong>.
                                        </div>
                                    </div>

                                </div>

                                <hr class="my-3">

                                <div class="d-grid">
                                    <button type="button"
                                        class="btn btn-success rounded-pill"
                                        wire:click="exportTeleponSiswa">
                                        <i class="ri-file-excel-2-line me-1"></i>
                                        Download Template
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- UPLOAD --}}
                    <div class="col-lg-7">
                        <div class="border rounded-4 h-100 overflow-hidden">
                            <div class="px-3 py-3 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                            <i class="ri-upload-cloud-2-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Upload Dokumen Pembaruan</h6>
                                        <small class="text-muted">
                                            Pilih file Excel berisi nomor telepon terbaru.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <div>
                                    <label class="form-label">
                                        File Excel
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="file"
                                        wire:model="file_import"
                                        class="form-control @error('file_import') is-invalid @enderror">

                                    @error('file_import')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="form-text">
                                        Format yang didukung:
                                        <strong>.xlsx</strong> dan
                                        <strong>.xls</strong>
                                    </div>

                                    <div wire:loading wire:target="file_import"
                                        class="mt-3 text-primary small">
                                        <span class="spinner-border spinner-border-sm me-1"></span>
                                        Membaca file Excel...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- PREVIEW PERUBAHAN --}}
                @if(count($previewSiswaList))
                    <div class="border rounded-4 mt-4 overflow-hidden">

                        <div class="px-3 py-3 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                        <i class="ri-file-list-3-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        Preview Perubahan Nomor Telepon
                                    </h6>
                                    <small class="text-muted">
                                        Periksa perubahan nomor sebelum diterapkan.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Nomor Lama</th>
                                        <th>Nomor Baru</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($previewSiswaList as $siswa)
                                        <tr>
                                            <td>{{ $siswa['ms_siswa_id'] }}</td>
                                            <td class="fw-medium">{{ $siswa['nama_siswa'] }}</td>
                                            <td>{{ $siswa['kelas'] }}</td>
                                            <td>{{ $siswa['telepon_lama'] ?: '-' }}</td>
                                            <td>{{ $siswa['telepon_baru'] }}</td>
                                            <td>
                                                @switch($siswa['status'])
                                                    @case('tambah')
                                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                                            Nomor Baru
                                                        </span>
                                                        @break

                                                    @case('update')
                                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                                                            Akan Diperbarui
                                                        </span>
                                                        @break

                                                    @default
                                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                                                            Tidak Berubah
                                                        </span>
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endif

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>

                <button type="button"
                    wire:click="saveChanges"
                    class="btn btn-primary rounded-pill px-4"
                    wire:loading.attr="disabled"
                    wire:target="saveChanges">
                    <span wire:loading.remove wire:target="saveChanges">
                        <i class="ri-save-3-line me-1"></i>
                        Simpan Perubahan
                    </span>
                    <span wire:loading wire:target="saveChanges">
                        <span class="spinner-border spinner-border-sm me-1"></span>
                        Menyimpan...
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>
