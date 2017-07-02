                <div role="tabpanel" class="tab-pane fade in" id="top50-likes">

                   {{-- Quote div --}}
                    <div>
                        @foreach ($likedQuotes as $quote)

                            <blockquote>

                                {{-- Quote content --}}
                                <p>{{ $quote->quote }}</p> 
                                <cite>
                                    <a href="{{ route('author.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                                    <a href="{{ route('category.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                                </cite>

                                {{-- Quote buttons --}}
                                <p align="right" data-quoteid="{{ $quote->id }}">

                                    @if(Auth::user()) {{-- is a user --}}
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
                                    @else {{-- is not a user --}}
        {{--                                 15<a href="#">
                                            <i class="fa fa-comment-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Komentuoti..."></i>
                                        </a> --}}
                                        <span>{{ $quote->likes()->count('like') }}</span>
                                        <a href="{{ url('/login') }}">
                                            <i class="fa fa-heart-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Prisijunk ir sukurk savo kolekciją..."></i>
                                        </a>
                                    @endif

                                </p>{{-- // fa buttons paragraph --}}

                            </blockquote>
                            
                        @endforeach
                    </div>{{-- // Quote div --}}


                    {{-- Pagination --}}
                    <div>
                        <nav>
                            <ul class="pagination">
                                {{ $likedQuotes->links() }}
                            </ul>
                        </nav>
                    </div>

                </div><!-- /Tab "top50-likes" -->
