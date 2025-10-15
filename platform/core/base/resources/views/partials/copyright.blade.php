{!! BaseHelper::clean(
    trans('core/base::layouts.copyright', [
        'year' => 2025,
        'company' => 'by <a href="https://www.goadsindia.com/" target="_blank">Go Ads India</a>',
        'version' => '1.24.1',
    ]),
    ['HTML.Allowed' => 'a[href|target]']
) !!}