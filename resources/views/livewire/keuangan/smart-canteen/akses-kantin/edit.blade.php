<div wire:ignore.self class="modal fade" id="editPengguna">
       <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-user-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="modal-title fw-bold mb-1">
                            Perbarui Petugas Kantin
                        </h5>

                        <small class="text-muted">
                            Perbarui petugas untuk mengelola operasional kantin.
                        </small>
                    </div>
                </div>

                <button
                    type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body p-3">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label class="form-label">Pilih Kantin</label>
                            <select wire:model="ms_kantin_id" class="form-select">
                                <option value="">-- Pilih Kantin --</option>
                                @foreach($kantinList as $kantin)
                                <option value="{{ $kantin->ms_kantin_id }}">
                                    {{ $kantin->nama_kantin }}
                                </option>
                                @endforeach
                            </select>
                            @error('ms_kantin_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-lg-12">
                            <label class="form-label">Nama</label>
                            <input type="text" wire:model.defer="nama" class="form-control">
                            @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Telepon</label>
                            <input type="text" wire:model.defer="telepon" class="form-control">
                            @error('telepon') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Email</label>
                            <input type="text" wire:model.defer="email" class="form-control">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
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