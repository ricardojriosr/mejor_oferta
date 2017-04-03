@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Subcategory</div>
                <div class="panel-body">
                    <a href="{{ Route('subcategories.index') }}" class="btn btn-default">List</a> 
                    <br>
                    <br>
                    
                    {{ Form::open(['route' => 'subcategories.store', 'method' => 'POST']) }}
                    
                    <div class="form-group">
                        {!! Form::label('category_id','Category')!!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('name','Name')!!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category Name', 'required']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('display_name','Display Name')!!}
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Category Display Name', 'required']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('description','Decription')!!}
                        {{ Form::textarea('description', null, ['size' => '30x5','class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
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