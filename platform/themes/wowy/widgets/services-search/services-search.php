<?php

use Botble\Widget\AbstractWidget;

class ServicesSearchWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Services Search'),
            'description' => __('Search services posts'),
        ]);
    }
}
