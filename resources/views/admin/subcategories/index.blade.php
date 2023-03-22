@extends('admin.layouts.master')

@section('page')
    Sub Category Manager
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">Sub Categories</h4>
                    <p class="category">List of all Sub categories</p>
                    <p align="right"><a href="{{ url('/admin/subcategories/create') }}"><input type="button" class="btn " value="Add New Sub Category"></a></p>
                </div>
                
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Desc</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->id }}</td>
                                <td>{{ $subcategory->category->name }}</td>
                                <td>{{ $subcategory->name }}</td>
                                <td>{{ $subcategory->description }}</td>
                                <td>

                                    {{ Form::open(['route' => ['subcategories.destroy', $subcategory->id], 'method'=>'DELETE']) }}
                                        {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                        {{ link_to_route('subcategories.edit','', $subcategory->id, ['class' => 'btn btn-info btn-sm ti-pencil']) }}
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