@extends('layouts.master')

@section('title')
    Nepatvirtinti aforizmai
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('src/css/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div>
                <h3>Aforizmų atranka į oficialią kolekciją</h3>
            </div>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-lg fa-fw fa-info-circle" aria-hidden="true"></i>
                <strong>Warning!</strong><br>
                Better check yourself, you're not looking too good. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <a href="#" class="alert-link">tempor incididunt</a>
                ut labore et dolore <span class="badge votes">20</span> magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </div>
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li class="active">Visi nepatvirtinti</li>
                </ol>
            </div>
            <div>
                @if(count($quotes) == 0)
                    <br><p>Nėra nepatvirtintų aforizmų...</p>
                @else
                    @foreach ($quotes as $quote)
                        <blockquote>
                            <p>{{ $quote->quote }}</p>
                            <cite>
                                <a href="{{ route('submissions.authors.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                                <a href="{{ route('submissions.categories.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                            </cite>
                            <p align="right" data-quoteid="{{ $quote->id }}">

                                @if(Auth::user()) {{-- is user --}}
                                    {{-- <a href="#" class="vote">{{ Auth::user()->votes()->where('quote_id', $quote->id)->first() ? Auth::user()->votes()->where('quote_id', $quote->id)->first()->vote === 1 ? 'You vote this Quote' : 'vote' : 'vote' }}</a>
                                    <span class="badge vote-badge">{{ $quote->votes()->sum('vote') }}</span>
                                    <a href="#" class="disvote">{{ Auth::user()->votes()->where('quote_id', $quote->id)->first() ? Auth::user()->votes()->where('quote_id', $quote->id)->first()->vote === -1 ? 'You disvote this Quote' : 'Disvote' : 'Disvote' }}</a> --}}

                                    {{-- Checking if user has voted --}}
                                    @if(Auth::user()->votes()->where('quote_id', $quote->id)->first() )

                                        {{-- user voted UP the quote     --}}
                                        @if(Auth::user()->votes()->where('quote_id', $quote->id)->first()->vote === 1)
                                            <a href="#" class="voteUp">
                                                <i class="fa fa-thumbs-up fa-lg fa-fw" aria-hidden="true"></i>
                                            </a>
                                            <span class="badge votecount">{{ $quote->votes()->sum('vote') }}</span>
                                            <a href="#" class="voteDown">
                                                <i class="fa fa-thumbs-o-down fa-lg fa-fw" aria-hidden="true"></i>
                                            </a>

                                        {{-- user voted DOWN the quote --}}
                                        @else
                                            <a href="#" class="voteUp">
                                                <i class="fa fa-thumbs-o-up fa-lg fa-fw" aria-hidden="true"></i>
                                            </a>
                                            <span class="badge votecount">{{ $quote->votes()->sum('vote') }}</span>
                                            <a href="#" class="voteDown">
                                                <i class="fa fa-thumbs-down fa-lg fa-fw" aria-hidden="true"></i>
                                            </a>
                                        @endif

                                    {{-- user has no vote --}}
                                    @else
                                        <a href="#" class="voteUp">
                                            <i class="fa fa-thumbs-o-up fa-lg fa-fw" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Balsuok Patinka!"></i>
                                        </a>
                                        <span class="badge votecount">{{ $quote->votes()->sum('vote') }}</span>
                                        <a href="#" class="voteDown">
                                            <i class="fa fa-thumbs-o-down fa-lg fa-fw" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Balsuok Nepatinka!"></i>
                                        </a>
                                    @endif

                                @else {{-- not a user --}}
                                    <div class="text-right">
                                        <div class="btn-group btn-group-xs" role="group">
                                            <a href="{{ url('/login') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Prisijunk ir Balsuok!"><span class="badge"><strong> {{ $quote->votes()->sum('vote') }} </strong> </span><strong>&nbsp; Prisijunk ir balsuok <i class="fa fa-thumbs-o-up fa-lg fa-fw" aria-hidden="true"></i></strong>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                            </p>
                        </blockquote>
                    @endforeach
                @endif
            </div>

            <div>
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>
        </div>{{-- /col-md-8 --}}

        <div class="col-md-4">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>           
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            @if(count($category->quotes) > 0)
                                <a href="{{ route('submissions.categories.name', ['slug' => $category->slug]) }}" class="list-group-item list-group-item-default">
                                <span class="badge">{{ $category->quotes()->NotApproved()->count() }}</span>
                                <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                                <p class="list-group-item-text">{{ $category->description }}</p></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>{{-- /panel --}}

            <div class="well">
                <form class="form" method="POST" action="{{ route('submissions.authors.select') }}">
                {{ csrf_field() }}
                    <div class="form-group input-group-lg {{ $errors->has('author_id') ? ' has-error' : '' }}">
                        <label class="control-label" for="author_id"><h4>Filtruoti pagal autorių:</h4></label>
                        <select id="author_id" class="form-control select2 input-lg" name="author_id">
                            <option> </option>
                            @foreach ($authors as $author)
                                @if(count($author->quotes) > 0)
                                    <option value="{{ $author->id }}">{{ $author->name }} ({{ $author->quotes()->NotApproved()->count() }})</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-fw fa-filter"></i> Filtruoti
                    </button>
                </form>
            </div>{{-- /well --}}

        </div>{{-- /col-md-4 --}}
    </div>{{-- /row --}}
</div>
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
    <script type="text/javascript" src="{{ URL::to('src/js/vote.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlVote = '{{ route('submissions.vote') }}';
    </script>
@endsection
