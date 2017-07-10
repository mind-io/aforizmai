<blockquote>

    {{-- Quote content --}}
    <p>{{ $quote->quote }}</p>

    <cite>
        <a href="{{ route('submissions.author.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
        <a href="{{ route('submissions.category.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
    </cite>

    {{-- Quote buttons --}}
    <p align="right" data-quoteid="{{ $quote->id }}">

        @if(Auth::user()) {{-- is a user --}}

            {{-- Checking if the user has voted --}}
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

        @else {{-- is not a user --}}
            <div class="text-right">
                <div class="btn-group btn-group-xs" role="group">
                    <a href="{{ route('login') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Prisijunk ir Balsuok!"><span class="badge"><strong> {{ $quote->votes()->sum('vote') }} </strong> </span><strong>&nbsp;Prisijunk ir balsuok <i class="fa fa-thumbs-o-up fa-lg fa-fw" aria-hidden="true"></i></strong>
                    </a>
                </div>
            </div>
        @endif

    </p> {{-- // fa buttons paragraph --}}
</blockquote>