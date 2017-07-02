@extends('layouts.master')

@section('title')
    Kategorijos
@endsection

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-8 left-column">

            {{-- Header --}}
            <div>
                <h3>Aforizmai pagal temą <small>(visos temos)</small></h3>
            </div>

            {{-- Breadcrumb --}}
            <div>
                <ol class="breadcrumb" style="margin: 0px;">
                  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="{{ route('categories.index') }}">Kategorijos</a></li>
                  <li class="active">Visos kategorijos</li>
                </ol>
            </div>

            <!-- Blockquote include -->
            @include('includes.blockquote')

            {{-- Pagination --}}
            <div class="paginate">
                <nav>
                    <ul class="pagination">
                        {{ $quotes->links() }}
                    </ul>
                </nav>
            </div>

        </div>{{-- /col-md-8 --}}

        <div class="col-md-4 right-column">

{{--             <div class="list-group">
                <div class="list-group-item list-group-item-success"><h4><strong>Aforizmų temos</strong></h4></div>
                @foreach ($categories as $category)
                    @if(count($category->quotes) > 0)
                        <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" class="list-group-item list-group-item-default">
                        <span class="badge">{{ $category->quotes()->Approved()->count() }}</span>
                        <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                        <p class="list-group-item-text">{{ $category->description }}</p></a>
                    @endif
                @endforeach
            </div> --}}

            {{-- Quote categories panel --}}
            <div class="panel panel-success">

                <div class="panel-heading">
                    <h4>Aforizmų temos</h4>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            <a href="{{ route('categories.name', ['slug' => $category->slug]) }}" class="list-group-item">
                            <span class="badge">{{ $category->approved_quotes_count }}</span>
                            <h4 class="list-group-item-heading">{{ $category->name }}</h4>
                            <p class="list-group-item-text">{{ $category->description }}</p></a>
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
