@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Condition</div>
                <div class="panel-body">
                    <a href="{{ Route('conditions.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    {{ Form::open(['route' => 'conditions.store', 'method' => 'POST']) }}

                    <div class="form-group">
                        {!! Form::label('condition','Condition Name')!!}
                        {!! Form::text('condition', null, ['class' => 'form-control', 'placeholder' => 'Condition Name', 'required']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
