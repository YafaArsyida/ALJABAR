@extends('template_akademik.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            @livewire('keuangan.parameter.informasi-tahun-ajar', ['heading' => 'Penempatan Siswa'])

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
            <div class="col-xxl-4">
                <div class="sticky-side-div">
                    @livewire('akademik.penempatan-siswa.kelas.index')   
                </div>
                @livewire('akademik.penempatan-siswa.kelas.change')   
                @livewire('akademik.penempatan-siswa.kelas.promote')   
                @livewire('akademik.penempatan-siswa.kelas.detail')   
                @livewire('akademik.kelas.create')    
            </div>
            <div class="col-xxl-8">
                @livewire('akademik.penempatan-siswa.siswa.index')    
                @livewire('akademik.siswa.detail')    
                @livewire('akademik.siswa.create')    
                @livewire('akademik.siswa.edit')    
                @livewire('akademik.siswa.delete')

                @livewire('akademik.siswa.import')
                @livewire('akademik.siswa.import-telepon')    
                @livewire('akademik.siswa.import-edu-card')  
            </div>
        </div>        
    </div>
</div>
@endsection
