
<div wire:ignore.self class="modal fade" id="ModalAddKelas" tabindex="-1"
    aria-labelledby="ModalAddKelasLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable">
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
                        <h5 class="fw-bold mb-1" id="ModalAddKelasLabel">
                            Kelas Baru
                        </h5>
                        <small class="text-muted">
                            Tambahkan kelas untuk pengelompokan siswa berdasarkan jenjang dan tahun ajaran.
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

            <form id="formAddKelas" class="d-flex flex-column overflow-hidden"
                wire:submit.prevent="save">

                {{-- BODY --}}
                <div class="modal-body">

                    <div class="d-flex justify-content-end mb-3">
                        <small class="text-muted">
                            <span class="text-danger">*</span>
                            Wajib diisi
                        </small>
                    </div>

                    {{-- IDENTITAS KELAS --}}
                    <section class="mb-4">

                        {{-- NAMA KELAS --}}
                        <div class="mb-3">
                            <label for="create_nama_kelas" class="form-label">
                                Nama Kelas
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                wire:model.defer="nama_kelas"
                                id="create_nama_kelas"
                                class="form-control @error('nama_kelas') is-invalid @enderror"
                                placeholder="Contoh: 7 A atau VII D"
                                autocomplete="off">

                            @error('nama_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- URUTAN --}}
                        <div>
                            <label for="create_urutan" class="form-label">
                                Urutan
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model.defer="urutan"
                                id="create_urutan"
                                class="form-control @error('urutan') is-invalid @enderror"
                                placeholder="Contoh: 1, 2, 3">

                            @error('urutan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted">
                                Menentukan posisi kelas dalam daftar.
                            </small>
                        </div>

                    </section>

                    {{-- INFORMASI KELAS --}}
                    <section class="mb-4">

                        {{-- DESKRIPSI --}}
                        <div>
                            <label for="create_deskripsi" class="form-label">
                                Deskripsi
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <textarea id="create_deskripsi"
                                wire:model.defer="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3"
                                placeholder="Masukkan deskripsi atau keterangan tambahan kelas"></textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </section>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="save">

                        <span wire:loading.remove wire:target="save">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Kelas
                        </span>

                        <span wire:loading wire:target="save">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
