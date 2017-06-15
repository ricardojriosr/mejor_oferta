@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Subcategory</div>
                <div class="panel-body">
                    <a href="{{ Route('subcategories.create') }}" class="btn btn-default">New Subcategory</a> <a href="{{ Route('subcategories.index') }}" class="btn btn-default">List</a> 
                    <br>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID: </strong>  {{ $subcategory->id }}</li>
                        <li class="list-group-item"><strong>Category: </strong>  {{ $subcategory->category->name }}</li>
                        <li class="list-group-item"><strong>Name: </strong>  {{ $subcategory->name }}</li>
                        <li class="list-group-item"><strong>Display Name: </strong>  {{ $subcategory->display_name }}</li>
                        <li class="list-group-item"><strong>Slug: </strong>  {{ $subcategory->slug }}</li>
                        <li class="list-group-item"><strong>Description: </strong>  {{ $subcategory->description }}</li>
                    </ul>
                    <a href="{{ Route('subcategories.edit', $subcategory->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('subcategories.delete', $subcategory->id ) }}" class="btn btn-danger delete-button">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
