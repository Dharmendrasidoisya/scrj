<?php

use Botble\Widget\AbstractWidget;

class ServicesCategoriesWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Services Categories'),
            'description' => __('Widget display services categories'),
            'number_display' => 10,
        ]);
    }
}
