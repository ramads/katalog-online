@extends('layouts.app')

@section('css')
    @include('datatable.css')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="padding-bottom: 20px;">
                Data Produk
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm pull-right show-modal" title="Tambah Produk" style="margin-bottom: 10px">Tambah</a>
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

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-preview')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection