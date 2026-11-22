<div>
    <div wire:ignore.self class="modal fade" id="ModalEditGuru" tabindex="-1"
        aria-labelledby="ModalEditGuruLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
                <div class="modal-header border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="mdi mdi-account-edit-outline"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1" id="ModalEditGuruLabel">Perbarui Data Guru</h5>
                            <small class="text-muted">Perbarui identitas pegawai dan akun pengguna yang terhubung.</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <form wire:submit.prevent="updateGuru">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end mb-3">
                            <small class="text-muted"><span class="text-danger">*</span> Wajib diisi</small>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="card border shadow-none rounded-4 h-100 mb-0">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Penempatan dan Status</h6>
                                        <div class="mb-3">
                                            <label class="form-label">Jenjang</label>
                                            <input type="text" class="form-control"
                                                value="{{ $jenjang->nama_jenjang ?? 'Tidak ditemukan' }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_jabatan_guru" class="form-label">
                                                Jabatan <span class="text-danger">*</span>
                                            </label>
                                            <select id="edit_jabatan_guru"
                                                class="form-select @error('ms_jabatan_id') is-invalid @enderror"
                                                wire:model.defer="ms_jabatan_id">
                                                <option value="">Pilih jabatan</option>
                                                @foreach ($jabatans as $jabatan)
                                                    <option value="{{ $jabatan->ms_jabatan_id }}">{{ $jabatan->nama_jabatan }}</option>
                                                @endforeach
                                            </select>
                                            @error('ms_jabatan_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_status_guru" class="form-label">Status Keaktifan</label>
                                            <select id="edit_status_guru"
                                                class="form-select @error('status') is-invalid @enderror"
                                                wire:model.defer="status">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Nonaktif">Nonaktif</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="alert alert-info bg-info-subtle border-0 rounded-3 mb-0">
                                            <small>
                                                <i class="ri-link-m me-1"></i>
                                                Akun login tertaut melalui data pegawai.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card border shadow-none rounded-4 mb-3">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Identitas Guru</h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="edit_nama_guru" class="form-label">
                                                    Nama Lengkap <span class="text-danger">*</span>
                                                </label>
                                                <input id="edit_nama_guru" type="text"
                                                    class="form-control @error('nama_pegawai') is-invalid @enderror"
                                                    wire:model.defer="nama_pegawai" maxlength="255">
                                                @error('nama_pegawai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                <select id="edit_jenis_kelamin"
                                                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                    wire:model.defer="jenis_kelamin">
                                                    <option value="">Pilih jenis kelamin</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_nip_guru" class="form-label">NIP</label>
                                                <input id="edit_nip_guru" type="text"
                                                    class="form-control @error('nip') is-invalid @enderror"
                                                    wire:model.defer="nip" maxlength="50">
                                                @error('nip')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_nik_guru" class="form-label">NIK</label>
                                                <input id="edit_nik_guru" type="text"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    wire:model.defer="nik" maxlength="30">
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_tempat_lahir" class="form-label">Tempat Lahir</label>
                                                <input id="edit_tempat_lahir" type="text"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    wire:model.defer="tempat_lahir" maxlength="100">
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                <input id="edit_tanggal_lahir" type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    wire:model.defer="tanggal_lahir">
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_tanggal_masuk" class="form-label">Tanggal Bergabung</label>
                                                <input id="edit_tanggal_masuk" type="date"
                                                    class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                                    wire:model.defer="tanggal_masuk">
                                                @error('tanggal_masuk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_telepon_guru" class="form-label">Nomor Telepon</label>
                                                <input id="edit_telepon_guru" type="tel"
                                                    class="form-control @error('telepon') is-invalid @enderror"
                                                    wire:model.defer="telepon" maxlength="20">
                                                @error('telepon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="edit_alamat_guru" class="form-label">Alamat</label>
                                                <textarea id="edit_alamat_guru" rows="2"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    wire:model.defer="alamat"></textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="edit_deskripsi_guru" class="form-label">Catatan</label>
                                                <textarea id="edit_deskripsi_guru" rows="2"
                                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                                    wire:model.defer="deskripsi"></textarea>
                                                @error('deskripsi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border shadow-none rounded-4 mb-0">
                                    <div class="card-body">
                                        <h6 class="fw-semibold mb-3">Akun Pengguna</h6>
                                        @unless ($userConnected)
                                            <div class="alert alert-warning border-0 rounded-3">
                                                Belum ada akun yang terhubung. Isi kata sandi untuk membuat akun Guru.
                                            </div>
                                        @endunless
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="edit_email_guru" class="form-label">
                                                    Email Login <span class="text-danger">*</span>
                                                </label>
                                                <input id="edit_email_guru" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    wire:model.defer="email" maxlength="255" autocomplete="email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edit_password_guru" class="form-label">
                                                    {{ $userConnected ? 'Kata Sandi Baru (Opsional)' : 'Kata Sandi Awal' }}
                                                    @unless ($userConnected)<span class="text-danger">*</span>@endunless
                                                </label>
                                                <input id="edit_password_guru" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    wire:model.defer="password" minlength="8" autocomplete="new-password"
                                                    placeholder="{{ $userConnected ? 'Kosongkan jika tidak ingin mengubah' : '' }}">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4"
                            wire:loading.attr="disabled" wire:target="updateGuru">
                            <span wire:loading.remove wire:target="updateGuru">
                                <i class="ri-save-3-line me-1"></i> Simpan Perubahan
                            </span>
                            <span wire:loading wire:target="updateGuru">
                                <span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
