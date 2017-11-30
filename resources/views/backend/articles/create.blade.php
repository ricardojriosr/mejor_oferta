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
                    {{ Form::open(['route' => 'articles.store', 'method' => 'POST', 'files' => true]) }}

                    <div class="form-group">
                        <div class="alert alert-info fade in alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <strong>Info:</strong> The first image here would appear as profile photo on your article.
                        </div>
                        {!! Form::label('image','Article Images')!!}
                        {!! Form::file('image[]',['multiple' => 'multiple','class' => 'image_article']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_id','Category')!!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control select-category" placeholder="Select an option..." data-placeholder="Select an option..." required>
                        <option value="" selected>Select an option...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Article Name', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('display_name','Display Name') !!}
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Article Display Name', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description','Decription')!!}
                        {{ Form::textarea('description', null, ['size' => '30x5','class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
                    </div>

                    <div class="form-group">
                        {!! Form::label('quantity','Quantity')!!}
                        {!! Form::number('quantity', null, ['class' => 'form-control', 'placeholder' => 'Article Quantity', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('budget','Budget')!!}
                        {!! Form::number('budget', null, ['class' => 'form-control', 'placeholder' => 'Budget Available', 'required']) !!}
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

        $(".image_article").fileinput({
            'showUpload': false
        });

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
            .append('<option value="" selected>Select an Option...</option>' + response);
        });
    }
</script>

@endsection
