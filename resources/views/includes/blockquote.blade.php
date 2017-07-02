            <div>
                @foreach ($quotes as $quote)

                    <blockquote>

                        {{-- Quote content --}}
                        <p>{{ $quote->quote }}</p> 
                        <cite>
                            <a href="{{ route('authors.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                            <a href="{{ route('categories.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                        </cite>

                        {{-- Quote buttons --}}
                        <p align="right" data-quoteid="{{ $quote->id }}">

                            @if(Auth::user()) {{-- is a user --}}
                                {{-- Checking if the user has like --}}
                                @if(Auth::user()->likes()->where('quote_id', $quote->id)->first() )
                                    <span>{{ $quote->likes_count }}</span>
                                    <a href="#" class="like">
                                        <i class="fa fa-heart fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                                    </a>
                                {{-- user has no like --}}
                                @else
                                    <span>{{ $quote->likes_count }}</span>
                                    <a href="#" class="like">
                                        <i class="fa fa-heart-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                                    </a>
                                @endif
                            @else {{-- is not a user --}}
{{--                                 15<a href="#">
                                    <i class="fa fa-comment-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Komentuoti..."></i>
                                </a> --}}
                                <span>{{ $quote->likes_count }}</span>
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-heart-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Prisijunk ir sukurk savo kolekciją..."></i>
                                </a>
                            @endif

                        </p>{{-- // fa buttons paragraph --}}

                    </blockquote>
                    
                @endforeach
            </div>