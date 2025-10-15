<div>
    <h3>{{ $stag->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>

<div>
    @if ($sposts->isNotEmpty())
        @foreach ($sposts as $post)
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
                            @if ($post->scategories->first())
                                <a
                                    href="{{ $post->scategories->first()->url }}">{{ $post->scategories->first()->name }}</a>
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
            {!! $sposts->links() !!}
        </div>
    @else
        <div>
            <p>{{ __('There is no data to display!') }}</p>
        </div>
    @endif
</div>
