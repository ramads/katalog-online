@extends('layouts.app')

@section('css')
    @include('datatable.css')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="padding-bottom: 20px;">
                Data Supplier
                <a href="{{ route('suppliers.create') }}" class="btn btn-success btn-sm pull-right show-modal" title="Tambah Supplier" style="margin-bottom: 10px">Tambah</a>
            </div>

            <div class="panel-body">
                {!! $html->table(['class'=>'table table-striped table-bordered table-condensed dt-responsive nowrap', 'cellspacing' => "0", 'width' => "100%"]) !!}
            </div>
        </div>
    </div>
</div>

@include('commons.modal')
@endsection

@section('js')
    @include('datatable.js')
@endsection
@section('scripts')
    {!! $html->scripts() !!}
@endsection