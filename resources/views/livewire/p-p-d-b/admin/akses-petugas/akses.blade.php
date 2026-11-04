<div>
    <div wire:ignore.self class="modal fade" id="ModalAksesPetugas" tabindex="-1" aria-labelledby="ModalAksesPetugasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 px-4 pt-4 pb-2">
                    <div>
                        <h5 class="modal-title fw-bold" id="ModalAksesPetugasLabel">Atur Akses Jenjang</h5>
                        <small class="text-muted">{{ $nama }}</small>
                    </div>
                    <button type="button" class="btn btn-light btn-icon rounded-circle" data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body px-4 pt-2 pb-4">
                        <p class="text-muted mb-3">Pilih jenjang yang dapat dikelola oleh petugas ini.</p>
                        <div class="d-flex flex-column gap-2">
                            @forelse ($daftarJenjang as $jenjang)
                                <label class="form-check border rounded-3 p-3 ps-5 mb-0" for="akses-jenjang-{{ $jenjang->ms_jenjang_id }}">
                                    <input class="form-check-input" type="checkbox" id="akses-jenjang-{{ $jenjang->ms_jenjang_id }}" value="{{ $jenjang->ms_jenjang_id }}" wire:model="jenjangIds">
                                    <span class="form-check-label fw-medium">{{ $jenjang->nama_jenjang }}</span>
                                </label>
                            @empty
                                <div class="alert alert-warning mb-0">Belum ada jenjang aktif yang dapat diberikan.</div>
                            @endforelse
                        </div>
                        @error('jenjangIds') <div class="text-danger fs-12 mt-2">{{ $message }}</div> @enderror
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save"><i class="ri-save-line me-1"></i>Simpan Akses</span>
                            <span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
