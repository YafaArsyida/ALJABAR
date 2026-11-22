<div>
    <div wire:ignore.self class="modal fade" id="ModalEditPeriodeAkademik" tabindex="-1"
        aria-labelledby="ModalEditPeriodeAkademikLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
                <div class="modal-header border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="mdi mdi-calendar-edit"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1" id="ModalEditPeriodeAkademikLabel">Perbarui Periode Akademik</h5>
                            <small class="text-muted">Periksa dan sesuaikan informasi semester.</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <form class="d-flex flex-column overflow-hidden" wire:submit.prevent="updatePeriodeAkademik">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted"><span class="text-danger">*</span> Wajib diisi</small>
                        </div>

                        <div class="alert alert-primary bg-primary-subtle border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-start gap-2">
                                <i class="ri-information-line fs-18 mt-1"></i>
                                <div>
                                    <div class="fw-semibold">{{ $jenjang->nama_jenjang ?? 'Jenjang tidak ditemukan' }}</div>
                                    <div class="small">
                                        Tahun ajar: {{ $tahunAjar->nama_tahun_ajar ?? 'Tidak ditemukan' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_nama_periode" class="form-label">
                                Semester <span class="text-danger">*</span>
                            </label>
                            <select id="edit_nama_periode"
                                class="form-select @error('nama_periode') is-invalid @enderror"
                                wire:model.defer="nama_periode">
                                <option value="Semester 1">Semester 1</option>
                                <option value="Semester 2">Semester 2</option>
                            </select>
                            @error('nama_periode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Urutan semester akan disesuaikan otomatis.</small>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="edit_tanggal_mulai" class="form-label">
                                    Tanggal Mulai <span class="text-danger">*</span>
                                </label>
                                <input id="edit_tanggal_mulai" type="date"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                    wire:model.defer="tanggal_mulai">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="edit_tanggal_selesai" class="form-label">
                                    Tanggal Selesai <span class="text-danger">*</span>
                                </label>
                                <input id="edit_tanggal_selesai" type="date"
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                    wire:model.defer="tanggal_selesai">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_status_periode" class="form-label">Status</label>
                            <select id="edit_status_periode"
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
                            <label for="edit_deskripsi_periode" class="form-label">
                                Keterangan <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <textarea id="edit_deskripsi_periode" rows="3"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                wire:model.defer="deskripsi"
                                placeholder="Masukkan keterangan tambahan periode"></textarea>
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
                            wire:loading.attr="disabled" wire:target="updatePeriodeAkademik">
                            <span wire:loading.remove wire:target="updatePeriodeAkademik">
                                <i class="ri-save-3-line me-1"></i> Simpan Perubahan
                            </span>
                            <span wire:loading wire:target="updatePeriodeAkademik">
                                <span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
