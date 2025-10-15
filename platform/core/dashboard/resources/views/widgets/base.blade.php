<?php
$projectsposts = DB::table('projectsposts')
    ->select('name', 'created_at')
    ->distinct()
    ->paginate(10);
$contacts = DB::table('contacts')
    ->distinct()
    ->paginate(10);
    // dd($widgetSetting);
    // $widget = DB::table('dashboard_widgets')->get();
    // dd($widget);

// use Botble\Dashboard\Models\DashboardWidget;

    // $widget = DashboardWidget::where('name', $this->key)->first();
    
    // dd($widget);
?>

@if (empty($widgetSetting) || $widgetSetting->status == 1)
    <div
        @class(['widget-item col-12 d-flex', $widget->column])
        id="{{ $widget->name }}"
        data-url="{{ $widget->route }}">

        <x-core::card size="sm" @class([
            'flex-fill',
            'widget-load-has-callback' => $widget->hasLoadCallback,
        ])>
            <x-core::card.header>
                <x-core::card.title>
                    {{-- {{ $widget->title }} --}}
                    Recent Blog Posts
                </x-core::card.title>

                <x-core::card.actions class="btn-actions">
                    @if (Arr::get($settings, 'show_predefined_ranges', false) && count($predefinedRanges))
                        <x-core::dropdown wrapper-class="d-flex align-items-center me-2 predefined_range">
                            <x-slot:trigger>
                                <a
                                    class="dropdown-toggle text-muted"
                                    href="#"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    {{ ($selectedRange = Arr::get($settings, 'predefined_range')) ? Arr::get(Arr::first($predefinedRanges, fn($item) => $item['key'] === $selectedRange), 'label') : Arr::get(Arr::first($predefinedRanges), 'label') }}
                                </a>
                            </x-slot:trigger>

                            @foreach ($predefinedRanges as $range)
                                <x-core::dropdown.item
                                    :label="$range['label']"
                                    :active="$selectedRange === $range['key']"
                                    data-key="{{ $range['key'] }}"
                                    data-label="{{ $range['label'] }}"
                                />
                            @endforeach
                        </x-core::dropdown>
                    @endif
                </x-core::card.actions>
            </x-core::card.header>

            <div
                @class([
                    'd-flex flex-column justify-content-between h-100 widget-content',
                    $widget->bodyClass,
                    Arr::get($settings, 'state'),
                ])
                style="min-height: 10rem;">
                
                

            </div>
            <!-- Add Product List Table -->
            
        </x-core::card>
    </div>
@endif

@if (empty($widgetSetting) || $widgetSetting->status == 1)
    <div
        @class(['widget-item col-12 d-flex', $widget->column])
        id="{{ $widget->name }}"
        data-url="{{ $widget->route }}">

        <x-core::card size="sm" @class([
            'flex-fill',
            'widget-load-has-callback' => $widget->hasLoadCallback,
        ])>
            <x-core::card.header>
                <x-core::card.title>
                    Recent Projects Posts
                </x-core::card.title>
            </x-core::card.header>

            <div
                @class([
                    'd-flex flex-column justify-content-between h-100 widget-content',
                    $widget->bodyClass,
                    Arr::get($settings, 'state'),
                ])
                style="min-height: 10rem;">

                <div class="recent-posts">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projectsposts  as $key =>$product)
                                <tr>
                                   
                                    <td>
                                           <span>{!! $product->name !!}</span> 
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">
                                        No products found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                   
                </div>

            </div>
        </x-core::card>
    </div>
@endif

@if (empty($widgetSetting) || $widgetSetting->status == 1)
    <div class="widget-item col-12 d-flex col-md-12 col-sm-12"
        id="{{ $widget->name }}"
        data-url="{{ $widget->route }}">

        <x-core::card size="sm" @class([
            'flex-fill',
            'widget-load-has-callback' => $widget->hasLoadCallback,
        ])>
            <x-core::card.header>
                <x-core::card.title>
                    Recent Contact Us 
                </x-core::card.title>
            </x-core::card.header>

            <div
                @class([
                    'd-flex flex-column justify-content-between h-100 widget-content',
                    $widget->bodyClass,
                    Arr::get($settings, 'state'),
                ])
                style="min-height: 10rem;">

                <div class="recent-posts">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts  as $key =>$product)
                                <tr>
                                   
                                    <td>
                                           <span>{!! $product->name !!}</span> 
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">
                                        No products found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                   
                </div>

            </div>
        </x-core::card>
    </div>
@endif



<style>
    .recent-posts ul {
    max-height: 300px; /* Limit the height of the list */
    overflow-y: auto; /* Add vertical scrolling if the content exceeds the height */
    padding: 0;
    margin: 0;
    list-style: none; /* Remove default list styling */
}

.recent-posts .list-group-item {
    display: flex;
    justify-content: space-between; /* Align name and date on opposite sides */
    padding: 10px 15px; /* Add spacing inside each list item */
    font-size: 14px; /* Adjust font size */
    border: none; /* Remove default list item borders */
    border-bottom: 1px solid #f0f0f0; /* Add a light divider */
}

.recent-posts .list-group-item:last-child {
    border-bottom: none; /* Remove divider from the last item */
}

.recent-posts .list-group-item span.text-muted {
    font-size: 12px; /* Reduce the font size for the date */
    color: #6c757d; /* Muted text color */
}

</style>
