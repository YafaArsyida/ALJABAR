<div wire:ignore.self class="modal fade" id="ModalEditKantin" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-store-2-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="modal-title fw-bold mb-1">
                            Perbarui Kantin
                        </h5>

                        <small class="text-muted">
                            Perbarui data kantin.
                        </small>
                    </div>
                </div>

                <button type="button" class="btn-close" 
                    data-bs-dismiss="modal"aria-label="Close">
                </button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body p-3">
                    <div class="row g-3">

                        <div class="col-lg-12">
                            <label class="form-label">Nama Kantin</label>
                            <input type="text" wire:model.defer="nama_kantin"
                                class="form-control @error('nama_kantin') is-invalid @enderror">

                            @error('nama_kantin')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea wire:model.defer="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"></textarea>

                            @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4" wire:target="update" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="update">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Perubahan
                        </span>
                        <span wire:loading wire:target="update">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>