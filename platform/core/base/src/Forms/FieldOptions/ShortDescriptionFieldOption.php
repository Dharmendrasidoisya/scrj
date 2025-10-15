<?php

namespace Botble\Base\Forms\FieldOptions;

class ShortDescriptionFieldOption extends TextareaFieldOption
{
    public static function make(): static
    {
        return parent::make()
            ->label(trans('core/base::forms.shortdescription'))
            ->placeholder(trans('core/base::forms.shortdescription_placeholder'))
            ->maxLength(400)
            ->rows(4);
    }
}
