@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Offer</div>
                <div class="panel-body">
                    <a href="{{ Route('offers.create') }}" class="btn btn-default">New Offer</a> <a href="{{ Route('offers.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID: </strong>  {{ $offer->id }}</li>
                        <li class="list-group-item"><strong>Article: </strong>  <a href="{{ Route('articles.show', $offer->article->id ) }}">{{ $offer->article->name }}</a></li>
                        <li class="list-group-item"><strong>Condition: </strong>  {{ $offer->condition->condition }}</li>
                        <li class="list-group-item"><strong>Observation: </strong>  {{ $offer->observations }}</li>
                        <li class="list-group-item"><strong>Warranty: </strong>  {{ $offer->warranty }}</li>
                    </ul>
                    <a href="{{ Route('offers.edit', $offer->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('offers.delete', $offer->id ) }}" class="btn btn-danger delete-button">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
