<div role="tabpanel" class="tab-pane fade-in active" id="news">
    <div>
        @foreach ($quotes as $quote)
            <blockquote>
                <p>{{ $quote->quote }}</p> 
                <cite>
                    <a href="{{ route('authors.name', ['slug' => $quote->author->slug]) }}">{{ $quote->author->name }}</a> |
                    <a href="{{ route('categories.name', ['slug' => $quote->category->slug]) }}">{{ $quote->category->name }}</a>
                </cite>
                <p align="right">
                    <a href="#">
                        <i class="fa fa-comment-o fa-hover-hidden fa-lg fa-fw"></i>
                        <i class="fa fa-comment fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Komentuoti..."></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-heart-o fa-hover-hidden fa-lg fa-fw"></i>
                        <i class="fa fa-heart fa-hover-show fa-lg fa-fw" data-toggle="tooltip" data-placement="top" title="Pridėti į kolekciją..."></i>
                    </a>
                </p>
            </blockquote>
        @endforeach
    </div>
    <div>
        <nav>
            <ul class="pagination">
                {{ $quotes->links() }}
            </ul>
        </nav>
    </div>

</div><!-- /Tab "news" -->
