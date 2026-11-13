
<div wire:ignore.self class="modal fade" id="ModalAddJenjang" tabindex="-1"
    aria-labelledby="ModalAddJenjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-graduation-cap-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalAddJenjangLabel">
                            Jenjang Baru
                        </h5>
                        <small class="text-muted">
                            Tambahkan jenjang pendidikan untuk pengelompokan kelas.
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

            <form id="formAddJenjang" class="d-flex flex-column overflow-hidden"
                wire:submit.prevent="save">

                {{-- BODY --}}
                <div class="modal-body px-4 pt-2 pb-4">

                    <div class="d-flex justify-content-end mb-3">
                        <small class="text-muted">
                            <span class="text-danger">*</span>
                            Wajib diisi
                        </small>
                    </div>

                    {{-- IDENTITAS JENJANG --}}
                    <section class="mb-4">
                        {{-- NAMA JENJANG --}}
                        <div class="mb-3">
                            <label for="create_nama_jenjang" class="form-label">
                                Nama Jenjang
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                wire:model="nama_jenjang"
                                id="create_nama_jenjang"
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
                        <div>
                            <label for="create_urutan" class="form-label">
                                Urutan
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model="urutan"
                                id="create_urutan"
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
                    </section>

                    {{-- INFORMASI JENJANG --}}
                    <section class="mb-4">
                        {{-- ALAMAT --}}
                        <div class="mb-3">
                            <label for="create_alamat" class="form-label">
                                Alamat
                            </label>

                            <textarea id="create_alamat"
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
                            <label for="create_slug" class="form-label">
                                Slug
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                id="create_slug"
                                wire:model="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                placeholder="Contoh: sd-islam-al-hidayah"
                                autocomplete="off">

                            <small class="text-muted">
                                Slug dibuat otomatis dari nama dan dapat disunting.
                            </small>

                            @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div>
                            <label for="deskripsi" class="form-label">
                                Deskripsi
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <textarea id="deskripsi"
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
                    </section>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
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
                            Simpan Jenjang
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
