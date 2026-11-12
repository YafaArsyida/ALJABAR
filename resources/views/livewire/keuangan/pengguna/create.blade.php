
<div>
    <div wire:ignore.self class="modal fade" id="ModalAddPengguna" tabindex="-1"
        aria-labelledby="ModalAddPenggunaLabel" aria-hidden="true">

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
                            <h5 class="fw-bold mb-1" id="ModalAddPenggunaLabel">
                                Tambah Petugas Keuangan
                            </h5>
                            <small class="text-muted">
                                Buat akun pengguna dan atur hak akses jenjang yang dapat dikelola.
                            </small>
                        </div>
                    </div>

                    <button type="button"
                        class="btn btn-light btn-icon rounded-circle"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                {{-- FORM --}}
                <form wire:submit.prevent="save"
                    class="d-flex flex-column flex-grow-1"
                    style="min-height: 0; overflow: hidden;">

                    {{-- BODY --}}
                    <div class="modal-body px-4 pt-2 pb-4">

                        {{-- KETERANGAN --}}
                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted">
                                <span class="text-danger">*</span> Wajib diisi
                            </small>
                        </div>

                        {{-- INFORMASI AKUN --}}
                        <section class="mb-4">
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">
                                    Informasi Akun
                                </h6>
                                <small class="text-muted">
                                    Lengkapi identitas, peran, dan kredensial untuk masuk ke sistem.
                                </small>
                            </div>

                            {{-- NAMA --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    Nama Petugas
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    wire:model.defer="nama"
                                    id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap petugas"
                                    autocomplete="name">

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- PERAN --}}
                            <div class="mb-3">
                                <label for="peran" class="form-label">
                                    Peran Pengguna
                                    <span class="text-danger">*</span>
                                </label>

                                <select id="peran"
                                    wire:model="peran"
                                    class="form-select @error('peran') is-invalid @enderror">

                                    <option value="">Pilih Peran</option>
                                    <option value="SUPERADMIN">SUPERADMIN</option>
                                    <option value="ADMIN">ADMINISTRASI</option>
                                    <option value="KANTIN">PETUGAS KANTIN</option>
                                    <option value="KOPERASI">PETUGAS KOPERASI</option>
                                </select>

                                @error('peran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- EMAIL / USERNAME --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email / Username
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    wire:model.defer="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email atau username"
                                    autocomplete="username">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- PASSWORD --}}
                            <div>
                                <label for="password" class="form-label">
                                    Password
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="password"
                                    wire:model.defer="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 6 karakter"
                                    autocomplete="new-password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </section>

                        <hr class="border-dashed">

                        {{-- HAK AKSES JENJANG --}}
                        <section>
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">
                                    Hak Akses Jenjang
                                </h6>
                                <small class="text-muted">
                                    Pilih jenjang pendidikan yang dapat diakses dan dikelola oleh petugas ini.
                                </small>
                            </div>

                            <div class="row g-2">
                                @foreach ($select_jenjang as $item)
                                    <div class="col-12">
                                        <label
                                            class="form-check border rounded-3 p-3 ps-5 mb-0 d-flex align-items-center"
                                            for="ms_jenjang_id_{{ $item->ms_jenjang_id }}">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="ms_jenjang_id_{{ $item->ms_jenjang_id }}"
                                                wire:model="ms_jenjang_id"
                                                value="{{ $item->ms_jenjang_id }}">

                                            <span class="form-check-label fw-medium ms-1">
                                                {{-- <i class="ri-graduation-cap-line text-primary me-1"></i> --}}
                                                {{ $item->nama_jenjang }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('ms_jenjang_id')
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
