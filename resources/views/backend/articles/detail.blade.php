@extends('backend.layout.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Article</div>
                <div class="panel-body">
                    <a href="{{ Route('articles.create') }}" class="btn btn-default">New Artilce</a> <a href="{{ Route('articles.index') }}" class="btn btn-default">List</a>
                    <br>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID: </strong>  {{ $article->id }}</li>
                        <li class="list-group-item"><strong>Name: </strong>  {{ $article->name }}</li>
                        <li class="list-group-item"><strong>Display Name: </strong>  {{ $article->display_name }}</li>
                        <li class="list-group-item"><strong>Slug: </strong>  {{ $article->slug }}</li>
                        <li class="list-group-item"><strong>Description: </strong>  {{ $article->description }}</li>
                        <li class="list-group-item"><strong>Quantity: </strong>  {{ $article->quantity }}</li>
                    </ul>
                    @foreach ($article->images as $value)
                    <div class="col-md-3">
                      <img class="img-responsive"
                      src="/img/articles/{{ $value->url_image }}"
                      data-article_id="{{ $value->article_id }}" />
                      <br />
                    </div>
                    @endforeach
                    <div class="clearfix"></div>
                    <a href="{{ Route('articles.edit', $article->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('articles.delete', $article->id ) }}" class="btn btn-danger delete-button">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
