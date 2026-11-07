<div>
    <div wire:ignore.self
        class="modal fade"
        id="ModalAksesPetugas"
        tabindex="-1"
        aria-labelledby="ModalAksesPetugasLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header border-0 px-4 pt-4 pb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="ri-shield-user-line"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1" id="ModalAksesPetugasLabel">
                                Atur Akses Jenjang
                            </h5>
                            <small class="text-muted">
                                Kelola hak akses petugas SPMB.
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

                <form wire:submit.prevent="save">

                    {{-- BODY --}}
                    <div class="modal-body px-4 pt-2 pb-4">

                        {{-- IDENTITAS PETUGAS --}}
                        <div class="d-flex align-items-center gap-3 bg-light rounded-3 p-3 mb-4">
                            <div class="avatar-sm flex-shrink-0">
                                <div class="avatar-title bg-white text-primary rounded-circle">
                                    <i class="ri-user-line fs-18"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <small class="text-muted d-block mb-1">
                                    Petugas yang dikelola
                                </small>
                                <h6 class="fw-semibold mb-0 text-truncate">
                                    {{ $nama }}
                                </h6>
                            </div>
                        </div>

                        {{-- HAK AKSES --}}
                        <section>
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-1">
                                    Hak Akses Jenjang
                                </h6>
                                <small class="text-muted">
                                    Pilih jenjang yang dapat diakses dan dikelola oleh petugas ini.
                                </small>
                            </div>

                            @forelse ($daftarJenjang as $jenjang)
                                <label
                                    class="form-check border rounded-3 p-3 ps-5 mb-2 d-flex align-items-center"
                                    for="akses-jenjang-{{ $jenjang->ms_jenjang_id }}">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="akses-jenjang-{{ $jenjang->ms_jenjang_id }}"
                                        value="{{ $jenjang->ms_jenjang_id }}"
                                        wire:model="jenjangIds">

                                    <span class="form-check-label fw-medium ms-1">
                                        {{ $jenjang->nama_jenjang }}
                                    </span>
                                </label>
                            @empty
                                <div class="text-center border rounded-3 p-4">
                                    <div class="avatar-md mx-auto mb-3">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded-circle fs-22">
                                            <i class="ri-folder-warning-line"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-semibold mb-1">
                                        Belum Ada Jenjang
                                    </h6>
                                    <small class="text-muted">
                                        Belum ada jenjang aktif yang dapat diberikan kepada petugas.
                                    </small>
                                </div>
                            @endforelse

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
                            wire:target="save"
                            @if ($daftarJenjang->isEmpty()) disabled @endif>

                            <span wire:loading.remove wire:target="save">
                                <i class="ri-save-3-line me-1"></i>
                                Simpan Akses
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