@extends('template_akademik.v_template')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-10">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            @livewire('keuangan.parameter.informasi-tahun-ajar', ['heading' => 'Periode Akademik'])

                            {{-- PARAMETER --}}
                            <div>
                                @livewire('keuangan.parameter.jenjang-tahun-ajar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-10">
                @livewire('akademik.periode-akademik.index')
                @livewire('akademik.periode-akademik.create')
                @livewire('akademik.periode-akademik.edit')
                @livewire('akademik.periode-akademik.delete')
            </div>
        </div>
    </div>
</div>
@endsection
