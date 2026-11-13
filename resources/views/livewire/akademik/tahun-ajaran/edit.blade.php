
<div wire:ignore.self class="modal fade" id="ModalEditTahunAjar" tabindex="-1"
    aria-labelledby="ModalEditTahunAjar" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-calendar-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Perbarui Tahun Ajar
                        </h5>
                        <small class="text-muted">
                            Perbarui periode dan informasi tahun ajar.
                        </small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    id="close-modal">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            {{-- FORM --}}
            <form wire:submit.prevent="updateTahunAjar"
                class="d-flex flex-column overflow-hidden">

                <div class="modal-body">

                    {{-- KETERANGAN WAJIB DIISI --}}
                    <div class="d-flex justify-content-end mb-3">
                        <small class="text-muted">
                            <span class="text-danger">*</span> Wajib diisi
                        </small>
                    </div>

                    <div class="row g-3">

                        {{-- NAMA TAHUN AJAR --}}
                        <div class="col-lg-8">
                            <label for="nama_tahun_ajar" class="form-label">
                                Nama Tahun Ajar <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                wire:model="nama_tahun_ajar"
                                id="nama_tahun_ajar"
                                class="form-control @error('nama_tahun_ajar') is-invalid @enderror"
                                placeholder="Contoh: 2024 - 2025">

                            @error('nama_tahun_ajar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- URUTAN --}}
                        <div class="col-lg-4">
                            <label for="urutan" class="form-label">
                                Urutan <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model="urutan"
                                id="urutan"
                                class="form-control @error('urutan') is-invalid @enderror"
                                placeholder="Contoh: 1">

                            @error('urutan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- TANGGAL MULAI --}}
                        <div class="col-lg-6">
                            <label for="tanggal_mulai" class="form-label">
                                Tanggal Mulai <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                wire:model="tanggal_mulai"
                                id="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror">

                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- TANGGAL SELESAI --}}
                        <div class="col-lg-6">
                            <label for="tanggal_selesai" class="form-label">
                                Tanggal Selesai <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                wire:model="tanggal_selesai"
                                id="tanggal_selesai"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror">

                            @error('tanggal_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">
                                Deskripsi <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <input type="text"
                                wire:model="deskripsi"
                                id="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Masukkan deskripsi tahun ajaran...">

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Tutup
                    </button>

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="updateTahunAjar">

                        <span wire:loading.remove wire:target="updateTahunAjar">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Perubahan
                        </span>

                        <span wire:loading wire:target="updateTahunAjar">
                            <span class="spinner-border spinner-border-sm me-1"
                                role="status" aria-hidden="true"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
