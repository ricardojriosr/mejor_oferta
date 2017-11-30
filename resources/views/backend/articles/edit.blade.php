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
                    {!! Form::model($article, array('route' => array('articles.update', $article->id), 'method' => 'PUT')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="alert alert-info fade in alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Info:</strong> Check the image that would appear as profile photo on your article.<br/>
                        If you upload new images, the images uploaded before would be deleted.
                    </br/>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        @foreach ($images as $key => $value)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <input type="checkbox"
                                value="{{ $value->article_images_id }}"
                                name="principal_image"
                                id="principal_image{{ $value->article_images_id }}"
                                class="principal_image"
                                @if ($value->default == 1)
                                checked
                                @endif
                                />
                                <strong>Default Image?</strong>
                                <img class="img-responsive"
                                src="/img/articles/{{ $value->url_image }}"
                                data-article_id="{{ $value->article_id }}" />
                                <br />
                            </div>
                        @endforeach

                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        {!! Form::label('image','Article Images')!!}
                        {!! Form::file('image[]',['multiple' => 'multiple','class' => 'image_article']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_id','Category')!!}
                        {!! Form::select('category_id', $categories, $article->category_id, ['class' => 'form-control select-category','required', 'placeholder' => 'Select an option...']) !!}
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control select-category" placeholder="Select an option..." data-placeholder="Select an option..." required>
                        <option value="">Select an option...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name','Name') !!}
                        {!! Form::text('name', $article->name, ['class' => 'form-control', 'placeholder' => 'Article Name', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('display_name','Display Name') !!}
                        {!! Form::text('display_name', $article->display_name, ['class' => 'form-control', 'placeholder' => 'Article Display Name', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description','Decription')!!}
                        {{ Form::textarea('description', $article->description, ['size' => '30x5','class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
                    </div>

                    <div class="form-group">
                        {!! Form::label('quantity','Quantity')!!}
                        {!! Form::number('quantity', $article->quantity, ['class' => 'form-control', 'placeholder' => 'Article Quantity', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>
                    <input type="hidden" name="default" id="default" />
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
        var ThisIsChecked;
        $(".principal_image").each(function() {
            $(this).on("click", function() {
                if ($(this).is(':checked')) {
                    ThisIsChecked = $("#" + $(this).attr('id'));
                    $(".principal_image").prop("checked", false);
                    ThisIsChecked.prop("checked", true);
                    $("#default").val(ThisIsChecked.val());
                }
            });
        });

        get_subactegories('<?php echo $article->category_id; ?>');
        $('#subcategory_id').val('<?php echo $article->subcategory_id; ?>');
    });

    function get_subactegories(id) {

        $.ajax({
            type: "GET",
            url: "/subcategories/ajax/"+id,
            async: false,
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
