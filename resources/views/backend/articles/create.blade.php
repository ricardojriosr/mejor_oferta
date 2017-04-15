@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Article</div>
                <div class="panel-body">
                    <a href="{{ Route('articles.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    {{ Form::open(['route' => 'articles.store', 'method' => 'POST']) }}

                    <div class="form-group">
                        {!! Form::label('category_id','Category')!!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control select-category" placeholder="Select an option..." data-placeholder="Select an option..." required>
                        <option value="" selected></option>
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name','Name) !!}
                        {!! Form::text('name',null,['class' => 'form-control','required', 'placeholder' => 'Name of Article']) !!}
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
        $("#category_id").on("change", function() {
            var id = $("#category_id").val();
            if (id) {
                get_subactegories(id);
            } else {
                $('#subcategory_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="" selected></option>');
            }
        });
    });

    function get_subactegories(id) {
        $.ajax({
            type: "GET",
            url: "/subcategories/ajax/"+id,
            data: { _token:$("input[name='_token']").val()  }
        }).done(function( response ) {
            $('#subcategory_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="" selected></option>' + response);
        });
    }
</script>

@endsection
