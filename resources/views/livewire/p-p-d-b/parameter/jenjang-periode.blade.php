<div class="mt-3 mt-lg-0">
    <div class="row g-2">
        <div class="col-sm-auto">
            <div class="input-group">
                <select
                    wire:model="selectedJenjang"
                    class="form-select border-0 dash-filter-picker shadow"
                    title="Pilih Jenjang"
                >
                    <option value="">Pilih Jenjang</option>
                    @foreach ($select_jenjang as $item)
                        <option value="{{ $item->ms_jenjang_id }}">{{ $item->nama_jenjang }}</option>
                    @endforeach
                </select>
                <div class="input-group-text bg-primary border-primary text-white">
                    <i class="ri-government-line"></i>
                </div>
            </div>
        </div>

        @if ($selectedJenjang)
            <div class="col-sm-auto">
                <div class="input-group">
                    <select
                        wire:model="selectedPeriode"
                        class="form-select border-0 dash-filter-picker shadow"
                        title="Pilih Periode"
                    >
                        <option value="">
                            {{ $select_periode->isEmpty() ? 'Belum ada periode' : 'Pilih Periode' }}
                        </option>
                        @foreach ($select_periode as $item)
                            <option value="{{ $item->ppdb_periode_id }}">
                                {{ $item->nama_periode }} ({{ ucfirst($item->status) }})
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-text bg-primary border-primary text-white">
                        <i class="ri-calendar-event-line"></i>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-auto d-flex align-items-center">
                <small class="text-muted">Pilih jenjang untuk menampilkan periode.</small>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.emit(
                'dashboardParametersUpdated',
                @json($selectedJenjang),
                @json($selectedPeriode)
            );
        });
    </script>
</div>
