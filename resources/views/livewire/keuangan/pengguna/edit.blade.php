
<div>
    <div wire:ignore.self
        class="modal fade"
        id="ModalEditPengguna"
        tabindex="-1"
        aria-labelledby="ModalEditPenggunaLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header border-0 px-4 pt-4 pb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="ri-user-settings-line"></i>
                            </div>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1" id="ModalEditPenggunaLabel">
                                Perbarui Petugas Keuangan
                            </h5>
                            <small class="text-muted">
                                Perbarui informasi akun dan hak akses jenjang yang dapat dikelola.
                            </small>
                        </div>
                    </div>

                    <button type="button"
                        class="btn btn-light btn-icon rounded-circle ms-auto flex-shrink-0"
                        data-bs-dismiss="modal"
                        aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <form wire:submit.prevent="updatePengguna"
                    class="d-flex flex-column flex-grow-1"
                    style="min-height: 0; overflow: hidden;">

                    {{-- BODY --}}
                    <div class="modal-body px-4 pt-2 pb-4">

                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted">
                                <span class="text-danger">*</span> Wajib diisi
                            </small>
                        </div>

                        
                        {{-- INFORMASI AKUN --}}
                        <section class="mb-4">
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">Informasi Akun</h6>
                                <small class="text-muted">
                                    Perbarui identitas, peran, dan kredensial akun petugas.
                                </small>
                            </div>

                            {{-- NAMA --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    wire:model="nama"
                                    placeholder="Masukkan nama lengkap petugas">

                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PERAN --}}
                            <div class="mb-3">
                                <label for="peran" class="form-label">
                                    Peran
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email / Username
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    wire:model="email"
                                    placeholder="user@example.com / username"
                                    autocomplete="username">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PASSWORD --}}
                            <div>
                                <label for="password" class="form-label">
                                    Password Baru
                                    <small class="text-muted fw-normal">(Opsional)</small>
                                </label>

                                <input type="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    wire:model.defer="password"
                                    placeholder="Kosongkan jika tidak diubah"
                                    autocomplete="new-password">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="text-muted d-block mt-1">
                                    Isi hanya jika ingin mengganti password petugas.
                                </small>
                            </div>
                        </section>

                        <hr class="border-dashed">

                        {{-- HAK AKSES JENJANG --}}
                        <section>
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">Hak Akses Jenjang</h6>
                                <small class="text-muted">
                                    Atur jenjang pendidikan yang dapat diakses dan dikelola oleh petugas.
                                </small>
                            </div>

                            <div class="row g-2">
                                @foreach ($select_jenjang as $item)
                                    <div class="col-12"
                                        wire:key="edit-jenjang-{{ $item->ms_jenjang_id }}">

                                        <label
                                            class="form-check border rounded-3 p-3 ps-5 mb-0 d-flex align-items-center"
                                            for="edit_{{ $item->ms_jenjang_id }}">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="edit_{{ $item->ms_jenjang_id }}"
                                                wire:model="ms_jenjang_id"
                                                value="{{ $item->ms_jenjang_id }}"
                                                @if(in_array($item->ms_jenjang_id, $selectedJenjang)) checked @endif>

                                            <span class="form-check-label fw-medium ms-1">
                                                {{ $item->nama_jenjang }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('ms_jenjang_id')
                                <div class="text-danger fs-12 mt-2">
                                    <i class="ri-error-warning-line me-1"></i>
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
                            wire:target="updatePengguna">

                            <span wire:loading.remove wire:target="updatePengguna">
                                <i class="ri-save-3-line me-1"></i>
                                Simpan Perubahan
                            </span>

                            <span wire:loading wire:target="updatePengguna">
                                <span class="spinner-border spinner-border-sm me-1"
                                    role="status"
                                    aria-hidden="true"></span>
                                Menyimpan...
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
