
<div wire:ignore.self class="modal fade" id="ModalDetailPertanyaan" tabindex="-1"
    aria-labelledby="ModalDetailPertanyaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- HEADER --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                            <i class="ri-questionnaire-line fs-18"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-1" id="ModalDetailPertanyaanLabel">
                            Detail Pertanyaan SPMB
                        </h5>
                        <small class="text-muted">
                            Informasi pertanyaan, jenis jawaban, dan ketentuan pengisian formulir pendataan.
                        </small>
                    </div>
                </div>

                <button type="button" class="btn btn-light btn-icon rounded-circle ms-auto"
                    data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="ri-close-line fs-18"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body px-4 pt-2 pb-4">

                @if ($pertanyaanDetail)

                    {{-- IDENTITAS PERTANYAAN --}}
                    <div class="text-center py-3 mb-3">
                        <div class="avatar-lg mx-auto mb-3">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-24">
                                <i class="ri-questionnaire-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2 text-break">
                            {{ filled($pertanyaanDetail->pertanyaan) ? $pertanyaanDetail->pertanyaan : 'Pertanyaan Tanpa Judul' }}
                        </h5>

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            @switch($pertanyaanDetail->jenis)
                                @case('teks')
                                    Jawaban Singkat
                                    @break

                                @case('textarea')
                                    Jawaban Panjang
                                    @break

                                @case('pilihan')
                                    Pilihan Jawaban
                                    @break

                                @case('ya_tidak')
                                    Ya / Tidak
                                    @break

                                @case('angka')
                                    Angka
                                    @break

                                @default
                                    {{ ucfirst(str_replace('_', ' ', $pertanyaanDetail->jenis ?? '-')) }}
                            @endswitch
                        </span>
                    </div>

                    {{-- INFORMASI PERTANYAAN --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                    <i class="ri-information-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Informasi Pertanyaan</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">Teks Pertanyaan</div>
                            <div class="fw-medium text-dark">
                                {{ filled($pertanyaanDetail->pertanyaan) ? $pertanyaanDetail->pertanyaan : '-' }}
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-muted small mb-1">Jenis Pertanyaan</div>
                                <div class="fw-medium text-dark">
                                    @switch($pertanyaanDetail->jenis)
                                        @case('teks')
                                            <i class="ri-text text-primary me-1"></i>
                                            Jawaban Singkat
                                            @break

                                        @case('textarea')
                                            <i class="ri-file-text-line text-primary me-1"></i>
                                            Jawaban Panjang
                                            @break

                                        @case('pilihan')
                                            <i class="ri-list-radio text-primary me-1"></i>
                                            Pilihan Jawaban
                                            @break

                                        @case('ya_tidak')
                                            <i class="ri-checkbox-circle-line text-primary me-1"></i>
                                            Ya / Tidak
                                            @break

                                        @case('angka')
                                            <i class="ri-hashtag text-primary me-1"></i>
                                            Angka
                                            @break

                                        @default
                                            {{ ucfirst(str_replace('_', ' ', $pertanyaanDetail->jenis ?? '-')) }}
                                    @endswitch
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="text-muted small mb-1">Urutan Pertanyaan</div>
                                <div class="fw-medium text-dark">
                                    {{ $pertanyaanDetail->urutan ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- OPSI JAWABAN --}}
                    @if ($pertanyaanDetail->jenis === 'pilihan')
                        <div class="border rounded-4 p-3 mb-3">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                        <i class="ri-list-check fs-18"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-0">Opsi Jawaban</h6>
                                    <small class="text-muted">
                                        Pilihan yang dapat dipilih calon siswa.
                                    </small>
                                </div>
                            </div>

                            @php
                                $opsiJawaban = $pertanyaanDetail->opsi_jawaban;

                                if (is_string($opsiJawaban)) {
                                    $opsiJawaban = json_decode($opsiJawaban, true);
                                }

                                $opsiJawaban = is_array($opsiJawaban)
                                    ? $opsiJawaban
                                    : [];
                            @endphp

                            @if (count($opsiJawaban))
                                <div class="border rounded-3 overflow-hidden">
                                    @foreach ($opsiJawaban as $index => $opsi)
                                        <div class="d-flex align-items-start gap-3 p-3 {{ !$loop->last ? 'border-bottom' : '' }}"
                                            wire:key="detail-opsi-{{ $pertanyaanDetail->ppdb_pertanyaan_id }}-{{ $index }}">

                                            <div class="avatar-xs flex-shrink-0">
                                                <div class="avatar-title bg-light text-primary rounded-circle">
                                                    <i class="ri-radio-button-line"></i>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1 text-break fw-medium">
                                                {{ $opsi }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-muted small py-3">
                                    <i class="ri-information-line me-1"></i>
                                    Belum ada opsi jawaban yang dikonfigurasi.
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- PENGATURAN PERTANYAAN --}}
                    <div class="border rounded-4 p-3 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                    <i class="ri-settings-3-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Pengaturan Pertanyaan</h6>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-muted small mb-1">Wajib Diisi</div>
                                @if ($pertanyaanDetail->wajib_diisi)
                                    <div class="fw-medium text-success">
                                        <i class="ri-checkbox-circle-line me-1"></i>
                                        Ya, wajib diisi
                                    </div>
                                @else
                                    <div class="fw-medium text-muted">
                                        <i class="ri-indeterminate-circle-line me-1"></i>
                                        Tidak wajib
                                    </div>
                                @endif
                            </div>

                            <div class="col-6">
                                <div class="text-muted small mb-1">Status Pertanyaan</div>
                                @if (strtolower((string) $pertanyaanDetail->status) === 'aktif')
                                    <div class="fw-medium text-success">
                                        <i class="ri-checkbox-circle-line me-1"></i>
                                        Aktif
                                    </div>
                                @else
                                    <div class="fw-medium text-muted">
                                        <i class="ri-close-circle-line me-1"></i>
                                        Nonaktif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- PERIODE SPMB --}}
                    <div class="border rounded-4 p-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar-xs">
                                <div class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                    <i class="ri-calendar-line"></i>
                                </div>
                            </div>
                            <h6 class="fw-semibold mb-0">Periode SPMB</h6>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-1">Nama Periode</div>
                            <div class="fw-medium text-dark text-break">
                                {{ $pertanyaanDetail->ppdb_periode?->nama_periode ?: '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-1">Jenjang Pendidikan</div>
                            <div class="fw-medium text-dark text-break">
                                <i class="ri-graduation-cap-line text-primary me-1"></i>
                                {{ $pertanyaanDetail->ppdb_periode?->ms_jenjang?->nama_jenjang ?: '-' }}
                            </div>
                        </div>
                    </div>

                @else

                    {{-- EMPTY STATE --}}
                    <div class="text-center py-5 px-3">
                        <div class="avatar-md mx-auto mb-3">
                            <div class="avatar-title bg-light text-muted rounded-circle fs-24">
                                <i class="ri-questionnaire-line"></i>
                            </div>
                        </div>

                        <h5 class="fw-semibold mb-1">
                            Data Pertanyaan Tidak Ditemukan
                        </h5>

                        <p class="text-muted small mb-0">
                            Pertanyaan yang dipilih tidak tersedia atau telah dihapus.
                        </p>
                    </div>

                @endif

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
