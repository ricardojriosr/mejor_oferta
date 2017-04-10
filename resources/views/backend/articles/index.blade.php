@extends('backend.layout.layout')

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
                    <ul class="list-group">
                        @foreach($articles as $article)
                            <li class="list-group-item"><a href="{{ Route('articles.show',$article->id) }}" class="btn btn-default">{{ $article->id }}</a>   {{ $article->name }} <span class="pull-right"><a href="{{ Route('articles.edit', $article->id ) }}" class="btn btn-success">Edit</a>
                    <a href="{{ Route('articles.delete', $article->id ) }}" class="btn btn-danger delete-button">Delete</a></span></li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        {!! $articles->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
