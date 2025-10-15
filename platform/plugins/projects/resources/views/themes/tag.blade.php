<div>
    <h3>{{ $stag->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>

<div>
    @if ($projectsposts->isNotEmpty())
        @foreach ($projectsposts as $post)
            <article>
                <div>
                    <a href="{{ $post->url }}"><img
                            src="{{ RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()) }}"
                            alt="{{ $post->name }}"
                        ></a>
                </div>
                <div>
                    <header>
                        <h3><a href="{{ $post->url }}">{{ $post->name }}</a></h3>
                        <div>
                            {{ $post->created_at->format('M d, Y') }} - <span>{{ $post->author->name }}</span>>
                            @if ($post->projectscategories->first())
                                <a
                                    href="{{ $post->projectscategories->first()->url }}">{{ $post->projectscategories->first()->name }}</a>
                            @endif
                        </div>
                    </header>
                    <div>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
            </article>
        @endforeach
        <div>
            {!! $projectsposts->links() !!}
        </div>
    @else
        <div>
            <p>{{ __('There is no data to display!') }}</p>
        </div>
    @endif
</div>
