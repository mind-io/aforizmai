@extends('layouts.master')

@section('title')
    Mano kolekcija
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('src/css/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="row">

        {{-- Left col --}}
        <div class="col-md-8" style="padding-left: 30px;">

            {{-- Header --}}
            <div>
                <h3>Mano aforizmų kolekcija <small>(visos temos)</small></h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('categories.index') }}">Kategorijos</a></li>
                  <li class="active">Visos</li>
                </ol>
            </div>

            <!-- Blockquote div -->
            <div>
                @foreach ($quotes as $quote)

                    <blockquote>

                        {{-- Quote content --}}
                        <p>{{ $quote->quote }}</p> 
                        <cite>
                            <a href="#">{{ $quote->author->name }}</a> |
                            <a href="#">{{ $quote->category->name }}</a>
                        </cite>

                        {{-- Quote fa buttons --}}
                        <p align="right" data-quoteid="{{ $quote->id }}">

                            {{-- Checking if the user has like --}}
                            @if(Auth::user()->likes()->where('quote_id', $quote->id)->first() )
                                <span>{{ $quote->likes()->count('like') }}</span>
                                <a href="#" class="like">
                                    <i class="fa fa-heart fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                                </a>
                            {{-- user has no like --}}
                            @else
                                <span>{{ $quote->likes()->count('like') }}</span>
                                <a href="#" class="like">
                                    <i class="fa fa-heart-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                                </a>
                            @endif
                        </p>{{-- //fa buttons paragraph --}}

                    </blockquote>
                    
                @endforeach
            </div>

            {{-- Pagination --}}
            <div>
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /Left col-md-8 --}}

        {{-- Right col --}}
        <div class="col-md-4" style="padding-left: 30px; margin-top:21px;">

			{{-- Quote categories panel --}}
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            @if(count($category->quotes) > 0)
                                <a href="#" class="list-group-item">
                                <span class="badge">{{ $category->quotes()->count() }}</span>
                                <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                                <p class="list-group-item-text">{{ $category->description }}</p></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>{{-- /Categories panel --}}

            {{-- Author selector --}}
            <div class="well">
                <form class="form" method="POST" action="{{ route('authors.select') }}">
                {{ csrf_field() }}
                    <div class="form-group input-group-lg {{ $errors->has('author_id') ? ' has-error' : '' }}">
                        <label class="control-label" for="author_id"><h4>Filtruoti pagal autorių:</h4></label>
                        <select id="author_id" class="form-control select2 input-lg" name="author_id">
                            <option> </option>
                            @foreach ($authors as $author)
                                @if(count($author->quotes) > 0)
                                    <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->quotes()->Approved()->count() }})</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-info btn-block">
                            <i class="fa fa-fw fa-filter"></i> Filtruoti
                        </button>
                        <br>
                    </div>
                </form>
            </div>{{-- /Author selector --}}            

        </div>{{-- /Right col-md-4 --}}
    </div>{{-- /row --}}
</div>{{-- /container --}}
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $("#author_id").select2({
            theme: "bootstrap",
            placeholder: "Autoriaus paieška...",
            allowClear: true,
            minimumResultsForSearch: 2
        });
    </script>

    <script type="text/javascript" src="{{ URL::to('src/js/like.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like.quote') }}';
    </script>

@endsection
