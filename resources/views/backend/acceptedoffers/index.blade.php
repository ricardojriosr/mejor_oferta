@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Accepted Offers</div>
                <div class="panel-body">
                    <a href="{{ Route('acceptedoffers.create') }}" class="btn btn-default">New Accepted Offer</a>
                    <br>
                    <br>

                    <ul class="list-group">
                        @foreach($acceptedoffers as $acceptedoffer)

                            <li class="list-group-item"><a href="{{ Route('acceptedoffers.show',$acceptedoffer->id) }}" class="btn btn-default">{{ $acceptedoffer->id }}</a>   {{ $acceptedoffer->article->name }} | {{ $acceptedoffer->offer->price }}<span class="pull-right"><a href="{{ Route('acceptedoffers.edit', $acceptedoffer->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('acceptedoffers.delete', $acceptedoffer->id ) }}" class="btn btn-danger delete-button">Delete</a></span></li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        {!! $acceptedoffers->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
