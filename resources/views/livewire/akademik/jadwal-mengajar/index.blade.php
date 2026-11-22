
<div>
    {{-- FILTER JADWAL MENGAJAR --}}
    <div class="col-xxl-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
            {{-- HEADER --}}
            <div class="card-header border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">

                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                            <i class="ri-calendar-line"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Pengaturan Jadwal Mengajar
                        </h5>
                        <small class="text-muted">
                            Atur tampilan dan cakupan jadwal mengajar berdasarkan kelas maupun guru.
                        </small>
                    </div>

                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body p-3 p-lg-4">

                {{-- MODE TAMPILAN --}}
                <div class="bg-white border-bottom px-2 px-md-4 py-3 mb-3">
                    <ul class="nav nav-pills nav-justified gap-1 flex-wrap mb-0"
                        id="tabModeJadwal"
                        role="tablist">

                        <li class="nav-item" role="presentation">
                            <button
                                type="button"
                                class="nav-link rounded-pill {{ $modeTampilan === 'kelas' ? 'active' : '' }}"
                                id="tab-mode-kelas"
                                role="tab"
                                aria-selected="{{ $modeTampilan === 'kelas' ? 'true' : 'false' }}"
                                wire:click="setModeTampilan('kelas')">
                                <i class="ri-building-line me-1"></i>
                                Per Kelas
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button
                                type="button"
                                class="nav-link rounded-pill {{ $modeTampilan === 'guru' ? 'active' : '' }}"
                                id="tab-mode-guru"
                                role="tab"
                                aria-selected="{{ $modeTampilan === 'guru' ? 'true' : 'false' }}"
                                wire:click="setModeTampilan('guru')">
                                <i class="ri-user-line me-1"></i>
                                Per Guru
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button
                                type="button"
                                class="nav-link rounded-pill {{ $modeTampilan === 'semua' ? 'active' : '' }}"
                                id="tab-mode-semua"
                                role="tab"
                                aria-selected="{{ $modeTampilan === 'semua' ? 'true' : 'false' }}"
                                wire:click="setModeTampilan('semua')">
                                <i class="ri-layout-grid-line me-1"></i>
                                Seluruh Sekolah
                            </button>
                        </li>

                    </ul>
                </div>

                {{-- FILTER UTAMA --}}
                <div class="row g-3 align-items-end">

                    {{-- FILTER KELAS --}}
                    @if ($modeTampilan === 'kelas')
                        <div class="col-xl-3 col-md-6">
                            <label class="form-label small text-muted text-uppercase fw-medium mb-2">
                                Kelas
                            </label>

                            <select wire:model="selectedKelas" class="form-select">
                                <option value="">Pilih Kelas</option>
                                <option value="1A">Kelas 1A</option>
                                <option value="1B">Kelas 1B</option>
                                <option value="2A">Kelas 2A</option>
                                <option value="2B">Kelas 2B</option>
                            </select>
                        </div>

                    {{-- FILTER GURU --}}
                    @elseif ($modeTampilan === 'guru')
                        <div class="col-xl-3 col-md-6">
                            <label class="form-label small text-muted text-uppercase fw-medium mb-2">
                                Guru
                            </label>

                            <select wire:model="selectedGuru" class="form-select">
                                <option value="">Pilih Guru</option>
                                <option value="1">Ahmad Fauzi, S.Pd.</option>
                                <option value="2">Siti Aminah, S.Pd.</option>
                                <option value="3">Budi Santoso, S.Pd.</option>
                            </select>
                        </div>
                    @endif

                    {{-- PENCARIAN --}}
                    <div class="{{ $modeTampilan === 'semua' ? 'col-xl-9' : 'col-xl-6' }} col-md-8">
                        <label for="searchJadwal"
                            class="form-label small text-muted text-uppercase fw-medium mb-2">
                            Pencarian
                        </label>

                        <div class="search-box">
                            <input
                                type="text"
                                id="searchJadwal"
                                class="form-control search"
                                wire:model.debounce.300ms="search"
                                placeholder="Cari nama guru, kelas, atau mata pelajaran...">

                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>

                    {{-- RESET --}}
                    <div class="col-xl-3 col-md-4">
                        <button
                            type="button"
                            wire:click="resetFilter"
                            class="btn btn-soft-secondary w-100">
                            <i class="ri-refresh-line me-1"></i>
                            Reset Filter
                        </button>
                    </div>

                </div>

                {{-- NAVIGASI HARI --}}
                <div class="border-top pt-3 mt-3">
                    <div class="d-flex flex-column align-items-center gap-3">

                        {{-- JUDUL --}}
                        <div class="text-center">
                            <h6 class="fw-semibold text-dark mb-1">
                                Jadwal Mingguan
                            </h6>
                            <p class="text-muted small mb-0">
                                Pilih hari untuk melihat jadwal mengajar
                            </p>
                        </div>

                        {{-- PILIHAN HARI --}}
                        <div class="w-100">
                            <ul class="nav nav-pills nav-justified gap-1 flex-wrap mb-0"
                                id="tabHariJadwal"
                                role="tablist">

                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <li class="nav-item" role="presentation">
                                        <button
                                            type="button"
                                            class="nav-link rounded-pill {{ $selectedHari === $hari ? 'active' : '' }}"
                                            id="tab-hari-{{ strtolower($hari) }}"
                                            role="tab"
                                            aria-selected="{{ $selectedHari === $hari ? 'true' : 'false' }}"
                                            wire:click="setHari('{{ $hari }}')">
                                            {{ $hari }}
                                        </button>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- KALENDER JADWAL MENGAJAR --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

            {{-- HEADER --}}
            <div class="card-header bg-white border-bottom py-3 px-3 px-lg-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                                <i class="ri-calendar-schedule-line"></i>
                            </div>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                Jadwal Mengajar
                            </h5>
                            <p class="text-muted small mb-0">
                                Kalender kegiatan pembelajaran berdasarkan filter terpilih.
                            </p>
                        </div>
                    </div>

                    {{-- INFORMASI FILTER AKTIF --}}
                    <div class="d-flex flex-wrap align-items-center gap-2">

                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            @if ($modeTampilan === 'kelas')
                                <i class="ri-building-line me-1"></i>
                                Per Kelas
                            @elseif ($modeTampilan === 'guru')
                                <i class="ri-user-line me-1"></i>
                                Per Guru
                            @else
                                <i class="ri-layout-grid-line me-1"></i>
                                Seluruh Sekolah
                            @endif
                        </span>

                        <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                            <i class="ri-calendar-line me-1"></i>
                            {{ $selectedHari }}
                        </span>

                    </div>

                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body p-3 p-lg-4">

                {{-- RINGKASAN KALENDER --}}
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">

                    <div>
                        <h6 class="fw-semibold text-dark mb-1">
                            Agenda Pembelajaran
                        </h6>
                        <p class="text-muted small mb-0">
                            Klik salah satu jadwal untuk melihat informasi lengkap.
                        </p>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-2 text-muted small">
                            <i class="ri-drag-move-2-line"></i>
                            <span>Geser untuk mengubah jadwal</span>
                        </div>
                    </div>

                </div>

                {{-- KALENDER --}}
                <div wire:ignore>
                    <div id="jadwal-mengajar-calendar"></div>
                </div>

                {{-- KETERANGAN --}}
                <div class="border-top pt-3 mt-3">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">

                        <div class="d-flex align-items-center gap-2 text-muted small">
                            <i class="ri-information-line fs-16"></i>
                            <span>
                                Perubahan jadwal akan divalidasi terhadap bentrok kelas dan guru.
                            </span>
                        </div>

                        <div class="text-muted small">
                            <i class="ri-time-line me-1"></i>
                            Waktu mengikuti jadwal mengajar
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>


    {{-- MODAL DETAIL JADWAL --}}
    <div class="modal fade"
        id="ModalDetailJadwal"
        tabindex="-1"
        aria-labelledby="ModalDetailJadwalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="modal-header bg-primary-subtle border-0 p-3 p-lg-4">

                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title rounded-3 bg-primary text-white">
                                <i class="ri-calendar-event-line fs-4"></i>
                            </span>
                        </div>

                        <div>
                            <h5 class="modal-title fw-bold mb-1"
                                id="ModalDetailJadwalLabel">
                                Detail Jadwal Mengajar
                            </h5>

                            <p class="text-muted small mb-0">
                                Informasi lengkap kegiatan pembelajaran
                            </p>
                        </div>
                    </div>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                {{-- BODY --}}
                <div class="modal-body p-3 p-lg-4">

                    {{-- MAPEL --}}
                    <div class="mb-4">
                        <div class="text-muted small text-uppercase fw-medium mb-2">
                            Mata Pelajaran
                        </div>

                        <h5 class="fw-bold text-dark mb-0" id="detail-mapel">
                            -
                        </h5>
                    </div>

                    {{-- INFORMASI JADWAL --}}
                    <div class="bg-light rounded-3 p-3">

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="avatar-xs flex-shrink-0">
                                <span class="avatar-title bg-white text-primary rounded-2">
                                    <i class="ri-community-line"></i>
                                </span>
                            </div>

                            <div class="flex-grow-1">
                                <div class="text-muted small mb-1">Kelas</div>
                                <div class="fw-medium text-dark" id="detail-kelas">-</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="avatar-xs flex-shrink-0">
                                <span class="avatar-title bg-white text-primary rounded-2">
                                    <i class="ri-user-line"></i>
                                </span>
                            </div>

                            <div class="flex-grow-1">
                                <div class="text-muted small mb-1">Guru Pengajar</div>
                                <div class="fw-medium text-dark" id="detail-guru">-</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="avatar-xs flex-shrink-0">
                                <span class="avatar-title bg-white text-primary rounded-2">
                                    <i class="ri-calendar-line"></i>
                                </span>
                            </div>

                            <div class="flex-grow-1">
                                <div class="text-muted small mb-1">Hari dan Tanggal</div>
                                <div class="fw-medium text-dark" id="detail-tanggal">-</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3">
                            <div class="avatar-xs flex-shrink-0">
                                <span class="avatar-title bg-white text-primary rounded-2">
                                    <i class="ri-time-line"></i>
                                </span>
                            </div>

                            <div class="flex-grow-1">
                                <div class="text-muted small mb-1">Waktu Mengajar</div>
                                <div class="fw-medium text-dark" id="detail-waktu">-</div>
                            </div>
                        </div>

                    </div>

                    {{-- STATUS --}}
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <span class="text-muted small">Status Jadwal</span>
                        <span class="badge bg-success-subtle text-success rounded-pill"
                            id="detail-status">
                            Aktif
                        </span>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer border-top p-3">

                    <button type="button"
                        class="btn btn-light rounded-pill px-3"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>

                    <button type="button"
                        class="btn btn-primary rounded-pill px-3"
                        id="btnUbahJadwal">
                        <i class="ri-edit-line me-1"></i>
                        Ubah Jadwal
                    </button>

                </div>

            </div>
        </div>
    </div>


    {{-- STYLE --}}
    <style>              
        /* ==========================================
        FULLCALENDAR - TEMANSEKOLAH VELZON MODERN
        ========================================== */

        #jadwal-mengajar-calendar {
            min-height: 500px;
        }

        #jadwal-mengajar-calendar .fc {
            font-family: inherit;
            color: var(--vz-body-color);
            font-size: 13px;
        }

        /* Toolbar */
        #jadwal-mengajar-calendar .fc .fc-toolbar {
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }

        #jadwal-mengajar-calendar .fc .fc-toolbar-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--vz-heading-color);
        }

        /* Button */
        #jadwal-mengajar-calendar .fc .fc-button {
            box-shadow: none !important;
            text-transform: capitalize;
            font-size: 12px;
            font-weight: 500;
            border-radius: 6px;
            padding: 6px 12px;
        }

        #jadwal-mengajar-calendar .fc .fc-button-primary {
            background-color: var(--vz-primary);
            border-color: var(--vz-primary);
        }

        #jadwal-mengajar-calendar .fc .fc-button-primary:hover {
            opacity: .9;
        }

        #jadwal-mengajar-calendar .fc .fc-button-primary:disabled {
            opacity: .5;
        }

        #jadwal-mengajar-calendar .fc .fc-button-primary:not(:disabled).fc-button-active,
        #jadwal-mengajar-calendar .fc .fc-button-primary:not(:disabled):active {
            background-color: var(--vz-primary);
            border-color: var(--vz-primary);
        }

        /* Table */
        #jadwal-mengajar-calendar .fc .fc-scrollgrid {
            border-color: var(--vz-border-color);
            border-radius: 8px;
            overflow: hidden;
        }

        #jadwal-mengajar-calendar .fc .fc-scrollgrid td,
        #jadwal-mengajar-calendar .fc .fc-scrollgrid th {
            border-color: var(--vz-border-color);
        }

        /* Header */
        #jadwal-mengajar-calendar .fc .fc-col-header-cell {
            background-color: var(--vz-light);
        }

        #jadwal-mengajar-calendar .fc .fc-col-header-cell-cushion {
            color: var(--vz-heading-color);
            font-weight: 600;
            font-size: 12px;
            padding: 12px 6px;
            text-decoration: none;
        }

        /* Time axis */
        #jadwal-mengajar-calendar .fc .fc-timegrid-axis-cushion {
            color: var(--vz-secondary-color);
            font-size: 11px;
        }

        #jadwal-mengajar-calendar .fc .fc-timegrid-slot {
            height: 42px;
        }

        #jadwal-mengajar-calendar .fc .fc-timegrid-slot-label {
            font-size: 11px;
        }

        /* Event */
        #jadwal-mengajar-calendar .fc .fc-event {
            border: 0;
            border-radius: 6px;
            padding: 4px 6px;
            cursor: pointer;
            font-size: 11px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
        }

        #jadwal-mengajar-calendar .fc .fc-event-main {
            padding: 1px;
        }

        #jadwal-mengajar-calendar .fc .fc-event:active {
            cursor: grabbing;
        }

        /* Today */
        #jadwal-mengajar-calendar .fc .fc-day-today {
            background-color: rgba(var(--vz-primary-rgb), .035) !important;
        }

        /* Now indicator */
        #jadwal-mengajar-calendar .fc .fc-timegrid-now-indicator-line {
            border-color: var(--vz-danger);
        }

        /* List view */
        #jadwal-mengajar-calendar .fc .fc-list {
            border-color: var(--vz-border-color);
            border-radius: 8px;
            overflow: hidden;
        }

        #jadwal-mengajar-calendar .fc .fc-list-day-cushion {
            background-color: var(--vz-light);
        }

        #jadwal-mengajar-calendar .fc .fc-list-event:hover td {
            background-color: var(--vz-light);
        }

        /* Mobile */
        @media (max-width: 767.98px) {

            #jadwal-mengajar-calendar {
                min-height: 450px;
            }

            #jadwal-mengajar-calendar .fc .fc-toolbar {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            #jadwal-mengajar-calendar .fc .fc-toolbar-chunk {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 5px;
            }

            #jadwal-mengajar-calendar .fc .fc-toolbar-title {
                font-size: 14px;
            }

            #jadwal-mengajar-calendar .fc .fc-button {
                font-size: 11px;
                padding: 5px 9px;
            }

        }

    </style>

    {{-- FULLCALENDAR INITIALIZATION --}}
    <script>
        document.addEventListener('livewire:load', function () {
            initJadwalMengajarCalendar();
        });

        function initJadwalMengajarCalendar() {
            const calendarEl = document.getElementById('jadwal-mengajar-calendar');

            if (!calendarEl || calendarEl.dataset.initialized === 'true') {
                return;
            }

            if (typeof FullCalendar === 'undefined') {
                console.error('FullCalendar belum dimuat.');
                return;
            }

            calendarEl.dataset.initialized = 'true';

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',

                locale: 'id',
                firstDay: 1,

                height: 'auto',
                expandRows: true,
                nowIndicator: true,

                slotMinTime: '06:30:00',
                slotMaxTime: '15:30:00',
                slotDuration: '00:30:00',
                allDaySlot: false,

                editable: true,
                eventStartEditable: true,
                eventDurationEditable: true,

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,listDay'
                },

                buttonText: {
                    today: 'Hari Ini',
                    day: 'Jadwal',
                    list: 'Agenda'
                },

                dayHeaderFormat: {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                },

                events: [
                    {
                        title: 'Matematika - 1A',
                        start: '2026-11-16T07:00:00',
                        end: '2026-11-16T08:00:00',
                        backgroundColor: '#405189',
                        extendedProps: {
                            mapel: 'Matematika',
                            kelas: 'Kelas 1A',
                            guru: 'Ahmad Fauzi, S.Pd.'
                        }
                    },
                    {
                        title: 'Bahasa Indonesia - 1B',
                        start: '2026-11-16T08:00:00',
                        end: '2026-11-16T09:00:00',
                        backgroundColor: '#0ab39c',
                        extendedProps: {
                            mapel: 'Bahasa Indonesia',
                            kelas: 'Kelas 1B',
                            guru: 'Siti Aminah, S.Pd.'
                        }
                    },
                    {
                        title: 'IPA - 2A',
                        start: '2026-11-16T09:00:00',
                        end: '2026-11-16T10:00:00',
                        backgroundColor: '#299cdb',
                        extendedProps: {
                            mapel: 'IPA',
                            kelas: 'Kelas 2A',
                            guru: 'Budi Santoso, S.Pd.'
                        }
                    },
                    {
                        title: 'PJOK - 1A',
                        start: '2026-11-17T07:00:00',
                        end: '2026-11-17T08:00:00',
                        backgroundColor: '#f7b84b',
                        extendedProps: {
                            mapel: 'PJOK',
                            kelas: 'Kelas 1A',
                            guru: 'Budi Santoso, S.Pd.'
                        }
                    },
                    {
                        title: 'Matematika - 2A',
                        start: '2026-11-17T08:00:00',
                        end: '2026-11-17T09:30:00',
                        backgroundColor: '#405189',
                        extendedProps: {
                            mapel: 'Matematika',
                            kelas: 'Kelas 2A',
                            guru: 'Ahmad Fauzi, S.Pd.'
                        }
                    },
                    {
                        title: 'Bahasa Indonesia - 1A',
                        start: '2026-11-18T07:30:00',
                        end: '2026-11-18T08:30:00',
                        backgroundColor: '#0ab39c',
                        extendedProps: {
                            mapel: 'Bahasa Indonesia',
                            kelas: 'Kelas 1A',
                            guru: 'Siti Aminah, S.Pd.'
                        }
                    },
                    {
                        title: 'IPA - 1B',
                        start: '2026-11-18T09:00:00',
                        end: '2026-11-18T10:00:00',
                        backgroundColor: '#299cdb',
                        extendedProps: {
                            mapel: 'IPA',
                            kelas: 'Kelas 1B',
                            guru: 'Budi Santoso, S.Pd.'
                        }
                    },
                    {
                        title: 'Matematika - 1B',
                        start: '2026-11-19T07:00:00',
                        end: '2026-11-19T08:00:00',
                        backgroundColor: '#405189',
                        extendedProps: {
                            mapel: 'Matematika',
                            kelas: 'Kelas 1B',
                            guru: 'Ahmad Fauzi, S.Pd.'
                        }
                    },
                    {
                        title: 'Bahasa Indonesia - 2A',
                        start: '2026-11-19T08:00:00',
                        end: '2026-11-19T09:00:00',
                        backgroundColor: '#0ab39c',
                        extendedProps: {
                            mapel: 'Bahasa Indonesia',
                            kelas: 'Kelas 2A',
                            guru: 'Siti Aminah, S.Pd.'
                        }
                    },
                    {
                        title: 'IPA - 1A',
                        start: '2026-11-20T07:00:00',
                        end: '2026-11-20T08:00:00',
                        backgroundColor: '#299cdb',
                        extendedProps: {
                            mapel: 'IPA',
                            kelas: 'Kelas 1A',
                            guru: 'Budi Santoso, S.Pd.'
                        }
                    }
                ],

                eventClick: function (info) {
                    const event = info.event;
                    const props = event.extendedProps;

                    document.getElementById('detail-mapel').textContent = props.mapel || event.title;
                    document.getElementById('detail-kelas').textContent = props.kelas || '-';
                    document.getElementById('detail-guru').textContent = props.guru || '-';

                    document.getElementById('detail-tanggal').textContent =
                        event.start.toLocaleDateString('id-ID', {
                            weekday: 'long',
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                    document.getElementById('detail-waktu').textContent =
                        event.start.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        }) + ' - ' +
                        event.end.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                    const modal = new bootstrap.Modal(
                        document.getElementById('ModalDetailJadwal')
                    );

                    modal.show();
                },

                eventDrop: function (info) {
                    const event = info.event;

                    // DEMO: perubahan hanya terjadi di tampilan kalender.
                    // Nantinya hubungkan dengan proses update Livewire.
                    if (typeof alertify !== 'undefined') {
                        alertify.success(
                            'Jadwal dipindahkan ke ' +
                            event.start.toLocaleString('id-ID')
                        );
                    }

                    console.log('Jadwal dipindahkan:', {
                        id: event.id,
                        start: event.start,
                        end: event.end
                    });
                },

                eventResize: function (info) {
                    if (typeof alertify !== 'undefined') {
                        alertify.success('Durasi jadwal berhasil diubah (simulasi).');
                    }

                    console.log('Durasi jadwal diubah:', {
                        start: info.event.start,
                        end: info.event.end
                    });
                },

                select: function (info) {
                    console.log('Slot jadwal dipilih:', {
                        start: info.start,
                        end: info.end
                    });

                    calendar.unselect();
                }
            });

            calendar.render();
        }
    </script>
</div>
