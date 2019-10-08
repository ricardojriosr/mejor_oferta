@extends('frontend.layout.base')

@section('content')

<?php if (isset($display_name)) { ?>
  <h1><?php echo $display_name; ?></h1>
<?php } else { ?>
  <h1>Home</h1>
<?php } ?>
<div class="row">
<?php
if (isset($articles)) {
  
  foreach($articles as $article) {
    echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4  home-grid">';
    foreach ($article->images as $img) {
      if ($img->default == 1) {
          echo '<a href="/article/'.$article->slug.'"><img class="img-responsive img-grid" src="/img/articles/'.$img->url_image.'" alt="Article '.$img->article_images_id.'" /></a>
          ';
      }
    }
    echo '</div>';
  }
} else {
  echo "UNEXISTENT";
}
?>
</div>
<div class="text-center">
{!! $articles->render() !!}
</div>
@endsection
