
<div wire:ignore.self class="modal fade" id="ModalImportEduCard" tabindex="-1"
    aria-labelledby="ModalImportEduCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-bank-card-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="ModalImportEduCardLabel">
                            Import EduCard Siswa {{ $namaKelas }}
                        </h5>
                        <small class="text-muted">
                            Unggah dan periksa data kartu sebelum diperbarui.
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

                {{-- INFORMASI IMPORT --}}
                <div class="text-center mb-4">
                    <lord-icon
                        src="https://cdn.lordicon.com/fjvfsqea.json"
                        trigger="loop"
                        colors="primary:#405189,secondary:#f06548"
                        style="width:80px;height:80px">
                    </lord-icon>

                    <h5 class="fw-bold mt-2 mb-2">
                        Import EduCard Siswa
                    </h5>
                    <p class="text-muted mb-0">
                        Unduh template sesuai kelas, isi kolom <strong>educard</strong>,
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
                                        <h6 class="fw-bold mb-1">Petunjuk Import</h6>
                                        <small class="text-muted">
                                            Ikuti langkah berikut agar data kartu terbaca dengan benar.
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
                                            Isi atau perbarui kolom <strong>educard</strong>
                                            dengan nomor kartu yang akan digunakan.
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
                                            Kosongkan kolom <strong>educard</strong>
                                            apabila kartu ingin dihapus.
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill">5</span>
                                        <div class="small">
                                            Upload kembali file Excel dan periksa pratinjau
                                            perubahan sebelum menekan tombol <strong>Simpan</strong>.
                                        </div>
                                    </div>

                                </div>

                                <hr class="my-3">

                                <div class="d-grid">
                                    <button type="button"
                                        class="btn btn-success rounded-pill"
                                        wire:click="exportEduCardSiswa">
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
                                            Pilih file Excel berisi data EduCard terbaru.
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
                                        Preview Perubahan EduCard
                                    </h6>
                                    <small class="text-muted">
                                        Periksa perubahan sebelum diterapkan.
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
                                        <th>EduCard Lama</th>
                                        <th>EduCard Baru</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($previewSiswaList as $siswa)
                                        <tr>
                                            <td>{{ $siswa['ms_siswa_id'] }}</td>
                                            <td class="fw-medium">{{ $siswa['nama_siswa'] }}</td>
                                            <td>{{ $siswa['kelas'] }}</td>

                                            <td>
                                                @if($siswa['educard_lama'])
                                                    <span class="fw-semibold">
                                                        {{ $siswa['educard_lama'] }}
                                                    </span>
                                                @else
                                                    <em class="text-muted">Belum memiliki kartu</em>
                                                @endif
                                            </td>

                                            <td>
                                                @if($siswa['educard_baru'])
                                                    <span class="fw-semibold">
                                                        {{ $siswa['educard_baru'] }}
                                                    </span>
                                                @else
                                                    <em class="text-muted">Kartu akan dihapus</em>
                                                @endif
                                            </td>

                                            <td>
                                                @switch($siswa['status'])
                                                    @case('tambah')
                                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                                            Kartu Baru
                                                        </span>
                                                        @break

                                                    @case('update')
                                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">
                                                            Akan Diperbarui
                                                        </span>
                                                        @break

                                                    @case('hapus')
                                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">
                                                            Akan Dihapus
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
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>

                <button type="button"
                    class="btn btn-primary rounded-pill px-4"
                    wire:click="saveChanges"
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
