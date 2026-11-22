<div>
    <div wire:ignore.self class="modal fade" id="ModalAddGuru" tabindex="-1"
        aria-labelledby="ModalAddGuruLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden d-flex flex-column">
                <div class="modal-header border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="mdi mdi-account-plus-outline"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1" id="ModalAddGuruLabel">Guru Baru</h5>
                            <small class="text-muted">Data guru disimpan sebagai pegawai dan dibuatkan akun pengguna.</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <form wire:submit.prevent="save">
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
                                                value="{{ $jenjang->nama_jenjang ?? 'Pilih jenjang pada halaman' }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="create_jabatan_guru" class="form-label">
                                                Jabatan <span class="text-danger">*</span>
                                            </label>
                                            <select id="create_jabatan_guru"
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
                                            <label for="create_status_guru" class="form-label">Status Keaktifan</label>
                                            <select id="create_status_guru"
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
                                                <i class="ri-information-line me-1"></i>
                                                Akun dibuat dengan peran Guru dan diberi akses ke jenjang ini.
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
                                                <label for="create_nama_guru" class="form-label">
                                                    Nama Lengkap <span class="text-danger">*</span>
                                                </label>
                                                <input id="create_nama_guru" type="text"
                                                    class="form-control @error('nama_pegawai') is-invalid @enderror"
                                                    wire:model.defer="nama_pegawai" maxlength="255"
                                                    placeholder="Nama sesuai identitas" autocomplete="name">
                                                @error('nama_pegawai')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                <select id="create_jenis_kelamin"
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
                                                <label for="create_nip_guru" class="form-label">NIP</label>
                                                <input id="create_nip_guru" type="text"
                                                    class="form-control @error('nip') is-invalid @enderror"
                                                    wire:model.defer="nip" maxlength="50" placeholder="Nomor induk pegawai">
                                                @error('nip')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_nik_guru" class="form-label">NIK</label>
                                                <input id="create_nik_guru" type="text"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    wire:model.defer="nik" maxlength="30" placeholder="Nomor identitas">
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_tempat_lahir" class="form-label">Tempat Lahir</label>
                                                <input id="create_tempat_lahir" type="text"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    wire:model.defer="tempat_lahir" maxlength="100">
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                <input id="create_tanggal_lahir" type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    wire:model.defer="tanggal_lahir">
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_tanggal_masuk" class="form-label">Tanggal Bergabung</label>
                                                <input id="create_tanggal_masuk" type="date"
                                                    class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                                    wire:model.defer="tanggal_masuk">
                                                @error('tanggal_masuk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_telepon_guru" class="form-label">Nomor Telepon</label>
                                                <input id="create_telepon_guru" type="tel"
                                                    class="form-control @error('telepon') is-invalid @enderror"
                                                    wire:model.defer="telepon" maxlength="20" autocomplete="tel">
                                                @error('telepon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="create_alamat_guru" class="form-label">Alamat</label>
                                                <textarea id="create_alamat_guru" rows="2"
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    wire:model.defer="alamat"></textarea>
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="create_deskripsi_guru" class="form-label">Catatan</label>
                                                <textarea id="create_deskripsi_guru" rows="2"
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
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="create_email_guru" class="form-label">
                                                    Email Login <span class="text-danger">*</span>
                                                </label>
                                                <input id="create_email_guru" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    wire:model.defer="email" maxlength="255" autocomplete="email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="create_password_guru" class="form-label">
                                                    Kata Sandi Awal <span class="text-danger">*</span>
                                                </label>
                                                <input id="create_password_guru" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    wire:model.defer="password" minlength="8" autocomplete="new-password">
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
                            wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save">
                                <i class="ri-save-3-line me-1"></i> Simpan Guru
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
