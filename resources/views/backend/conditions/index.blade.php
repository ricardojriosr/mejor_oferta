@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Conditions</div>
                <div class="panel-body">
                    <a href="{{ Route('conditions.create') }}" class="btn btn-default">New Condition</a>
                    <br>
                    <br>
                    <ul class="list-group">
                        @foreach($conditions as $condition)
                            <li class="list-group-item"><a href="{{ Route('conditions.show',$condition->id) }}" class="btn btn-default">{{ $condition->id }}</a>   {{ $condition->condition }} <span class="pull-right"><a href="{{ Route('conditions.edit', $condition->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('conditions.delete', $condition->id ) }}" class="btn btn-danger delete-button">Delete</a></span></li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        {!! $conditions->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
