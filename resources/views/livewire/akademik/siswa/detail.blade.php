
<div wire:ignore.self class="modal fade" id="ModalDetailSiswa" tabindex="-1"
    aria-labelledby="ModalDetailSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- HEADER --}}
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-user-line fs-18"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1" id="ModalDetailSiswaLabel">
                            Detail Siswa
                        </h5>
                        <small class="text-muted">
                            Informasi pribadi, keluarga, dan administrasi siswa.
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

            {{-- BODY --}}
            <div class="modal-body">

                {{-- PROFILE --}}
                <div class="text-center mb-4">
                    <div class="avatar-lg mx-auto mb-3">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-user-3-line fs-24"></i>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-1">
                        {{ $siswaDetail->ms_siswa->nama_siswa ?? '-' }}
                    </h5>

                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                        {{ $siswaDetail->ms_jenjang->nama_jenjang ?? '-' }}
                    </span>
                </div>

                {{-- CONTEXT AKADEMIK --}}
                <div class="border rounded-4 p-3 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-graduation-cap-line"></i>
                            </div>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">
                                Informasi Akademik
                            </div>
                            <small class="text-muted">
                                Penempatan dan ringkasan saldo siswa.
                            </small>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $siswaDetail->ms_jenjang->nama_jenjang ?? '-' }}
                        </span>

                        <span class="text-muted small">
                            {{ $siswaDetail->ms_tahun_ajar->nama_tahun_ajar ?? '-' }}
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <div class="text-muted small mb-1">
                                    <i class="ri-wallet-3-line text-success me-1"></i>
                                    Tabungan
                                </div>
                                <div class="fw-semibold text-success">
                                    Rp {{ number_format($saldo_tabungan, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <div class="text-muted small mb-1">
                                    <i class="ri-bank-card-line text-primary me-1"></i>
                                    EduPay
                                </div>
                                <div class="fw-semibold text-primary">
                                    Rp {{ number_format($saldo_edupay, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DATA UTAMA --}}
                <div class="border rounded-4 p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-user-line"></i>
                            </div>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">
                                Data Utama
                            </div>
                            <small class="text-muted">
                                Identitas pribadi dan penempatan siswa.
                            </small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Nama Siswa</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-user-line text-primary me-2"></i>
                            {{ $siswaDetail->ms_siswa->nama_siswa ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">NISN</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-id-card-line text-info me-2"></i>
                            {{ $siswaDetail->ms_siswa->nisn ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Kelas</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-building-4-line text-primary me-2"></i>
                            {{ $siswaDetail->ms_kelas->nama_kelas ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Telepon</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-phone-line text-success me-2"></i>
                            {{ $siswaDetail->ms_siswa->telepon ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Tempat Lahir</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-map-pin-line text-info me-2"></i>
                            {{ $siswaDetail->ms_siswa->tempat_lahir ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-muted small mb-1">Tanggal Lahir</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-calendar-line text-success me-2"></i>
                            {{ $siswaDetail->ms_siswa->tanggal_lahir ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- DATA KELUARGA --}}
                <div class="border rounded-4 p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-parent-line"></i>
                            </div>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">
                                Data Keluarga
                            </div>
                            <small class="text-muted">
                                Informasi orang tua dan alamat siswa.
                            </small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Nama Ayah</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-user-line text-primary me-2"></i>
                            {{ $siswaDetail->ms_siswa->nama_ayah ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Nama Ibu</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-user-line text-primary me-2"></i>
                            {{ $siswaDetail->ms_siswa->nama_ibu ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-muted small mb-1">Alamat</div>
                        <div class="fw-medium text-dark text-break">
                            <i class="ri-map-pin-line text-success me-2"></i>
                            {{ $siswaDetail->ms_siswa->alamat ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- INFORMASI TAMBAHAN --}}
                <div class="border rounded-4 p-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-information-line"></i>
                            </div>
                        </div>

                        <div>
                            <div class="fw-semibold text-dark">
                                Informasi Tambahan
                            </div>
                            <small class="text-muted">
                                Informasi pendukung administrasi siswa.
                            </small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">EduCard</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-bank-card-line text-primary me-2"></i>
                            {{ $siswaDetail->ms_siswa->ms_educard?->kode_kartu ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small mb-1">Petugas</div>
                        <div class="fw-medium text-dark">
                            <i class="ri-user-settings-line text-info me-2"></i>
                            {{ $siswaDetail->ms_pengguna?->nama ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-muted small mb-1">Catatan Siswa</div>
                        <div class="fw-medium text-dark text-break">
                            {{ $siswaDetail->ms_siswa->deskripsi ?? '-' }}
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted">
                            <i class="ri-time-line me-1"></i>
                            Terdaftar pada {{ $created_at_formatted ?? '-' }}
                        </small>
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
            </div>

        </div>
    </div>
</div>
