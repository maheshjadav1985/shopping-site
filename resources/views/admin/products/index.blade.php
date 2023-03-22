@extends('admin.layouts.master')

@section('page')
    Product Manager
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
  <!--  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <div class="container mt-51">
    <h2 class="mb-4">Laravel 7|8 Yajra Datatables Example</h2>
    <table class="table table-bordered   yajra-datatable" id="table">
        <thead>
            <tr>
            <th>ID</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>Image</th>
                            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>-->


   <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">Products</h4>
                    <p class="category">List of all products</p>
                    <p align="right"><a href="{{ url('/admin/products/create') }}"><input type="button" class="btn " value="Add New Product"></a></p>
                </div>
                
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped yajra-datatable" id="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                      <!--  <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                @if ($product->image != null)
                                <td><img src="{{ url('assets/admin/uploads').'/'. $product->image }}" alt="{{ $product->image }}" style="width:50px;" class="img-thumbnail"></td>
                                @else
                                <td><img src="{{ url('assets/admin/uploads/nologo.png')}}" alt="{{ $product->image }}" style="width:50px;" class="img-thumbnail"></td>
                                @endif
                                <td>

                                    {{ Form::open(['route' => ['products.destroy', $product->id], 'method'=>'DELETE']) }}
                                        {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                        {{ link_to_route('products.edit','', $product->id, ['class' => 'btn btn-info btn-sm ti-pencil']) }}
                                        {{ link_to_route('products.show','', $product->id, ['class' => 'btn btn-primary btn-sm ti-list']) }}
                                    {{ Form::close() }}

                                </td>
                            </tr>
                            @endforeach
                        </tbody>-->
                    </table>

                </div>
            </div>
        </div>


    </div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
   
    $.noConflict();
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        "order": [[ 0, "desc" ]],
        ajax: "{{ route('products.list') }}",
        columns: [
           // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category name'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'description', name: 'desc'},
            { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                       
                        if (data !='' && data!='null' && data!=null)
                        {
                            data=data;
                         } else {
                             data ='nologo.png'
                        }
                        return "<img src=\"/assets/uploads/products/" + data + "\" height=\"50\" />";
                        
                    }
                },
                
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },

            
        ]
    });
                    /* Delete customer */
                $('body').on('click', '#delete-user', function () {
                    
                var user_id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
             //   confirm("Are You sure want to delete !");
             var result = confirm('Are You sure want to delete !');
             if(result) {
                $.ajax({
                type: "DELETE",
                url: "products/"+user_id,
                data: {
                "id": user_id,
                "_token": token,
                },
                success: function (data) {
                  //  console.log(data);
                  let successHtml = '<div class="alert alert-success" role="alert"><b>Product Deleted Successfully</b></div>';
                $("#alert-div").html(successHtml);
              //  $('#msg').html('Product has been deleted');
              //  $('#table').DataTable().reload()
                table.ajax.reload();
               
                },
                error: function (data) {
                console.log('Error:', data);
                }
                
                });
            }
                });
                   
});
</script>
