<div class="sidebar-widget widget_categories mb-50">
    <div class="widget-header position-relative mb-20 pb-10">
        <h5 class="widget-title">{{ $config['name'] }}</h5>
    </div>
    <div class="post-block-list post-module-1 post-module-5">
        <ul>
            @foreach(app(\Botble\Services\Repositories\Interfaces\CategoryInterface::class)
            ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
            ->whereIn('parent_id', [0, null])
                        ->loadMissing(['slugable', 'activeChildren:id,name,parent_id', 'activeChildren.slugable']) as $category)
     <li class="@if (URL::current() == $category->url) current-menu-item @endif @if ($category->activeChildren->count()) menu-item-has-children @endif">
        <a href="{{ $category->url }}">{{ $category->name }}</a>
      
        @if ($category->activeChildren->count())
            @include(Theme::getThemeNamespace() . '::views.subcategory', ['children' => $category->activeChildren])
            {{-- @include(Theme::getThemeNamespace() . '::views.templates.serposts', ['servicescategories' => $servicescategory ?? collect()]) --}}
 
       
        @endif
    </li>
            @endforeach
        </ul>
    </div>
</div>
