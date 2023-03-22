

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('category_name', 'Category Name') }}
    <!--{{ Form::select('category_name',array_merge(['0' => 'Please Select'], $categories),$selected,['class'=>'form-control border-input']) }}-->
    {{ Form::select('category_name',[null=>'Please Select'] + $categories,$selected,['class'=>'form-control border-input']) }}
    <span class="text-danger">{{ $errors->has('category_name') ? $errors->first('category_name') : '' }}</span>
</div>


<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('sub_category_name', 'Sub Category Name') }}
    {{ Form::text('name',$subcategory->name,['class'=>'form-control border-input','placeholder'=>'Macbook pro']) }}
    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description',$subcategory->description,['class'=>'form-control border-input','placeholder'=>'Description']) }}
    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
</div>

