@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Subcategories</div>
                <div class="panel-body">
                    <a href="{{ Route('subcategories.create') }}" class="btn btn-default">New Subcategory</a>
                    <br>
                    <br>
                    <ul class="list-group">
                        @foreach($subcategories as $subcategory)
                            <li class="list-group-item"><a href="{{ Route('subcategories.show',$subcategory->id) }}" class="btn btn-default">{{ $subcategory->id }}</a>   {{ $subcategory->name }} <span class="pull-right"><a href="{{ Route('subcategories.edit', $subcategory->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('subcategories.delete', $subcategory->id ) }}" class="btn btn-danger delete-button">Delete</a></span></li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        {!! $subcategories->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection