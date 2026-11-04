<div>
    <div wire:ignore.self class="modal fade" id="ModalDetailPetugasSPMB" tabindex="-1" aria-labelledby="ModalDetailPetugasSPMBLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 px-4 pt-4 pb-2">
                    <div>
                        <h5 class="modal-title fw-bold" id="ModalDetailPetugasSPMBLabel">Detail Petugas</h5>
                        <small class="text-muted">Informasi akun dan akses SPMB.</small>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body px-4 pt-2 pb-4">
                    @if ($petugas)
                        <div class="text-center mb-4">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-user-3-line fs-24"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-1">{{ $petugas->nama }}</h5>
                            <span class="badge bg-primary-subtle text-primary">{{ $petugas->peran }}</span>
                        </div>
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="text-muted small mb-1">Email / Username</div>
                            <div class="fw-medium text-break">{{ $petugas->email }}</div>
                        </div>
                        <div class="border rounded-4 p-3">
                            <div class="text-muted small mb-2">Akses Jenjang</div>
                            @forelse ($petugas->ms_jenjang as $jenjang)
                                <span class="badge bg-light text-body me-1 mb-1">{{ $jenjang->nama_jenjang }}</span>
                            @empty
                                <span class="text-muted">Belum memiliki akses jenjang.</span>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
