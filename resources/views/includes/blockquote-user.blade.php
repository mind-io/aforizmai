            <div>
                @foreach ($quotes as $quote)

                    <blockquote>

                        {{-- Quote content --}}
                        <p>{{ $quote->quote }}</p> 
                        <cite>
                            <a href="{{ route('user.quote.collection.author', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                            <a href="{{ route('user.quote.collection.category', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                        </cite>

                        {{-- Quote fa buttons --}}
                        <p align="right" data-quoteid="{{ $quote->id }}">

                            {{-- Checking if the user has like --}}
                            {{-- @if(Auth::user()->likes()->where('quote_id', $quote->id)->first() ) --}}
                                <span>{{ $quote->likes_count }}</span>
                                <a href="#" class="like">
                                    <i class="fa fa-heart fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Išmesti iš kolekcijos..."></i>
                                </a>

                            {{-- user has no like --}}
{{--                             @else
                                <span>{{ $quote->likes_count }}</span>
                                <a href="#" class="like">
                                    <i class="fa fa-heart-o fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                                </a>
                            @endif --}}
                            
                        </p>{{-- //fa buttons paragraph --}}

                    </blockquote>
                    
                @endforeach
            </div>