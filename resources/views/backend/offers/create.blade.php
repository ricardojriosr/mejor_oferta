@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Offer</div>
                <div class="panel-body">
                    <a href="{{ Route('offers.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    {{ Form::open(['route' => 'offers.store', 'method' => 'POST', 'files' => true]) }}

                    <div class="form-group">
                        <div class="alert alert-info fade in alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <strong>Info:</strong> The first image here would appear as profile photo on your offer.
                        </div>
                        {!! Form::label('image','Offer Images')!!}
                        {!! Form::file('image[]',['multiple' => 'multiple','class' => 'image_offer']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('article_id','Article')!!}
                        {!! Form::select('article_id', $articles, null, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('condition_id','Condition')!!}
                        {!! Form::select('condition_id', $conditions, null, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price','Price')!!}
                        {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price Offer', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('observations','Observation')!!}
                        {!! Form::text('observations', null, ['class' => 'form-control', 'placeholder' => 'Observations', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('warranty','Warranty')!!}
                        {!! Form::text('warranty', null, ['class' => 'form-control', 'placeholder' => 'Warranty', 'required']) !!}
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

@section('js')

<script>

    $( function() {

        $(".image_offer").fileinput({
            'showUpload': false
        });

    });


</script>

@endsection
