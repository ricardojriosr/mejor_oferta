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
  
  <div class="col-8 mx-auto mb-3">
    <?php if (!$sameUserArticle) { ?>
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">New Offer</h5>
          <p class="card-text">
              <?php 
              $disableFields      = false;
              $selectedCondition  = null;
              $selectedPrice      = null;
              $selectedObs        = null;
              $selectedWarr       = null;
              $selectedOffer      = null;
              $formMethod         = 'POST';
              $showEditButton     = '';
              $hiddenOfferField   = '';
              if ($existOffer) {
                // echo "Offer";
                // echo "<pre>",print_r($offerDetail->offerimage),"</pre>";
                foreach ($offerDetail->offerimage as $value) {
                    echo '<img src="/img/offers/'.$value->url_image.'" class="img-fluid img-offer" />';
                }
                $selectedCondition  = $countUserOffer->condition_id;
                $selectedPrice      = $countUserOffer->price;
                $selectedObs        = $countUserOffer->observations;
                $selectedWarr       = $countUserOffer->warranty;
                $selectedOffer      = $countUserOffer->id;
                $formMethod         = 'PUT';
                $disableFields      = true;
                $hiddenOfferField   = '<input type="hidden" value="'.$offerId.'" id="offer_id" name="offer_id">';
                $showEditButton     = '<div class="form-group"><button id="activateFields" class="btn btn-warning">Change Offer</button></div>';
              } 
              ?>
            {{ Form::open(['route' => 'article.offer', 'method' => 'POST', 'files' => true, 'id' => 'form-offer']) }}
              <input type="hidden" name="article_id" id="article_id" value="<?php echo $article->id; ?>">
              <input type="hidden" name="offer_id" id="offer_id" value="<?php echo $selectedOffer; ?>">
              <div class="form-group">
                
              </div>
              <div class="form-group">
                  <div class="alert alert-info fade in alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                      <strong>Info:</strong> The first image here would appear as profile photo on your offer.
                  </div>
                  {!! Form::label('image','Offer Images')!!}
                  {!! Form::file('image[]',['multiple' => 'multiple','class' => 'image_offer', 'disabled' => $disableFields ]) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('condition_id','Condition')!!}
                  {!! Form::select('condition_id', $conditions, $selectedCondition, ['class' => 'custom-select custom-select-lg select-category','required', 'placeholder' => 'Select an option...', 'disabled' => $disableFields ]) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('price','Price')!!}
                  {!! Form::number('price', $selectedPrice, ['class' => 'form-control', 'placeholder' => 'Price Offer', 'required', 'disabled' => $disableFields ]) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('observations','Observation')!!}
                  {!! Form::text('observations', $selectedObs, ['class' => 'form-control', 'placeholder' => 'Observations', 'required', 'disabled' => $disableFields ]) !!}
              </div>

              <div class="form-group">
                  {!! Form::label('warranty','Warranty')!!}
                  {!! Form::text('warranty', $selectedWarr, ['class' => 'form-control', 'placeholder' => 'Warranty', 'required', 'disabled' => $disableFields ]) !!}
              </div>

              <div class="form-group">
                  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
              </div>

              <?php echo $showEditButton; ?>

              {{ Form::close() }}
          </p>
        </div>
    </div>
    <?php } ?>
    @endif
    
  </div>
  <?php if (count($articleOffers) > 0) { ?>
  <div class="col-8 mx-auto mt-3 mb-3">
    <?php
    // echo '<pre>',print_r($articleOffers),'</pre>';
    foreach ($articleOffers as $offer) {
    ?>
        <div class="row mb-2 border-offer">
          <div class="col-4 mt-2 mb-2">
            <?php
            $imageURL = '';
            foreach($offer->offerimage as $oImage) {
              $imageURL = $oImage->url_image;
              break;
            }
            ?>
            <img src="/img/offers/<?=$imageURL; ?>" alt="" class="img-fluid">
          </div>
          <div class="col-8 mt-2 mb-2">
            <ul class="list-group">
              <li class="list-group-item"><u>Price</u>: {!! $offer->price; !!}</li>
              <li class="list-group-item"><u>Condition</u>: {!! $offer->condition->condition; !!}</li>
              <li class="list-group-item"><u>Observations</u>: {!! $offer->observations; !!}</li>
              <li class="list-group-item"><u>Warranty</u>: {!! $offer->warranty; !!}</li>
            </ul>
          </div>
        </div>
    <?php
    }
    ?>
  </div>
  <?php } ?>
</div>

<?php
if (1 == 2) {
  echo "<pre>",print_r($article),"</pre>";
}
?>

@endsection

@section('javascript')

<script>

  var editState = false;
  $( function() {

      $(".image_offer").fileinput({
          'showUpload': false
      });
      
      if ($("#activateFields")) {
        $("#activateFields").on("click", function(e) {
          if (editState) {
            editState = false;
            $("#form-offer input").prop('disabled', true);
            $("#form-offer select").prop('disabled', true);
            document.getElementById("activateFields").childNodes[0].nodeValue = "Change Offer";
          } else {
            editState = true;
            $("#form-offer input").prop('disabled', false);
            $("#form-offer select").prop('disabled', false);
            document.getElementById("activateFields").childNodes[0].nodeValue = "Cancel";
          }
          e.preventDefault();
        });
      }

  });

    
</script>

@endsection