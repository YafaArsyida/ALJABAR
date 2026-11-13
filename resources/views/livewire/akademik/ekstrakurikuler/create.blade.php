
{{-- MODAL TAMBAH EKSTRAKURIKULER --}}
<div wire:ignore.self class="modal fade" id="ModalAddEkstrakurikuler" tabindex="-1"
    aria-labelledby="ModalAddEkstrakurikulerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-trophy-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalAddEkstrakurikulerLabel">
                            Ekstrakurikuler Baru
                        </h5>
                        <small class="text-muted">
                            Tambahkan kegiatan yang dapat dipilih siswa.
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

            <form id="formAddEkstrakurikuler" class="d-flex flex-column overflow-hidden"
                wire:submit.prevent="save">

                {{-- BODY --}}
                <div class="modal-body px-4 pt-2 pb-4">

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
                            <label for="create_nama_ekstrakurikuler" class="form-label">
                                Nama Ekstrakurikuler
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                wire:model.defer="nama_ekstrakurikuler"
                                id="create_nama_ekstrakurikuler"
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
                            <label for="create_biaya" class="form-label">
                                Biaya (Rp)
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model.defer="biaya"
                                id="create_biaya"
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
                            <label for="create_kuota" class="form-label">
                                Kuota
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                wire:model.defer="kuota"
                                id="create_kuota"
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
                            <label for="create_deskripsi" class="form-label">
                                Deskripsi
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>

                            <textarea wire:model.defer="deskripsi"
                                id="create_deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3"
                                placeholder="Masukkan deskripsi singkat tentang ekstrakurikuler..."></textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </section>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="save">

                        <span wire:loading.remove wire:target="save">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan Ekstrakurikuler
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
