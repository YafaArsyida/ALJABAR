<div wire:ignore.self class="modal fade" id="ModalEditJenjang" tabindex="-1" aria-labelledby="ModalEditJenjangLabel" aria-hidden="true">
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
                            Perbarui Jenjang
                        </h5>

                        <small class="text-muted">Perbarui informasi jenjang pendidikan.</small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal" aria-label="Close" id="close-modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>
            <form wire:submit.prevent="updateJenjang">
                <div class="modal-body">
                    <div wire:loading.delay wire:target="loadDataJenjang" class="text-center py-5">
                        <div class="spinner-border text-primary mb-3"></div>
                        <p class="text-muted mb-0">Memuat informasi jenjang...</p>
                    </div>
                    <div wire:loading.remove wire:target="loadDataJenjang" class="row g-3">
                        <div class="col-lg-6">
                            <label for="edit_nama_jenjang" class="form-label">Nama Jenjang</label>
                            <input type="text" id="edit_nama_jenjang" wire:model="nama_jenjang" class="form-control">
                            @error('nama_jenjang') 
                                <footer class="text-danger mt-0">{{ $message }}</footer> 
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="edit_urutan" class="form-label">Urutan</label>
                            <input type="number" id="edit_urutan" wire:model="urutan" class="form-control">
                            @error('urutan') 
                                <footer class="text-danger mt-0">{{ $message }}</footer> 
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <textarea id="edit_alamat" wire:model="alamat" class="form-control" rows="2"></textarea>
                            @error('alamat')
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="edit_slug" class="form-label">Slug</label>
                            <input type="text" id="edit_slug" wire:model="slug" class="form-control">
                            <small class="text-muted">Slug diperbarui otomatis saat nama berubah, kecuali Anda menyunting slug ini.</small>
                            @error('slug')
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="edit_deskripsi" wire:model="deskripsi" class="form-control" rows="3"></textarea>
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
                        wire:target="updateJenjang,loadDataJenjang"
                    >
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