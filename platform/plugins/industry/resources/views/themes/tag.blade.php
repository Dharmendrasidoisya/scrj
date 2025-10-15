<div>
    <h3>{{ $stag->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>

<div>
    @if ($industryposts->isNotEmpty())
        @foreach ($industryposts as $post)
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
                            @if ($post->industrycategories->first())
                                <a
                                    href="{{ $post->industrycategories->first()->url }}">{{ $post->industrycategories->first()->name }}</a>
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
            {!! $industryposts->links() !!}
        </div>
    @else
        <div>
            <p>{{ __('There is no data to display!') }}</p>
        </div>
    @endif
</div>
