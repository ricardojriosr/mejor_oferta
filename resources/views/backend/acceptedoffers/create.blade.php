@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Accepted Offer</div>
                <div class="panel-body">
                    <a href="{{ Route('acceptedoffers.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    {{ Form::open(['route' => 'acceptedoffers.store', 'method' => 'POST']) }}

                    <div class="form-group">
                        {!! Form::label('article_id','Article')!!}
                        {!! Form::select('article_id', $articles, null, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('offer_id','Offer')!!}
                        {!! Form::select('offer_id', [], null, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...', 'data-live-search' => 'true']) !!}
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

        $("#article_id").on("change", function() {
            var id = $("#article_id").val();
            if (id) {
                get_offers(id);
                console.log('FLAG 2');
            } else {
                console.log('FLAG 3');
                $('#offer_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="" selected></option>');
            }
        });
    });

    function get_offers(id) {


        $.ajax({
            type: "GET",
            url: "/offers/ajax/"+id,
            data: { _token:$("input[name='_token']").val()  }
        }).done(function( response ) {
            console.log('FLAG 1');
            console.log(response);
            $('#offer_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="" selected>Select an Option...</option>' + response);
        });

    }
</script>

@endsection
