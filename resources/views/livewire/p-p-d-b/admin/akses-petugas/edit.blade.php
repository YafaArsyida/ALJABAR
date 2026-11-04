<div>
    <div wire:ignore.self class="modal fade" id="ModalEditPetugasSPMB" tabindex="-1" aria-labelledby="ModalEditPetugasSPMBLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 px-4 pt-4 pb-2">
                    <div>
                        <h5 class="modal-title fw-bold" id="ModalEditPetugasSPMBLabel">Edit Petugas SPMB</h5>
                        <small class="text-muted">Perbarui akun dan akses jenjang petugas.</small>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <form wire:submit.prevent="update">
                    <div class="modal-body px-4 pt-2 pb-4">
                        <div class="mb-3">
                            <label for="petugas-edit-nama" class="form-label">Nama Petugas</label>
                            <input type="text" id="petugas-edit-nama" class="form-control @error('nama') is-invalid @enderror" wire:model.defer="nama">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="petugas-edit-email" class="form-label">Email / Username</label>
                            <input type="text" id="petugas-edit-email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="email" placeholder="Email atau username">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="petugas-edit-password" class="form-label">Password Baru (opsional)</label>
                            <input type="password" id="petugas-edit-password" class="form-control @error('password') is-invalid @enderror" wire:model.defer="password" autocomplete="new-password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Akses Jenjang</label>
                            @foreach ($daftarJenjang as $jenjang)
                                <label class="form-check border rounded-3 p-3 ps-5 mb-2" for="petugas-edit-jenjang-{{ $jenjang->ms_jenjang_id }}">
                                    <input class="form-check-input" type="checkbox" id="petugas-edit-jenjang-{{ $jenjang->ms_jenjang_id }}" value="{{ $jenjang->ms_jenjang_id }}" wire:model="jenjangIds">
                                    <span class="form-check-label">{{ $jenjang->nama_jenjang }}</span>
                                </label>
                            @endforeach
                            @error('jenjangIds') <div class="text-danger fs-12">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled" wire:target="update">
                            <span wire:loading.remove wire:target="update"><i class="ri-save-line me-1"></i>Simpan Perubahan</span>
                            <span wire:loading wire:target="update"><span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
