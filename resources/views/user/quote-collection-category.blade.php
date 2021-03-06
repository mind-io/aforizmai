@extends('layouts.master')

@section('title')
    Mano kolekcija - {{ $slug->name }}
@endsection

@section('content')
<div class="container">

    <div class="row">

        {{-- Left col --}}
        <div class="col-md-8 left-column">

            {{-- Header --}}
            <div>
                <h3>{{ $slug->name }} 
                    <span class="badge">&nbsp;Aforizmų: {{ $slug->quotes_count }}&nbsp;</span>
                    <br><small>{{ $slug->description }}</small>
                </h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('user.quote.collection.index') }}">Mano kolekcija</a></li>
                  <li class="active">{{ $slug->name }}</li>
                </ol>
            </div>

            <!-- Blockquote include -->
            @foreach ($quotes as $quote)
                @include('includes.blockquote-user')
            @endforeach

            {{-- Pagination --}}
            <div class="paginate">
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /Left col-md-8 --}}

        {{-- Right col --}}
        <div class="col-md-4 right-column">

			{{-- Quote categories panel --}}
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-lg fa-bookmark-o" aria-hidden="true"></i> Aforizmų temos</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            <a href="{{ route('user.quote.collection.category', ['slug' => $category->slug]) }}" 
                                @if (Request::segment(4) == $category->slug)
                                    class="list-group-item list-group-item-info disabled"
                                @else
                                    class="list-group-item list-group-item-default"
                                @endif
                            >
                            <span class="badge">{{ $category->quotes_count }}</span>
                            <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                            <p class="list-group-item-text">{{ $category->description }}</p></a>
                        @endforeach
                    </div>
                </div>
            </div>{{-- /Categories panel --}}

        </div>{{-- /Right col-md-4 --}}
    </div>{{-- /row --}}
</div>{{-- /container --}}
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ URL::to('js/like.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like.quote') }}';
    </script>

@endsection
