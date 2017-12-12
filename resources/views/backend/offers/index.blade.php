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

                        @foreach($offers as $offer)
                            <div class="row-fluid" style="border: 1px solid #ddd; padding: 15px; border-radius:10px;">
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <a href="{{ Route('offers.show',$offers->id) }}" class="btn btn-default">{{ $offers->id }}</a>
                                    <br /><br />
                                </div>
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                @foreach ($offer->condition as $condition)
                                    {{ $conditon->condition }}
                                @endforeach
                                </div>
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                {{ $offer->name }}
                                </div>
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span class="pull-right"><a href="{{ Route('offes.edit', $offer->id ) }}"
                                    class="btn btn-success">Edit</a>
                                    <a href="{{ Route('offers.delete', $offer->id ) }}"
                                        class="btn btn-danger delete-button">Delete</a>
                                </span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        @endforeach

                    <div class="text-center">
                        {!! $offers->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
