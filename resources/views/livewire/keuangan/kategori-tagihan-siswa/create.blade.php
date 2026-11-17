{{-- Success is as dangerous as failure. --}}
<div wire:ignore.self class="modal fade" id="ModalAddKategoriTagihan" tabindex="-1" aria-labelledby="ModalAddKategoriTagihan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-price-tag-3-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalAddGelombangLabel">
                            Kategori Tagihan Siswa
                        </h5>
                        <small class="text-muted">
                            Tambahkan kategori untuk mengelompokkan jenis tagihan.
                        </small>
                    </div>
                </div>

                <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal">
                    <i class="ri-close-line fs-18">
                    </i>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-8">
                            <label for="nama_kategori_tagihan_siswa" class="form-label">Nama Kategori Tagihan</label>
                            <input type="text" wire:model.defer="nama_kategori_tagihan_siswa" id="nama_kategori_tagihan_siswa"  class="form-control @error('nama_kategori_tagihan_siswa') is-invalid @enderror" placeholder="SPP/ UANG MAKAN/ TRANSPORT ......." />
                            @error('nama_kategori_tagihan_siswa') 
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="urutan" class="form-label">Urutan</label>
                            <input type="number" wire:model.defer="urutan" class="form-control @error('urutan') is-invalid @enderror" placeholder="1, 2, 3, ..." />
                            @error('urutan') 
                                <footer class="text-danger mt-0">{{ $message }}</footer>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" wire:model.defer="deskripsi" class="form-control" placeholder="Kategori laporan khusus SPP..." />
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
                    <button type="submit" class="btn btn-primary rounded-pill px-4" wire:target="save" wire:loading.attr="disabled">
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