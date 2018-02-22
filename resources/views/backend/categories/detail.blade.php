@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category</div>
                <div class="panel-body">
                    <a href="{{ Route('categories.create') }}" class="btn btn-default">New Category</a> <a href="{{ Route('categories.index') }}" class="btn btn-default">List</a> 
                    <br>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID: </strong>  {{ $category->id }}</li>
                        <li class="list-group-item"><strong>Name: </strong>  {{ $category->name }}</li>
                        <li class="list-group-item"><strong>Display Name: </strong>  {{ $category->display_name }}</li>
                        <li class="list-group-item"><strong>Slug: </strong>  {{ $category->slug }}</li>
                        <li class="list-group-item"><strong>Description: </strong>  {{ $category->description }}</li>
                    </ul>
                    <a href="{{ Route('categories.edit', $category->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('categories.delete', $category->id ) }}" class="btn btn-danger delete-button">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection