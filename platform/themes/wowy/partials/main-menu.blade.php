<ul class="nav nav-pills lfootermobile" id="mainNav" {!! $options !!}>
    @php $menu_nodes->loadMissing('metadata'); @endphp
    @foreach ($menu_nodes as $key => $row)
        <li class="{{ $row->css_class }} dropdown">
            @if ($row->has_child)
                <a href="{{ url($row->url) }}"
                    @if ($row->active) class="active nav-link dropdown-toggle colormenu"  @else class="mobilevcolor1 nav-link dropdown-toggle dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary py-lg-2 sizeuper " @endif
                    target="{{ $row->target }}">
                    @if ($iconImage = $row->getMetadata('icon_image', true))
                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="icon image" width="14" height="14"
                            style="vertical-align: middle; margin-top: -2px" />
                    @elseif ($row->icon_font)
                        <i class='{{ trim($row->icon_font) }}'></i>
                    @endif
                    {{ $row->title }}
                    @if ($row->has_child)
                        @if ($row->parent_id)
                            <i class="fa fa-chevron-right"></i>
                        @else
                            <i class="fa fa-chevron-down"></i>
                        @endif
                    @endif
                </a>
            @else
                <a href="{{ url($row->url) }}" style="color: #000;"
                    class=" dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary py-lg-2 sizeuper"
                    target="{{ $row->target }}">
                    {{ $row->title }}
                </a>
            @endif
            @if ($row->has_child)
                <ul class="dropdown-menu">
                    <li>
                        {!! Menu::generateMenu([
                            'menu' => $menu,
                            'view' => 'main-menu',
                            'options' => ['class' => $row->parent_id ? 'level-menu level-menu-modify' : 'sub-menu'],
                            'menu_nodes' => $row->child,
                        ]) !!}

                    </li>
                </ul>
            @endif
        </li>
    @endforeach

</ul>

<style>
    .sizeuper {
        text-transform: uppercase !important;
    }
    @media only screen and (max-width: 600px) {
        .mobilevcolor1 {
            background-color: #000 !important;
        }
		
    }
	  @media only screen and (max-width: 600px) {
        nav .flex-column:nth-of-type(2) {
        display: none !important;
    }
}
</style>
