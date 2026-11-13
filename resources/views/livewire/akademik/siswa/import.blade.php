
<div wire:ignore.self class="modal fade" id="ModalImportSiswa" tabindex="-1"
    aria-labelledby="ModalImportSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-user-add-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" id="ModalImportSiswaLabel">
                            Import Data Siswa
                        </h5>
                        <small class="text-muted">
                            Unggah data siswa dan tinjau hasilnya sebelum disimpan.
                        </small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            <form class="d-flex flex-column overflow-hidden"
                wire:submit.prevent="createPenempatan">

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
                            Import Data Siswa
                        </h5>
                        <p class="text-muted mb-0">
                            Download template, lengkapi data siswa sesuai format,
                            pilih kelas penempatan, kemudian upload file untuk melihat
                            pratinjau sebelum disimpan.
                        </p>
                    </div>

                    <div class="row g-3">

                        {{-- PETUNJUK IMPORT --}}
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
                                                Ikuti langkah berikut untuk mengimpor data.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3">
                                    <div class="d-flex flex-column gap-3">

                                        <div class="d-flex align-items-start gap-3">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">1</span>
                                            <div class="small">
                                                Download template data siswa.
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">2</span>
                                            <div class="small">
                                                Lengkapi seluruh data siswa sesuai format template.
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">3</span>
                                            <div class="small">
                                                Pilih kelas tujuan untuk penempatan siswa.
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">4</span>
                                            <div class="small">
                                                Upload kembali file Excel.
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-3">
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">5</span>
                                            <div class="small">
                                                Periksa data siswa sebelum menekan tombol
                                                <strong>Simpan</strong>.
                                            </div>
                                        </div>

                                    </div>

                                    <hr class="my-3">

                                    <div class="d-grid">
                                        <a href="{{ url('storage/templates/template_import_siswa.xlsx') }}"
                                            download
                                            class="btn btn-success rounded-pill">
                                            <i class="ri-file-excel-2-line me-1"></i>
                                            Download Template
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- UPLOAD DOKUMEN --}}
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
                                            <h6 class="fw-bold mb-1">Upload Dokumen</h6>
                                            <small class="text-muted">
                                                Pilih kelas tujuan dan file Excel siswa.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3">

                                    {{-- PENEMPATAN KELAS --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Penempatan Kelas
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select wire:model="ms_kelas_id"
                                            class="form-select @error('ms_kelas_id') is-invalid @enderror">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($select_kelas as $item)
                                                <option value="{{ $item->ms_kelas_id }}">
                                                    {{ $item->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('ms_kelas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- FILE EXCEL --}}
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

                    {{-- PREVIEW DATA SISWA --}}
                    @if(!empty($newSiswaList))
                        <div class="border rounded-4 mt-4 overflow-hidden">

                            <div class="px-3 py-3 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                            <i class="ri-file-list-3-line"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Preview Data Siswa</h6>
                                        <small class="text-muted">
                                            Periksa data siswa sebelum disimpan ke dalam sistem.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="70">No</th>
                                            <th>Nama Siswa</th>
                                            <th>Telepon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($newSiswaList as $index => $siswa)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td class="fw-medium">
                                                    {{ $siswa['nama_siswa'] }}
                                                </td>
                                                <td>
                                                    {{ $siswa['telepon'] ?: '-' }}
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

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="createPenempatan">
                        <span wire:loading.remove wire:target="createPenempatan">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Penempatan
                        </span>
                        <span wire:loading wire:target="createPenempatan">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
