{!! Form::model($supplier, [
        'id'    => 'modal-form',
        'route' => $supplier->exists ? ['suppliers.update', $supplier->id] : 'suppliers.store',
        'method'=> $supplier->exists ? 'PUT' : 'POST',
    ]) !!}

    <div class="form-group">
        <label class="control-label">Nama:</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required'=> '', 'data-parsley-minlength' => '3']) !!}
    </div>

    <div class="form-group">
        <label class="control-label">Email:</label>
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'name', 'required'=> '', 'data-parsley-type' => 'email']) !!}
    </div>
    <div class="form-group">
        <label class="control-label">Kota Asal:</label>
        {{ Form::select('city_id', $cities, null, ['class' => 'form-control', 'placeholder' => '--Pilih--', 'required' => '']) }}
    </div>

    <div class="form-group">
        <label class="control-label">Tahun Kelahiran:</label>
        {{ Form::select('birth_year', $years, null, ['class' => 'form-control', 'placeholder' => '--Pilih--', 'required' => '']) }}
    </div>
{!! Form::close() !!}
