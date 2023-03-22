@extends('admin.layouts.master')

@section('page')
Category Manager
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Edit Category</h4>
                    <p align="right"><a href="{{ url('/admin/categories') }}"><input type="button" class="btn" value="Back"></a></p>
                </div>

                <div class="content">
                    {!! Form::open(['url' => ['admin/categories', $category->id], 'files'=>'true', 'method'=>'put']) !!}
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.categories._fields')

                            <div class="form-group">
                                {{ Form::submit('Update Category', ['class'=>'btn btn-primary']) }}
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