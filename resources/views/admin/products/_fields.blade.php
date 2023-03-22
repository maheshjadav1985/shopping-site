<style>
        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        } 
    </style>

<div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
    {{ Form::label('category_name', 'Category Name') }}
    {{ Form::select('category_name',[null=>'Please Select'] + $categories,$selected,['class'=>'form-control border-input','id'=>'category','required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('category_name') ? $errors->first('category_name') : '' }}</span>
</div>

<!--<div class="form-group {{ $errors->has('sub_category_name') ? 'has-error' : '' }}">
    {{ Form::label('sub_category_name', 'Sub Category Name') }}
    {{ Form::select('sub_category_name',[null=>'Please Select'] + $subcategories,$subselected,['class'=>'form-control border-input']) }}
    <span class="text-danger">{{ $errors->has('sub_category_name') ? $errors->first('sub_category_name') : '' }}</span>
</div>-->

<div class="form-group {{ $errors->has('subcategory') ? 'has-error' : '' }}">
    {{ Form::label('subcategory', 'Sub Category Name') }}
    <input type="hidden" name="edit" id="edit" value="{{ $subselected}}">
   
    {{ Form::select('subcategory',[null=>'Please Select'] + $subcategories,$subselected,['class'=>'form-control border-input','id'=>"subcategory",'required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('subcategory') ? $errors->first('subcategory') : '' }}</span>
</div>

<!--<div class="form-group {{ $errors->has('subcategory') ? 'has-error' : '' }}">
<select class="form-control border-input" name="subcategory" id="subcategory">
</select>
<span class="text-danger">{{ $errors->has('subcategory') ? $errors->first('subcategory') : '' }}</span>
</div>-->

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('product_name', 'Product Name') }}
    {{ Form::text('name',$product->name,['class'=>'form-control border-input','placeholder'=>'Macbook pro','required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    {{ Form::label('price', 'Price') }}
    {{ Form::text('price',$product->price,['class'=>'form-control border-input','placeholder'=>'$2500','required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('price') ? $errors->first('price') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description',$product->description,['class'=>'form-control border-input','placeholder'=>'Description','required'=>'required']) }}
    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
</div>


    {{ Form::label('file','File') }}
    {{ Form::file('image', ['class'=>'form-control border-input', 'id' => 'image']) }}
    <div id="thumb-output"></div>
    <div >
<label>Choose Images</label>
<input type="file"  name="imageFile[]"  id="images" multiple="multiple">
</div>
<div class="user-image mb-3 text-center">
                <div class="imgPreview"> </div>
            </div>    
</div>


    


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
        $.ajaxSetup({

        });

        $(document).ready(function () {
        $('#category').on('change',function(e) {
        var cat_id = e.target.value;
       //var cat_id = 7;
       // console.log(cat_id);
        $.ajax({
        url:"{{ url('admin/subcat') }}",
        type:"POST",
        data: {
            cat_id: cat_id,
            "_token": "{{ csrf_token() }}",
        },
        success:function (data) {
            $('#subcategory').empty();
            $('#subcategory').append('<option value="">Please Select</option>');
            $.each(data.subcategories,function(index,subcategory){
            $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
        })
        }
        })
        });
});
</script>


<script type="text/javascript">

 
    window.onload = function() {
        var edit = document.getElementById("edit").value;
       
        if (edit=="")
        {
          
        
       // if(edit_mode==""){
           
       // $('#category').on('change',function(e) 
       // var cat_id = e.target.value;
       var cat_id = document.getElementById("category").value;
        $.ajax({
        url:"{{ url('admin/subcat') }}",
        type:"POST",
        data: {
            cat_id: cat_id,
            "_token": "{{ csrf_token() }}",
        },
        success:function (data) {
            $('#subcategory').empty();
            $('#subcategory').append('<option value="">Please Select</option>');
            $.each(data.subcategories,function(index,subcategory){
            $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
        })
        }
        })
    }
    
    // code
};
    </script>
    
<script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });    
    </script>