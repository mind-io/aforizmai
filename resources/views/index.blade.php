@extends('layouts.master')

@section('title')
    Pagrindinis puslapis
@endsection

@section('content')
<div class="container">
    <div class="row">

        {{-- Left column --}}
        <div class="col-md-5 left-column">
                <h1>Dienos aforizmas:</h1>
                @if (isset($randomQuote) ? $quote = $randomQuote : "" )
                    @include('includes.blockquote-random')
                @endif
        </div>{{-- // Left column --}}

        {{-- Right column --}}
        <div class="col-md-7 right-column">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#new-quotes" aria-controls="new-quotes" role="tab" data-toggle="tab">Naujausi aforizmai</a></li>
                <li role="presentation"><a href="#popular-quotes" aria-controls="popular-quotes" role="tab" data-toggle="tab">Populiarūs aforizmai</a></li>
            </ul>
            {{-- Tabs --}}
            <div class="tab-content">

                <!-- Tab "new-quotes" -->
                <div role="tabpanel" class="tab-pane fade-in active" id="new-quotes">
                    <div>
                        @forelse ($newQuotes as $quote)
                            @include('includes.blockquote-submission')
                        @empty
                            <br><p>Nėra naujų aforizmų...</p>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            <a class="btn btn-primary btn-sm" href="{{ route('submissions.index') }}"> Visi nauji aforizmai</a>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div><!-- /Tab "new-quotes" -->

                <!-- Tab "popular-quotes" -->
                <div role="tabpanel" class="tab-pane fade in" id="popular-quotes">
                    <div>
                        @forelse ($popularQuotes as $quote)
                            @include('includes.blockquote')
                        @empty
                            <br><p>Nėra populiarių aforizmų...</p>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-xs-3"></div>
                        <div class="col-xs-6">
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary btn-sm" type="button" role="button" href="{{ route('category.index') }}"> Visi pagal temą</a>
                                <a class="btn btn-success btn-sm" type="button" role="button" href="{{ route('author.index') }}"> Visi pagal autorių</a>
                            </div>
                        </div>
                        <div class="col-xs-3"></div>
                    </div>
                </div><!-- /Tab "popular-quotes" -->

            </div><!-- /Tabs -->

        </div><!-- /right column -->

    </div><!-- /row -->
</div><!-- /container -->
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ URL::to('src/js/like.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('src/js/vote.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like.quote') }}';
        var urlVote = '{{ route('submissions.vote') }}';
    </script>

@endsection

