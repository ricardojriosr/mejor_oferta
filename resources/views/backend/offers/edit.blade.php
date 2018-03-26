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
                    {!! Form::model($offer, array('route' => array('offers.update', $offer->id), 'method' => 'PUT')) !!}

                    <div class="form-group">
                        {!! Form::label('article_id','Article')!!}
                        {!! Form::select('article_id', $articles, $offer->article->id, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('condition_id','Condition')!!}
                        {!! Form::select('condition_id', $conditions, $offer->condition->id, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price','Price')!!}
                        {!! Form::number('price', $offer->price, ['class' => 'form-control', 'placeholder' => 'Price Offer', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('observations','Observation')!!}
                        {!! Form::text('observations', $offer->observations, ['class' => 'form-control', 'placeholder' => 'Observations', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('warranty','Warranty')!!}
                        {!! Form::text('warranty', $offer->warranty, ['class' => 'form-control', 'placeholder' => 'Warranty', 'required']) !!}
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
