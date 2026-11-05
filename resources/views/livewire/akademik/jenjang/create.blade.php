<div wire:ignore.self class="modal fade" id="ModalAddJenjang" tabindex="-1" aria-labelledby="ModalAddJenjang" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-graduation-cap-line"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">
                            Jenjang Baru
                        </h5>

                        <small class="text-muted">Tambahkan jenjang pendidikan untuk pengelompokan kelas.</small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal" aria-label="Close" id="close-modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>
            <form id="formAddJenjang" wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="create_nama_jenjang" class="form-label">Nama Jenjang</label>
                            <input type="text" wire:model="nama_jenjang" id="create_nama_jenjang" class="form-control" placeholder="SD/SMP/SMA" />
                            @error('nama_jenjang') 
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="create_urutan" class="form-label">Urutan</label>
                            <input type="number" wire:model="urutan" id="create_urutan" class="form-control" placeholder="1, 2, 3, ..." />
                            @error('urutan') 
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="create_alamat" class="form-label">Alamat</label>
                            <textarea id="create_alamat" wire:model="alamat" class="form-control" rows="2" placeholder="Alamat jenjang"></textarea>
                            @error('alamat')
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="create_slug" class="form-label">Slug</label>
                            <input type="text" id="create_slug" wire:model="slug" class="form-control" placeholder="slug-jenjang">
                            <small class="text-muted">Slug dibuat otomatis dari nama dan dapat disunting.</small>
                            @error('slug')
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" wire:model="deskripsi" class="form-control" rows="3" placeholder="Deskripsi jenjang"></textarea>
                            @error('deskripsi') 
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Tutup
                    </button>
                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="save"
                    >
                        <span wire:loading.remove wire:target="save">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan
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