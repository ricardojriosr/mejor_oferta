@extends('layouts.app')

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

                            <div class="form-group col-md-12">
                                {!! Form::label('article_id','Article')!!}
                                {!! Form::select('article_id', $articles, $selectedArticle, ['class' => 'custom-select custom-select-lg select-category','placeholder' => 'Select an option...']) !!}
                            </div>


                    <br>
                    <br>
                    <div class="col-md-12 form-group">
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
</div>


@endsection

@section('js')

<script>

  $(function() {

        $("#article_id").on("change", function() {
            if ($("#article_id").val()) {
                document.cookie = 'selectedArticleOffer='+$("#article_id").val();
                location.reload();
            }
        });

  });

</script>

@endsection
