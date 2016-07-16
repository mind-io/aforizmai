@extends('layouts.master')

@section('title')
    Kategorijos
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <h2>Aforizmai pagal temą <small>Subtext for header</small></h2>
            </div>
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li class="active">Kategorijos</li>
                </ol>
            </div>
            <div>
                @foreach ($quotes as $quote)
                    <blockquote>
                        <p>{{ $quote->quote }}</p> 
                        <cite>
                            <a href="{{ route('authors.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                            <a href="{{ route('categories.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                        </cite>
                        <p align="right">
                            <a href="#">
                                <i class="fa fa-comment-o fa-hover-hidden fa-lg fa-fw"></i>
                                <i class="fa fa-comment fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Komentuoti..."></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-heart-o fa-hover-hidden fa-lg fa-fw"></i>
                                <i class="fa fa-heart fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                            </a>
                        </p>
                    </blockquote>
                @endforeach
            </div>
            <div>
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>
        </div>


        <div class="col-md-4">

            <div class="list-group">
                <div class="list-group-item list-group-item-success">Aforizmų temos</div>
                @foreach ($categories as $category)
                    <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" class="list-group-item list-group-item-info">
                    <span class="badge">14</span>
                    <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                    <p class="list-group-item-text">{{ $category->description }}</p></a>
                @endforeach
            </div>

{{--             <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" class="list-group-item">
                            <span class="badge">14</span>
                            <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                            <p class="list-group-item-text">{{ $category->description }}</p></a>
                        @endforeach
                    </div>
                </div>
            </div>
 --}}
        </div>
    </div>
</div>
@endsection