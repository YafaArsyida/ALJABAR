@extends('template_akademik.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            @livewire('keuangan.parameter.informasi-tahun-ajar', ['heading' => 'Penempatan Ekstrakurikuler'])

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
            <!--end col-->
            <div class="col-xxl-5">
                <div class="sticky-side-div">
                    @livewire('akademik.penempatan-ekstrakurikuler.ekstrakurikuler.index')
                </div>
                @livewire('akademik.penempatan-ekstrakurikuler.ekstrakurikuler.detail')
                @livewire('akademik.ekstrakurikuler.create')   
                @livewire('akademik.ekstrakurikuler.edit')   
            </div>
            <div class="col-xxl-7">
                @livewire('akademik.penempatan-ekstrakurikuler.siswa.index')
                @livewire('akademik.penempatan-ekstrakurikuler.siswa.detail')
                @livewire('akademik.penempatan-ekstrakurikuler.siswa.edit')
            </div>
        </div>        
    </div>
</div>
@endsection
