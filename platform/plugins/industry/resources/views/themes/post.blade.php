<div>
    <h3>{{ $post->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<header>
    <h3>{{ $post->name }}</h3>
    <div>
        @if ($post->industrycategories->isNotEmpty())
            <span>
                <a href="{{ $post->industrycategories->first()->url }}">{{ $post->industrycategories->first()->name }}</a>
            </span>
        @endif
        <span>{{ $post->created_at->format('M d, Y') }}</span>

        @if ($post->industrytags->isNotEmpty())
            <span>
                @foreach ($post->industrytags as $stag)
                    <a href="{{ $stag->url }}">{{ $stag->name }}</a>
                @endforeach
            </span>
        @endif
    </div>
</header>
<div class='ck-content'>
    {!! BaseHelper::clean($post->content) !!}
</div>
<br />
{!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}

@php $relatedindustryposts = get_related_industryposts($post->getKey(), 2); @endphp

@if ($relatedindustryposts->isNotEmpty())
    <footer>
        @foreach ($relatedindustryposts as $relatedItem)
            <div>
                <article>
                    <div><a href="{{ $relatedItem->url }}"></a>
                        <img
                            src="{{ RvMedia::getImageUrl($relatedItem->image, null, false, RvMedia::getDefaultImage()) }}"
                            alt="{{ $relatedItem->name }}"
                        >
                    </div>
                    <header><a href="{{ $relatedItem->url }}"> {{ $relatedItem->name }}</a></header>
                </article>
            </div>
        @endforeach
    </footer>
@endif
