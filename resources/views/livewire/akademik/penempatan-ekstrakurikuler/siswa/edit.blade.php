
{{-- MODAL EDIT SISWA EKSTRAKURIKULER --}}
<div wire:ignore.self class="modal fade" id="editSiswaEkstrakurikuler" tabindex="-1"
    aria-labelledby="ModalAddSiswa" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-trophy-line fs-18"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="ModalAddSiswa">
                            Kelola Ekstrakurikuler
                        </h5>
                        <small class="text-muted">
                            Atur kegiatan ekstrakurikuler yang diikuti siswa.
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

            <form wire:submit.prevent="update" 
                class="d-flex flex-column flex-grow-1"
                style="min-height: 0; overflow: hidden;">

                {{-- BODY --}}
                <div class="modal-body px-4 pt-2 pb-4">

                    {{-- PROFILE SISWA --}}
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <i class="ri-user-3-line fs-24"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2">
                            {{ $nama_siswa ?: '-' }}
                        </h5>

                        <div class="d-flex justify-content-center flex-wrap gap-3 text-muted small">

                            <div class="d-flex align-items-center gap-2">
                                <i class="ri-graduation-cap-line text-primary"></i>
                                <span class="fw-medium text-body">
                                    {{ $nama_kelas ?: '-' }}
                                </span>
                            </div>

                            @if ($telepon)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ri-smartphone-line text-info"></i>
                                    <span class="fw-medium text-body">
                                        {{ $telepon }}
                                    </span>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- INFORMASI PILIHAN --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-sm flex-shrink-0">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-information-line"></i>
                                </div>
                            </div>

                            <div>
                                <div class="fw-semibold text-dark">
                                    Pilih Ekstrakurikuler
                                </div>
                                <small class="text-muted">
                                    Pilih satu ekstrakurikuler yang akan diikuti siswa.
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- LIST EKSTRAKURIKULER --}}
                    <div class="row g-3">

                        @foreach ($select_ekstrakurikuler as $item)
                            <div class="col-lg-6">

                                <label for="ekskul_{{ $item->ms_ekstrakurikuler_id }}"
                                    class="w-100 mb-0">

                                    <div class="border rounded-4 p-3 h-100 cursor-pointer transition
                                        {{ $ms_ekstrakurikuler_id == $item->ms_ekstrakurikuler_id
                                            ? 'border-primary bg-primary-subtle shadow-sm'
                                            : 'bg-white' }}">

                                        <div class="d-flex align-items-start gap-3">

                                            {{-- RADIO --}}
                                            <div class="form-check mt-1 flex-shrink-0">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="ms_ekstrakurikuler_id"
                                                    id="ekskul_{{ $item->ms_ekstrakurikuler_id }}"
                                                    wire:model="ms_ekstrakurikuler_id"
                                                    value="{{ $item->ms_ekstrakurikuler_id }}">
                                            </div>

                                            {{-- ICON --}}
                                            <div class="avatar-sm flex-shrink-0">
                                                <div class="avatar-title rounded-circle
                                                    {{ $ms_ekstrakurikuler_id == $item->ms_ekstrakurikuler_id
                                                        ? 'bg-primary text-white'
                                                        : 'bg-primary-subtle text-primary' }}">
                                                    <i class="ri-trophy-line"></i>
                                                </div>
                                            </div>

                                            {{-- CONTENT --}}
                                            <div class="flex-grow-1 min-w-0">

                                                {{-- NAMA DAN BIAYA --}}
                                                <div class="d-flex justify-content-between align-items-start gap-2">
                                                    <div class="fw-semibold text-dark text-break">
                                                        {{ $item->nama_ekstrakurikuler }}
                                                    </div>

                                                    <div class="text-end flex-shrink-0">
                                                        <div class="fw-semibold text-dark small">
                                                            Rp{{ number_format($item->biaya, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- DESKRIPSI --}}
                                                @if ($item->deskripsi)
                                                    <p class="text-muted small mt-2 mb-3"
                                                        title="{{ $item->deskripsi }}">
                                                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}
                                                    </p>
                                                @endif

                                                {{-- INFORMASI PESERTA --}}
                                                <div class="d-flex flex-wrap gap-3 text-muted small mt-2">
                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="ri-group-line text-primary"></i>
                                                        <span>
                                                            {{ $item->total_peserta ?? 0 }} peserta
                                                        </span>
                                                    </div>

                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="ri-user-add-line text-success"></i>
                                                        <span>
                                                            Kuota {{ $item->kuota ?? 0 }}
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </label>

                            </div>
                        @endforeach

                    </div>

                    {{-- VALIDASI --}}
                    @error('ms_ekstrakurikuler_id')
                        <div class="text-danger small mt-2">
                            <i class="ri-error-warning-line me-1"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-0">

                    <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>
                        Tutup
                    </button>

                    <button type="submit"
                        class="btn btn-primary rounded-pill px-4"
                        wire:loading.attr="disabled"
                        wire:target="update">

                        <span wire:loading.remove wire:target="update">
                            <i class="ri-save-3-line me-1"></i>
                            Simpan
                        </span>

                        <span wire:loading wire:target="update">
                            <span class="spinner-border spinner-border-sm me-1"></span>
                            Menyimpan...
                        </span>
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>
