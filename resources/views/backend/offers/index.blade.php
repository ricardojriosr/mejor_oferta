@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Offers</div>
                <div class="panel-body">
                    <a href="{{ Route('offers.create') }}" class="btn btn-default">New Offer</a>
                    <br>
                    <br>
                    <ul class="list-group">
                          @foreach($offers as $offer)
                            <li class="list-group-item"><a href="{{ Route('offers.show',$offer->id) }}" class="btn btn-default">{{ $offer->id }}</a>   {{ $offer->article->name }} | {{ $offer->condition->condition }} | {{ $offer->price }} <span class="pull-right"><a href="{{ Route('offers.edit', $offer->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('offers.delete', $offer->id ) }}" class="btn btn-danger delete-button">Delete</a></span></li>
                          @endforeach
                    </ul>
                    <div class="text-center">
                        {!! $offers->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
