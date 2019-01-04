@extends('layouts.app')

@section('content')

<style>
#select_offer_div {
  display: none;
}
</style>

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
                          <li class="list-group-item">
                            <a href="{{ Route('offers.show',$offer->id) }}" class="btn btn-default">{{ $offer->id }}</a>
                             {{ $offer->article->name }} | {{ $offer->condition->condition }} | {{ $offer->price }} <div class="pull-right row">
                           <?php if (count($offer->acceptedoffer) == 0) { ?>
                             {{ Form::open(['route' => 'categories.store', 'method' => 'POST', 'id' => 'select_offer_div']) }}
                                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                                <input type="hidden" name="article_id" value="{{ $offer->article->id }}">
                                <input type="submit" class="btn btn-warning" name="select_offer" value="Select this Offer">&nbsp;
                             {{ Form::close() }}
                           <?php } ?>
                            <a href="{{ Route('offers.edit', $offer->id ) }}" class="btn btn-success">Edit</a> &nbsp;
                            <a href="{{ Route('offers.delete', $offer->id ) }}" class="btn btn-danger delete-button">Delete</a></div></li>
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

        if (getCookie("selectedArticleOffer")) {
            $("#select_offer_div").show();
        }

        $("#article_id").on("change", function() {
            if ($("#article_id").val()) {
                document.cookie = 'selectedArticleOffer='+$("#article_id").val();
                location.reload();
            }
        });

  });

</script>

@endsection
