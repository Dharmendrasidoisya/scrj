<div class="col-lg-3 col-md-3">
    <h4 class="text-color-dark font-weight-bold mb-3 widget-title mb-30 wow fadeIn animated">{{ $config['name'] }}</h4>
    {!!
        Menu::generateMenu(['slug' => $config['menu_id'], 'options' => ['class' => 'footer-list wow fadeIn animated mb-sm-5 mb-md-0']])
    !!}
</div>
