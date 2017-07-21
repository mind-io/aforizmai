<div>
    <blockquote>

        {{-- Quote content --}}
        <p>{{ $quote->quote }}</p> 
        <cite>
            <a href="{{ route('user.quote.collection.author', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
            <a href="{{ route('user.quote.collection.category', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
        </cite>

        {{-- Quote fa buttons --}}
        <p align="right" data-quoteid="{{ $quote->id }}">
                <span>{{ $quote->likes_count }}</span>
                <a href="#" class="like">
                    <i class="fa fa-heart fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Išmesti iš kolekcijos..."></i>
                </a>
        </p>{{-- //fa buttons paragraph --}}

    </blockquote>
</div>