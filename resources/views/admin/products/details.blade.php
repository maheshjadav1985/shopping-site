@extends('admin.layouts.master')

@section('page')
Product Manager
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
        @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Product Detail</h4>
                    <p align="right"><a href="{{ url('/admin/products') }}"><input type="button" class="btn" value="Back"></a></p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <tbody>

                        <tr>
                            <th>ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>{!! $product->description !!}</td>
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td>{{ $product->price }}</td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td>{{ $product->updated_at->diffForHumans() }}</td>
                        </tr>

                        <tr>
                            <th>Main Image</th>
                            @if ($product->image != null)
                                <td><img src="{{ url('assets/uploads/products').'/'. $product->image }}" alt="{{ $product->image }}" style="width:150px;" class="img-thumbnail"></td>
                                @else
                                <td><img src="{{ url('assets/uploads/products/nologo.png')}}" alt="{{ $product->image }}" style="width:150px;" class="img-thumbnail"></td>
                                @endif
                        </tr>
                        <tr>
                            <th>Product Gallery</th>
                           
                           
                                <td>
                                <table width="100%">
                               
                                <tr>
                                @foreach ($multipleimages as $image)    
                                    <td>    
                                <img src="{{ url('assets/uploads/products').'/'. $image->name }}" alt="{{ $image->name }}" style="width:150px;" class="img-thumbnail">
                                <p align="center"> 
                              <!--  {{ link_to_route('order.pending','', $image->product_id,'', ['class'=>'btn btn-warning btn-sm']) }} -->
                                   {{ Form::open(['route' => ['product.image.gallery', $image->id], 'method'=>'DELETE']) }}
                                    {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                 {{ Form::close() }}
                                </p>

                            </td>
                                  

                                  @endforeach
</tr> </table> 
                            </td>
                              
                              
                        </tr>

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection