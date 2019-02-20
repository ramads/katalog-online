@if(isset($delete_url))
    {!! Form::model($model, ['url' => $delete_url, 'method' => 'delete', 'class' => 'form-inline form-delete', 'data-confirm' => $confirm_message] ) !!}
    @if (isset($show_url))
        <a href="{{ $show_url }}" class="btn btn-xs btn-primary {{ isset($modal_show) ? $modal_show:'' }}"><i class="glyphicon glyphicon-info-sign"></i></a>
    @endif
    @if (isset($edit_url))
        <a href="{{ $edit_url }}" class="btn btn-xs btn-info {{ isset($modal_edit) ? $modal_edit:'' }}" title="Edit {{isset($item_name) ? $item_name : 'Data'}}">Edit</i></a>
    @endif
    {!! Form::button('Hapus', ['type' => 'button', 'class' => 'btn btn-xs btn-danger '. (isset($deleteClass) ? $deleteClass: 'delete-data')] )  !!}
    {!! Form::close()!!}
@else
    @if (isset($show_url))
        <a href="{{ $show_url }}" class="btn btn-xs btn-primary {{ isset($modal_show) ? $modal_show:'' }}"><i class="glyphicon glyphicon-info-sign"></i></a>
    @endif
    @if (isset($edit_url))
        <a href="{{ $edit_url }}" class="btn btn-xs btn-info {{ isset($modal_edit) ? $modal_edit:'' }}" title="Edit {{isset($item_name) ? $item_name : 'Data'}}">Edit</i></a>
    @endif
@endif
