<?php

namespace Botble\Industry\Widgets\Fronts;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Industry\Models\Category;
use Botble\Widget\AbstractWidget;
use Botble\Widget\Forms\WidgetForm;
use Illuminate\Support\Collection;

class industrycategories extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Industry industrycategories'),
            'description' => __('Widget display industry industrycategories'),
            'shortdescription' => __('Widget display industry industrycategories'),
            'number_display' => 10,
        ]);
    }

    protected function data(): array|Collection
    {
        if (! is_plugin_active('industry')) {
            return [];
        }

        $industrycategories = Category::query()
            ->wherePublished()
            ->with('slugable')
            ->take((int)$this->getConfig('number_display') ?: 10)
            ->get();

        return [
            'industrycategories' => $industrycategories,
        ];
    }

    protected function settingForm(): WidgetForm|string|null
    {
        if (! is_plugin_active('industry')) {
            return null;
        }

        return WidgetForm::createFromArray($this->getConfig())
            ->add('name', TextField::class, NameFieldOption::make()->toArray())
            ->add(
                'number_display',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Number industrycategories to display'))
                    ->toArray()
            );
    }
}
