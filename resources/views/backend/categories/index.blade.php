@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    <a href="{{ Route('categories.create') }}" class="btn btn-default">New Category</a>
                    <br>
                    <br>
                    <ul class="list-group">
                        @foreach($categories as $category)
                            <li class="list-group-item"><a href="{{ Route('categories.show',$category->id) }}" class="btn btn-default">{{ $category->id }}</a>   {{ $category->name }} <span class="pull-right"><a href="{{ Route('categories.edit', $category->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('categories.delete', $category->id ) }}" class="btn btn-danger delete-button">Delete</a></span></li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        {!! $categories->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection