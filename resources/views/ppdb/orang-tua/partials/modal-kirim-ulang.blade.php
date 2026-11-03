@if ($status === 'perbaikan')
    <div
        wire:ignore.self
        class="modal fade"
        id="modalKirimUlang"
        tabindex="-1"
        aria-labelledby="modalKirimUlangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 pb-0">
                    <button
                        type="button"
                        class="btn btn-light btn-icon rounded-circle ms-auto"
                        data-bs-dismiss="modal"
                        aria-label="Tutup">
                        <i class="ri-close-line fs-18"></i>
                    </button>
                </div>

                <div class="modal-body px-4 pb-4 pt-2 text-center">
                    <div class="mb-4">
                        <div class="avatar-xl mx-auto">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                <lord-icon
                                    src="https://cdn.lordicon.com/sbnjyzil.json"
                                    trigger="loop"
                                    colors="primary:#0d6efd,secondary:#0d6efd"
                                    style="width:70px;height:70px">
                                </lord-icon>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                            Konfirmasi Perbaikan
                        </span>

                        <h3 class="fw-bold mb-2" id="modalKirimUlangLabel">
                            Kirim Ulang Data SPMB?
                        </h3>

                        <p class="text-muted mb-0 lh-lg px-lg-2">
                            Pastikan seluruh data yang diminta panitia telah
                            diperbaiki. Setelah dikirim, data SPMB Anda akan
                            diperiksa kembali oleh panitia.
                        </p>
                    </div>

                    <div class="alert alert-light border rounded-4 text-start mt-4 mb-0">
                        <div class="d-flex align-items-start gap-3">
                            <div class="flex-shrink-0">
                                <i class="ri-information-line text-primary fs-20"></i>
                            </div>

                            <div>
                                <h6 class="fw-semibold mb-1">Sebelum Mengirim</h6>
                                <p class="text-muted mb-0 fs-13">
                                    Pastikan perbaikan sudah selesai dan data
                                    yang diperbarui sudah benar. Setelah dikirim,
                                    status pendataan akan berubah menjadi terdaftar.
                                    Anda dapat memantau hasil pemeriksaan melalui
                                    halaman status SPMB.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 px-4 pb-4 justify-content-center">
                    <button
                        type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                        <i class="ri-arrow-go-back-line me-1"></i>
                        Periksa Kembali
                    </button>

                    <form
                        action="{{ route('ppdb.pendaftaran.kirim-ulang', [
                            'jenjang' => $pendaftaran->ppdb_periode->ms_jenjang->slug,
                            'ppdb_pendaftaran_id' => $pendaftaran->ppdb_pendaftaran_id,
                        ]) }}"
                        method="POST">
                        @csrf

                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="ri-send-plane-line me-1"></i>
                            Ya, Kirim Ulang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
