{!! Form::model($product, [
        'id'    => 'modal-form',
        'files' => true,
        'route' => $product->exists ? ['products.update', $product->id] : 'products.store',
        'method'=> $product->exists ? 'PUT' : 'POST',
    ]) !!}

    <div class="form-group">
        <label class="control-label">Nama</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required'=> '', 'data-parsley-minlength' => '3']) !!}
    </div>

    <div class="form-group">
        <label class="control-label">Supplier</label>
        {{ Form::select('supplier_id', $suppliers, null, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) }}
    </div>

    <div class="form-group">
        <label class="control-label">Harga Jual</label>
        {!! Form::number('price', null, ['class' => 'form-control', 'id' => 'price', 'required'=> '']) !!}
    </div>

    <div class="form-group">
        {!! Form::checkbox('status', null, $product->status) !!}
        <label class="control-label"> Aktif</label>
    </div>

    <div class="form-group">
        <label class="control-label">Gambar</label>
        {!! Form::file('image', ['onchange' => 'readURL(this);']) !!}
    </div>
    <div class="form-group">
        <img 
            id="image-preview"
            src="{{$product->getImageURL()}}" 
            alt="{{$product->name}}"  
            class="img-thumbnail"
            width="200"
        >
    </div>


{!! Form::close() !!}
