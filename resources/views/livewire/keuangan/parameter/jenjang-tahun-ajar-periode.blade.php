
<div class="mt-3 mt-lg-0">
    <div class="row g-2 mb-0 align-items-center">

        {{-- JENJANG --}}
        <div class="col-sm-auto">
            <div class="input-group">
                <select
                    wire:model="selectedJenjang"
                    class="form-select border-0 dash-filter-picker shadow"
                    style="cursor: pointer"
                    data-bs-toggle="tooltip"
                    data-bs-trigger="hover"
                    data-bs-placement="top"
                    title="Pilih Jenjang"
                >
                    <option value="">Pilih Jenjang</option>

                    @foreach ($select_jenjang as $item)
                        <option value="{{ $item->ms_jenjang_id }}">
                            {{ $item->nama_jenjang }}
                        </option>
                    @endforeach
                </select>

                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-government-line"></i>
                </div>
            </div>
        </div>

        {{-- TAHUN AJARAN --}}
        <div class="col-sm-auto">
            <div class="input-group">
                <select
                    wire:model="selectedTahunAjar"
                    class="form-select border-0 dash-filter-picker shadow"
                    style="cursor: pointer"
                    data-bs-toggle="tooltip"
                    data-bs-trigger="hover"
                    data-bs-placement="top"
                    title="Pilih Tahun Ajaran"
                >
                    <option value="">Pilih Tahun Ajaran</option>

                    @foreach ($select_tahun_ajar as $item)
                        <option value="{{ $item->ms_tahun_ajar_id }}">
                            {{ $item->nama_tahun_ajar }}
                        </option>
                    @endforeach
                </select>

                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
        </div>

        {{-- PERIODE AKADEMIK --}}
        <div class="col-sm-auto">
            <div class="input-group">
                <select
                    wire:model="selectedPeriode"
                    class="form-select border-0 dash-filter-picker shadow"
                    style="cursor: pointer"
                    data-bs-toggle="tooltip"
                    data-bs-trigger="hover"
                    data-bs-placement="top"
                    title="Pilih Periode Akademik"
                    {{ !$selectedJenjang || !$selectedTahunAjar || $select_periode->isEmpty() ? 'disabled' : '' }}
                >
                    <option value="">Pilih Periode</option>

                    @foreach ($select_periode as $item)
                        <option value="{{ $item->ms_periode_akademik_id }}">
                            {{ $item->nama_periode }}
                        </option>
                    @endforeach
                </select>

                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-calendar-event-line"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- LOADING --}}
    {{-- <div
        wire:loading.delay
        wire:target="selectedJenjang, selectedTahunAjar, selectedPeriode"
        class="text-muted small mt-2"
    >
        <span class="spinner-border spinner-border-sm me-1"></span>
        Memperbarui parameter...
    </div> --}}

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.emit(
                'parameterUpdated',
                @json($selectedJenjang),
                @json($selectedTahunAjar),
                @json($selectedPeriode)
            );
        });
    </script>
</div>
