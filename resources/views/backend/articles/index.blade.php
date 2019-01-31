@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Articles</div>
                <div class="panel-body">
                    <a href="{{ Route('articles.create') }}" class="btn btn-default">New Article</a>
                    <br>
                    <br>

                        @foreach($articles as $article)

                            <div class="col-md-12 articles-listing" >
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <a href="{{ Route('articles.show',$article->id) }}" class="btn btn-default">{{ $article->id }}</a>
                                    <br /><br />
                                </div>
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                @foreach ($article->images as $img)
                                    @if ($img->default == 1)
                                        <img class="img-responsive img-thumbnail" src="/img/articles/{{ $img->url_image }}" alt="Article {{ $img->article_images_id }}" />
                                        <br />
                                    @endif
                                @endforeach
                                </div>
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                {{ $article->name }}
                                </div>
                                <div clas="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <span class="pull-right"><a href="{{ Route('articles.edit', $article->id ) }}"
                                    class="btn btn-success">Edit</a>
                                    <a href="{{ Route('articles.delete', $article->id ) }}"
                                        class="btn btn-danger delete-button">Delete</a>
                                </span>
                                </div>
                            </div>

                        <div class="clearfix"></div>
                        @endforeach

                    <div class="text-center">
                        {!! $articles->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
