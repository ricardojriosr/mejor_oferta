@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Condition</div>
                <div class="panel-body">
                    <a href="{{ Route('conditions.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    {!! Form::model($condition, array('route' => array('conditions.update', $condition->id), 'method' => 'PUT')) !!}

                    <div class="form-group">
                        {!! Form::label('condition','Condition Name')!!}
                        {!! Form::text('condition', $condition->condition, ['class' => 'form-control', 'placeholder' => 'Condition Name', 'required']) !!}
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
