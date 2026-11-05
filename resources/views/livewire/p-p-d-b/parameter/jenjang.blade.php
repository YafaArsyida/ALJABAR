<div class="mt-3 mt-lg-0">
    <div class="input-group">
        <select
            wire:model="selectedJenjang"
            class="form-select border-0 dash-filter-picker shadow"
            title="Pilih Jenjang"
        >
            @foreach ($select_jenjang as $item)
                <option value="{{ $item->ms_jenjang_id }}">{{ $item->nama_jenjang }}</option>
            @endforeach
        </select>
        <div class="input-group-text bg-primary border-primary text-white">
            <i class="ri-government-line"></i>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.emit('parameterUpdated', @json($selectedJenjang));
        });
    </script>
</div>
