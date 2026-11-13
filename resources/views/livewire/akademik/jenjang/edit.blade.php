
<div wire:ignore.self class="modal fade" id="ModalEditJenjang" tabindex="-1"
    aria-labelledby="ModalEditJenjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-graduation-cap-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalEditJenjangLabel">
                            Perbarui Jenjang
                        </h5>
                        <small class="text-muted">
                            Perbarui informasi jenjang pendidikan.
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

            <form class="d-flex flex-column overflow-hidden"
                wire:submit.prevent="updateJenjang">

                {{-- BODY --}}
                <div class="modal-body">

                    {{-- LOADING DATA --}}
                    <div wire:loading.delay wire:target="loadDataJenjang"
                        class="text-center py-5">
                        <div class="spinner-border text-primary mb-3"></div>
                        <p class="text-muted mb-0">
                            Memuat informasi jenjang...
                        </p>
                    </div>

                    <div wire:loading.remove wire:target="loadDataJenjang">

                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted">
                                <span class="text-danger">*</span>
                                Wajib diisi
                            </small>
                        </div>

                        {{-- NAMA JENJANG --}}
                        <div class="mb-3">
                            <label for="edit_nama_jenjang" class="form-label">
                                Nama Jenjang
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                id="edit_nama_jenjang"
                                wire:model="nama_jenjang"
                                class="form-control @error('nama_jenjang') is-invalid @enderror"
                                placeholder="Contoh: SD, SMP, SMA"
                                autocomplete="off">

                            @error('nama_jenjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- URUTAN --}}
                        <div class="mb-3">
                            <label for="edit_urutan" class="form-label">
                                Urutan
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                id="edit_urutan"
                                wire:model="urutan"
                                class="form-control @error('urutan') is-invalid @enderror"
                                placeholder="Contoh: 1, 2, 3">

                            @error('urutan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted">
                                Menentukan posisi jenjang dalam daftar.
                            </small>
                        </div>

                        {{-- ALAMAT --}}
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">
                                Alamat
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <textarea id="edit_alamat"
                                wire:model="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                rows="2"
                                placeholder="Masukkan alamat jenjang"></textarea>

                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- SLUG --}}
                        <div class="mb-3">
                            <label for="edit_slug" class="form-label">
                                Slug
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                id="edit_slug"
                                wire:model="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                placeholder="Contoh: sd-islam-al-hidayah"
                                autocomplete="off">

                            <small class="text-muted">
                                Slug diperbarui otomatis saat nama berubah,
                                kecuali Anda menyunting slug ini.
                            </small>

                            @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div>
                            <label for="edit_deskripsi" class="form-label">
                                Deskripsi
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <textarea id="edit_deskripsi"
                                wire:model="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3"
                                placeholder="Masukkan deskripsi jenjang pendidikan"></textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="updateJenjang,loadDataJenjang">

                        <span wire:loading.remove wire:target="updateJenjang">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Perubahan
                        </span>

                        <span wire:loading wire:target="updateJenjang">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
