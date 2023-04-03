@extends('admin.layouts.master')

@section('page')
    Category Manager
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">Categories</h4>
                    <p class="category">List of all categories</p>
                    <p align="right"><a href="{{ url('/admin/categories/create') }}"><input type="button" class="btn " value="Add New Category"></a></p>
                </div>
                {!! Form::open(['url' => 'admin/searchcategories', 'method' => 'post']) !!}
               <!-- {!! Form::open(['url' => 'admin/searchcategories', 'method' => 'POST']) !!} -->
                <div class="column">
                            <label for="from">Name:</label></br>
                            <input name="name" type="text" placeholder="" class="form-control" value="">
                        </div>
                        <br>
                        <div class="column">
                            <label for="from">From Date:</label></br>
                            <input class="form-control" name="from_date" type="date" > 
                        </div>
                        <div class="column">
                            <label for="from">To Date:</label></br>
                            <input class="form-control" name="to_date" type="date" > 
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                        {!! Form::close() !!}
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Desc</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>

                                    {{ Form::open(['route' => ['categories.destroy', $category->id], 'method'=>'DELETE']) }}
                                        {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                        {{ link_to_route('categories.edit','', $category->id, ['class' => 'btn btn-info btn-sm ti-pencil']) }}
                                    {{ Form::close() }}

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>


@endsection