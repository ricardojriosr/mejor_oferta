@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Accepted Offer</div>
              <div class="panel-body">
                <a href="{{ Route('acceptedoffers.create') }}" class="btn btn-default">New Accepted Offer</a> <a href="{{ Route('acceptedoffers.index') }}" class="btn btn-default">List</a>
                <br>
                <br>
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID: </strong>  {{ $acceptedoffer->id }}</li>
                    <li class="list-group-item"><strong>Article ID: </strong>  {{ $acceptedoffer->article_id }}</li>
                    <li class="list-group-item"><strong>Article Name: </strong>  {{ $acceptedoffer->article->name }}</li>
                    <li class="list-group-item"><strong>Article Budget: </strong>  {{ $acceptedoffer->article->budget }}</li>
                    <li class="list-group-item"><strong>Offer ID: </strong>  {{ $acceptedoffer->offer_id }}</li>
                    <li class="list-group-item"><strong>Offer Condition: </strong>  {{ $acceptedoffer->offer->condition->condition }}</li>
                    <li class="list-group-item"><strong>Offer Condition: </strong>  {{ $acceptedoffer->offer->price }}</li>
                    <li class="list-group-item"><strong>Offer Condition: </strong>  {{ $acceptedoffer->offer->observations }}</li>
                    <li class="list-group-item"><strong>Offer Condition: </strong>  {{ $acceptedoffer->offer->warranty }}</li>
                </ul>
                <a href="{{ Route('acceptedoffers.edit', $acceptedoffer->id ) }}" class="btn btn-success">Edit</a>
                <a href="{{ Route('acceptedoffers.delete', $acceptedoffer->id ) }}" class="btn btn-danger delete-button">Delete</a>
              </div>
          </div>
      </div>
    </div>
</div>

@endsection
