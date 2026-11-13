@extends('template_akademik.v_template')
@section('content')

@php
    $title = "Jenjang"
@endphp
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-10">
                @livewire('akademik.tahun-ajaran.create')
                @livewire('akademik.tahun-ajaran.index')   
                @livewire('akademik.tahun-ajaran.edit')  
                @livewire('akademik.tahun-ajaran.delete')  
            </div>
            <!--end col-->
        </div>        
    </div>
</div>
@endsection

