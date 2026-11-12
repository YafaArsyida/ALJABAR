<div>
    <div wire:ignore.self
        class="modal fade"
        id="ModalAddPetugasSPMB"
        tabindex="-1"
        aria-labelledby="ModalAddPetugasSPMBLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header border-0 px-4 pt-4 pb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="ri-user-add-line"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1" id="ModalAddPetugasSPMBLabel">
                                Tambah Petugas SPMB
                            </h5>
                            <small class="text-muted">
                                Buat akun petugas dan atur akses jenjang yang dapat dikelola.
                            </small>
                        </div>
                    </div>

                    <button type="button"
                        class="btn btn-light btn-icon rounded-circle"
                        data-bs-dismiss="modal"
                        aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="d-flex flex-column flex-grow-1"
                style="min-height: 0; overflow: hidden;">

                    {{-- BODY --}}
                    <div class="modal-body px-4 pt-2 pb-4">

                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted">
                                <span class="text-danger">*</span> Wajib diisi
                            </small>
                        </div>

                        {{-- DATA AKUN --}}
                        <section class="mb-4">
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">Informasi Akun</h6>
                                <small class="text-muted">
                                    Lengkapi identitas dan kredensial untuk masuk ke sistem SPMB.
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="petugas-baru-nama" class="form-label">
                                    Nama Petugas
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    id="petugas-baru-nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    wire:model.defer="nama"
                                    placeholder="Masukkan nama lengkap">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="petugas-baru-email" class="form-label">
                                    Email / Username
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    id="petugas-baru-email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    wire:model.defer="email"
                                    placeholder="Masukkan email atau username"
                                    autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="petugas-baru-password" class="form-label">
                                    Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password"
                                    id="petugas-baru-password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    wire:model.defer="password"
                                    placeholder="Buat password akun"
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </section>

                        <hr class="border-dashed">

                        {{-- AKSES JENJANG --}}
                        <section>
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">Hak Akses Jenjang</h6>
                                <small class="text-muted">
                                    Pilih jenjang yang dapat diakses dan dikelola oleh petugas ini.
                                </small>
                            </div>

                            <div class="row g-2">
                                @foreach ($daftarJenjang as $jenjang)
                                    <div class="col-12">
                                        <label
                                            class="form-check border rounded-3 p-3 ps-5 mb-0 d-flex align-items-center"
                                            for="petugas-baru-jenjang-{{ $jenjang->ms_jenjang_id }}">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="petugas-baru-jenjang-{{ $jenjang->ms_jenjang_id }}"
                                                value="{{ $jenjang->ms_jenjang_id }}"
                                                wire:model="jenjangIds">

                                            <span class="form-check-label fw-medium ms-1">
                                                {{ $jenjang->nama_jenjang }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('jenjangIds')
                                <div class="text-danger fs-12 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                Simpan Petugas
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
</div>