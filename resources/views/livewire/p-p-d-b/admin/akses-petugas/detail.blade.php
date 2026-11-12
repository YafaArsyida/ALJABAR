
<div>
    <div wire:ignore.self class="modal fade" id="ModalDetailPetugasSPMB" tabindex="-1"
        aria-labelledby="ModalDetailPetugasSPMBLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header border-0 px-4 pt-4 pb-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-user-line fs-18"></i>
                            </div>
                        </div>

                        <div>
                            <h5 class="modal-title fw-bold mb-1" id="ModalDetailPetugasSPMBLabel">
                                Detail Petugas SPMB
                            </h5>
                            <small class="text-muted">
                                Informasi akun dan hak akses SPMB.
                            </small>
                        </div>
                    </div>

                    <button type="button"
                        class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                {{-- BODY --}}
                <div class="modal-body px-4 pt-2 pb-4">

                    @if ($petugas)

                        {{-- PROFILE --}}
                        <div class="text-center mb-4">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-user-3-line fs-24"></i>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-1">
                                {{ $petugas->nama ?: '-' }}
                            </h5>

                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                {{ $petugas->peran ?: '-' }}
                            </span>
                        </div>

                        {{-- INFORMASI AKUN --}}
                        <div class="mb-3">

                            {{-- NAMA --}}
                            <div class="border rounded-4 p-3 mb-3">
                                <div class="text-muted small mb-1">
                                    Nama Petugas
                                </div>
                                <div class="fw-medium text-dark">
                                    <i class="ri-user-line text-primary me-2"></i>
                                    {{ $petugas->nama ?: '-' }}
                                </div>
                            </div>

                            {{-- USERNAME --}}
                            <div class="border rounded-4 p-3 mb-3">
                                <div class="text-muted small mb-1">
                                    Email / Username
                                </div>
                                <div class="fw-medium text-dark text-break">
                                    <i class="ri-user-settings-line text-info me-2"></i>
                                    {{ $petugas->email ?: '-' }}
                                </div>
                            </div>

                            {{-- PERAN --}}
                            <div class="border rounded-4 p-3 mb-3">
                                <div class="text-muted small mb-1">
                                    Peran Pengguna
                                </div>
                                <div>
                                    <span class="badge bg-warning-subtle text-warning">
                                        <i class="ri-shield-user-line me-1"></i>
                                        {{ $petugas->peran ?: '-' }}
                                    </span>
                                </div>
                            </div>

                            {{-- TANGGAL PENDAFTARAN --}}
                            <div class="border rounded-4 p-3">
                                <div class="text-muted small mb-1">
                                    Tanggal Pendaftaran
                                </div>
                                <div class="fw-medium text-dark">
                                    <i class="ri-calendar-line text-success me-2"></i>
                                    {{ $petugas->created_at
                                        ? $petugas->created_at->format('d M Y, H:i')
                                        : '-' }}
                                </div>
                            </div>

                        </div>

                        {{-- AKSES JENJANG --}}
                        <div class="border rounded-4 p-3">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                        <i class="ri-building-line"></i>
                                    </div>
                                </div>

                                <div>
                                    <div class="fw-semibold text-dark">
                                        Akses Jenjang
                                    </div>
                                    <small class="text-muted">
                                        Jenjang pendidikan yang dapat dikelola.
                                    </small>
                                </div>
                            </div>

                            @forelse ($petugas->ms_jenjang as $jenjang)
                                <span class="badge bg-light text-body rounded-pill px-3 py-2 me-1 mb-1">
                                    <i class="ri-graduation-cap-line text-primary me-1"></i>
                                    {{ $jenjang->nama_jenjang }}
                                </span>
                            @empty
                                <div class="text-muted small">
                                    <i class="ri-information-line me-1"></i>
                                    Belum memiliki akses jenjang.
                                </div>
                            @endforelse
                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
