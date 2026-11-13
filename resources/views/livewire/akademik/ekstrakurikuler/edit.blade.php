
{{-- MODAL EDIT EKSTRAKURIKULER --}}
<div wire:ignore.self class="modal fade" id="editEkstrakurikuler" tabindex="-1"
    aria-labelledby="editEkstrakurikulerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-trophy-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="editEkstrakurikulerLabel">
                            Perbarui Data Ekstrakurikuler
                        </h5>
                        <small class="text-muted">
                            Perbarui informasi dan ketentuan kegiatan.
                        </small>
                    </div>
                </div>

                <button type="button"
                    class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal"
                    aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            <form id="formEditEkstrakurikuler" class="d-flex flex-column overflow-hidden"
                wire:submit.prevent="updateEkstrakurikuler">

                {{-- BODY --}}
                <div class="modal-body">

                    <div class="d-flex justify-content-end mb-3">
                        <small class="text-muted">
                            <span class="text-danger">*</span>
                            Wajib diisi
                        </small>
                    </div>

                    {{-- IDENTITAS EKSTRAKURIKULER --}}
                    <section class="mb-4">

                        {{-- NAMA EKSTRAKURIKULER --}}
                        <div class="mb-3">
                            <label for="edit_nama_ekstrakurikuler" class="form-label">
                                Nama Ekstrakurikuler
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                wire:model.defer="nama_ekstrakurikuler"
                                id="edit_nama_ekstrakurikuler"
                                class="form-control @error('nama_ekstrakurikuler') is-invalid @enderror"
                                placeholder="Contoh: Pramuka, Futsal, Tahfidz..."
                                autocomplete="off">

                            @error('nama_ekstrakurikuler')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BIAYA --}}
                        <div class="mb-3">
                            <label for="edit_biaya" class="form-label">
                                Biaya (Rp)
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model.defer="biaya"
                                id="edit_biaya"
                                class="form-control @error('biaya') is-invalid @enderror"
                                placeholder="Contoh: 50000">

                            @error('biaya')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- KUOTA --}}
                        <div>
                            <label for="edit_kuota" class="form-label">
                                Kuota
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model.defer="kuota"
                                id="edit_kuota"
                                class="form-control @error('kuota') is-invalid @enderror"
                                placeholder="Contoh: 20">

                            @error('kuota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </section>

                    {{-- INFORMASI EKSTRAKURIKULER --}}
                    <section>
                        {{-- DESKRIPSI --}}
                        <div>
                            <label for="edit_deskripsi" class="form-label">
                                Deskripsi
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <textarea wire:model.defer="deskripsi"
                                id="edit_deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3"
                                placeholder="Keterangan singkat tentang ekstrakurikuler..."></textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </section>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="updateEkstrakurikuler">

                        <span wire:loading.remove wire:target="updateEkstrakurikuler">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Perubahan
                        </span>

                        <span wire:loading wire:target="updateEkstrakurikuler">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyimpan...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
