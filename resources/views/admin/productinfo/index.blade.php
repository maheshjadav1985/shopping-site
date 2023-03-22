@extends('admin.layouts.master')

@section('page')
    Product Additional Info
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
  <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">{{ $product->name }} Product Additional info</h4>
                    <p class="category">List of all products</p>
                    <p align="right"><a href="{{ url('/admin/productinfo/'.$product->id.'/create') }}"><input type="button" class="btn " value="Add New Product Info"></a></p>
                </div>
               
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped yajra-datatable" id="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Label Name</th>
                            <th>Label Value</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
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
        ajax: "{{ route('productinfo.list',"+$product->id+") }}",
       // ajax: "{{ route('productinfo.list',38) }}",
        columns: [
           // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'label_name', name: 'label_name'},
            {data: 'label_value', name: 'label_value'},    
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },

            
        ]
    });
                    /* Delete product info */
                $('body').on('click', '#delete-product-infto', function () {
                var product_info_id = $(this).data("id");
              
                var token = $("meta[name='csrf-token']").attr("content");
             var result = confirm('Are You sure want to delete !');
             if(result) {
                $.ajax({
                type: "DELETE",
                url: ""+product_info_id,
                data: {
                "id": product_info_id,
                "_token": token,
                },
                success: function (data) {
                    console.log(data);
                  let successHtml = '<div class="alert alert-success" role="alert"><b>Product info Deleted Successfully</b></div>';
                $("#alert-div").html(successHtml);
             
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
