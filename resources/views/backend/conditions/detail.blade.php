@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Condition</div>
                <div class="panel-body">
                    <a href="{{ Route('conditions.create') }}" class="btn btn-default">New Condition</a> <a href="{{ Route('conditions.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID: </strong>  {{ $condition->id }}</li>
                        <li class="list-group-item"><strong>Condition: </strong>  {{ $condition->condition }}</li>
                    </ul>
                    <a href="{{ Route('conditions.edit', $condition->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('conditions.delete', $condition->id ) }}" class="btn btn-danger delete-button">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
