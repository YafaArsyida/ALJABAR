<div>
    <div wire:ignore.self class="modal fade" id="ModalAddMataPelajaran" tabindex="-1"
        aria-labelledby="ModalAddMataPelajaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
                <div class="modal-header border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="mdi mdi-book-plus-outline"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1" id="ModalAddMataPelajaranLabel">Mata Pelajaran Baru</h5>
                            <small class="text-muted">Tambahkan mata pelajaran pada jenjang yang dipilih.</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <form class="d-flex flex-column overflow-hidden" wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted"><span class="text-danger">*</span> Wajib diisi</small>
                        </div>

                        <div class="alert alert-primary bg-primary-subtle border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-start gap-2">
                                <i class="ri-government-line fs-18 mt-1"></i>
                                <div>
                                    <div class="fw-semibold">{{ $jenjang->nama_jenjang ?? 'Jenjang belum dipilih' }}</div>
                                    <div class="small">Daftar mata pelajaran dikelola per jenjang.</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="create_nama_mapel" class="form-label">
                                Nama Mata Pelajaran <span class="text-danger">*</span>
                            </label>
                            <input id="create_nama_mapel" type="text"
                                class="form-control @error('nama_mapel') is-invalid @enderror"
                                wire:model.defer="nama_mapel" maxlength="100"
                                placeholder="Contoh: Matematika" autocomplete="off">
                            @error('nama_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="create_kode_mapel" class="form-label">
                                    Kode <span class="text-muted fw-normal">(Opsional)</span>
                                </label>
                                <input id="create_kode_mapel" type="text"
                                    class="form-control @error('kode_mapel') is-invalid @enderror"
                                    wire:model.defer="kode_mapel" maxlength="20"
                                    placeholder="Contoh: MTK" autocomplete="off">
                                @error('kode_mapel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="create_urutan_mapel" class="form-label">
                                    Urutan <span class="text-danger">*</span>
                                </label>
                                <input id="create_urutan_mapel" type="number" min="1"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    wire:model.defer="urutan" placeholder="Contoh: 1">
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Mengatur posisi dalam daftar.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="create_status_mapel" class="form-label">Status</label>
                            <select id="create_status_mapel"
                                class="form-select @error('status') is-invalid @enderror"
                                wire:model.defer="status">
                                <option value="AKTIF">Aktif</option>
                                <option value="NONAKTIF">Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="create_deskripsi_mapel" class="form-label">
                                Keterangan <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <textarea id="create_deskripsi_mapel" rows="3"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                wire:model.defer="deskripsi"
                                placeholder="Masukkan keterangan tambahan mata pelajaran"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4"
                            wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save">
                                <i class="ri-save-3-line me-1"></i> Simpan Mata Pelajaran
                            </span>
                            <span wire:loading wire:target="save">
                                <span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
