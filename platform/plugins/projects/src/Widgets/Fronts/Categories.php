<?php

namespace Botble\Projects\Widgets\Fronts;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Projects\Models\Category;
use Botble\Widget\AbstractWidget;
use Botble\Widget\Forms\WidgetForm;
use Illuminate\Support\Collection;

class projectscategories extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Projects projectscategories'),
            'description' => __('Widget display projects projectscategories'),
            'shortdescription' => __('Widget display projects projectscategories'),
            'number_display' => 10,
        ]);
    }

    protected function data(): array|Collection
    {
        if (! is_plugin_active('projects')) {
            return [];
        }

        $projectscategories = Category::query()
            ->wherePublished()
            ->with('slugable')
            ->take((int)$this->getConfig('number_display') ?: 10)
            ->get();

        return [
            'projectscategories' => $projectscategories,
        ];
    }

    protected function settingForm(): WidgetForm|string|null
    {
        if (! is_plugin_active('projects')) {
            return null;
        }

        return WidgetForm::createFromArray($this->getConfig())
            ->add('name', TextField::class, NameFieldOption::make()->toArray())
            ->add(
                'number_display',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Number projectscategories to display'))
                    ->toArray()
            );
    }
}
