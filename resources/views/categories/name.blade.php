@extends('layouts.master')

@section('title')
        Kategorija - {{ $slug->name }}
@endsection

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-8" style="padding-left: 30px;">

            {{-- Header --}}
            <div>
                <h3>{{ $slug->name }} 
                    <span class="badge">&nbsp;Aforizmų: {{ $slug->quotes()->Approved()->count() }}&nbsp;</span>
                    <br><small>{{ $slug->description }}</small>
                </h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('categories.index') }}">Kategorijos</a></li>
                  <li class="active">{{ $slug->name }}</li>
                </ol>
            </div>
 
            <!-- Blockquote include -->
            @include('includes.blockquote')

            {{-- Pagination --}}
            <div>
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /col-md-8 --}}

        <div class="col-md-4" style="padding-left: 30px; margin-top:21px;">

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            @if(count($category->quotes) > 0)
                                <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" 
                                    @if (Request::segment(2) == $category->slug)
                                        class="list-group-item list-group-item-success disabled"
                                    @else
                                        class="list-group-item list-group-item-default"
                                    @endif
                                >
                                <span class="badge">{{ $category->quotes_count }}</span>
                                <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                                <p class="list-group-item-text">{{ $category->description }}</p></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>{{-- /panel --}}

        </div>{{-- /col-md-4 --}}
    </div>{{-- /row --}}
</div>{{-- /container --}}
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ URL::to('src/js/like.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like.quote') }}';
    </script>

@endsection