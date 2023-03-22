
<div class="form-group {{ $errors->has('label_name') ? 'has-error' : '' }}">
    {{ Form::label('label_name', 'Label') }}
    {{ Form::text('label_name',$productInfo->label_name,['class'=>'form-control border-input','placeholder'=>'Macbook pro','required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('label_name') ? $errors->first('label_name') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('label_value') ? 'has-error' : '' }}">
    {{ Form::label('label_value', 'Value') }}
    {{ Form::text('label_value',$productInfo->label_value,['class'=>'form-control border-input','placeholder'=>'Macbook pro','required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('label_value') ? $errors->first('label_value') : '' }}</span>
</div>

