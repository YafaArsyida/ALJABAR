<div wire:ignore.self class="modal fade" id="ModalJabatanCreate" tabindex="-1" aria-labelledby="ModalJabatanCreate"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
            <div class="modal-header border-bottom">
                <div>
                    <h5 class="fw-bold mb-1">
                        Jabatan Baru
                    </h5>
                    <small class="text-muted">
                        Lengkapi informasi berikut untuk menambahkan data baru.
                    </small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form id="formAddJenjang" wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nama_jabatan" class="form-label fw-semibold">
                                Nama Jabatan <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model.defer="nama_jabatan" id="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="Contoh: Kepala Sekolah" />
                        
                            @error('nama_jabatan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="deskripsi" class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea wire:model.defer="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3" placeholder="Contoh: Bertanggung jawab atas operasional sekolah"></textarea>
                        
                            @error('deskripsi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success shadow-none fw-medium"
                        data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Tutup</a>
                    <button type="submit" class="btn btn-primary" wire:target="save" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">
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