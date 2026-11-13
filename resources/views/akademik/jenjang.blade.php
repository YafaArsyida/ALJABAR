@extends('template_akademik.v_template')
@section('content')

@php
    $title = "Jenjang"
@endphp
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <!-- end page title -->
        <div class="row">
            {{-- JENJANG --}}
            <div class="col-xxl-8">
                @livewire('akademik.jenjang.create')
                @livewire('akademik.jenjang.index')   
                @livewire('akademik.jenjang.edit')  
                @livewire('akademik.jenjang.delete')  
            </div>
            <!--end col-->
        </div>        
    </div>
</div>
@endsection

