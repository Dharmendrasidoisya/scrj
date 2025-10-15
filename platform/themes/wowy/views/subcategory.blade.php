


@include(Theme::getThemeNamespace() . '::views.templates.serposts', [
    'children' => $category->activeChildren->where('parent_id', $category->id)
])

{{-- @include(Theme::getThemeNamespace() . '::views.templates.serposts',['children' => $category->activeChildren]) --}}

