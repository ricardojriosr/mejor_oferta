@extends('frontend.layout.base')

@section('content')

<div class="row">
  <div class="col-8 mx-auto text-center mb-3">
    <?php
    foreach ($article->images as $img) {
      if ($img->default == 1) {
          echo '<img class="img-responsive img-details" src="/img/articles/'.$img->url_image.'" alt="Article '.$img->article_images_id.'" />
          ';
      }
    }
    foreach ($article->images as $img) {
      if ($img->default != 1) {
          echo '<img class="img-responsive img-details" src="/img/articles/'.$img->url_image.'" alt="Article '.$img->article_images_id.'" />
          ';
      }
    }
    ?>
    <br><br>
    <div class="row text-left">
      <div class="col-2">
        <strong>Title:</strong>
      </div>
      <div class="col-10">
          <?php echo $article->display_name; ?>
      </div>
    </div>
    <div class="row text-left">
      <div class="col-2">
        <strong>Description:</strong>
      </div>
      <div class="col-10">
          <?php echo $article->description; ?>
      </div>
    </div>
    <div class="row text-left">
      <div class="col-2">
        <strong>Budget:</strong>
      </div>
      <div class="col-10">
          <?php echo $article->budget; ?>
      </div>
    </div>
    <div class="row text-left">
      <div class="col-2">
        <strong>Quantity:</strong>
      </div>
      <div class="col-10">
          <?php echo $article->quantity; ?>
      </div>
    </div>
  </div>
  @if (Auth::guest())
  @else
  <div class="col-8 mx-auto">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">New Offer</h5>
          <p class="card-text">
            {{ Form::open(['route' => 'offers.store', 'method' => 'POST', 'files' => true]) }}

              <div class="form-group">
                  <div class="alert alert-info fade in alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      <strong>Info:</strong> The first image here would appear as profile photo on your offer.
                  </div>
                  {!! Form::label('image','Offer Images')!!}
                  {!! Form::file('image[]',['multiple' => 'multiple','class' => 'image_offer']) !!}
              </div>

                <div class="form-group">
                    {!! Form::label('category_id','Category')!!}
                    {!! Form::select('category_id', $selectCategories, null, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
                </div>

                <div class="form-group">
                  <label for="subcategory_id">Subcategory</label>
                  <select name="subcategory_id" id="subcategory_id" class="custom-select custom-select-lg select-category" placeholder="Select an option..." data-placeholder="Select an option..." required>
                  <option value="" selected>Select an option...</option>
                  </select>
              </div>

              <div class="form-group">
                  {!! Form::label('condition_id','Condition')!!}
                  {!! Form::select('condition_id', $conditions, null, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...']) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('price','Price')!!}
                  {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price Offer', 'required']) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('observations','Observation')!!}
                  {!! Form::text('observations', null, ['class' => 'form-control', 'placeholder' => 'Observations', 'required']) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('warranty','Warranty')!!}
                  {!! Form::text('warranty', null, ['class' => 'form-control', 'placeholder' => 'Warranty', 'required']) !!}
              </div>

              <div class="form-group">
                  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
              </div>

              {{ Form::close() }}
          </p>
        </div>
    </div>
    @endif
    
  </div>
</div>

<?php
if (1 == 2) {
  echo "<pre>",print_r($article),"</pre>";
}
?>

@endsection

@section('javascript')

<script>

    $( function() {

        $(".image_offer").fileinput({
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
            console.log(response);
            $('#subcategory_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="" selected>Select an Option...</option>' + response);
        });

    }
</script>

@endsection