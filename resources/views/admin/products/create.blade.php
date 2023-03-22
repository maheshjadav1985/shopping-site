@extends('admin.layouts.master')

@section('page')
   Product Manager
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Add Product</h4>
                    <p align="right"><a href="{{ url('/admin/products') }}"><input type="button" class="btn" value="Back"></a></p>
                </div>

                <div class="content">
                    {!! Form::open(['url' => 'admin/products', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.products._fields')

                            <div class="form-group">
                                {{ Form::submit('Add Product', ['class'=>'btn btn-primary']) }}
                            </div>

                        </div>

                    </div>


                    <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection