<?php

namespace Botble\Industry\Forms;

use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\RadioFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TagFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\RadioField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TagField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TreeCategoryField;
use Botble\Base\Forms\FormAbstract;
use Botble\Industry\Http\Requests\PostRequest;
use Botble\Industry\Models\Category;
use Botble\Industry\Models\Post;
use Botble\Industry\Models\Tag;

class PostForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Post::class)
            ->setValidatorClass(PostRequest::class)
            ->hasTabs()
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add(
                'is_featured',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('core/base::forms.is_featured'))
                    ->defaultValue(false)
                    ->toArray()
            )
            ->add('content', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->toArray())
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->when(get_post_formats(true), function (PostForm $form, array $postFormats) {
                if (count($postFormats) > 1) {
                    $choices = [];

                    foreach ($postFormats as $postFormat) {
                        $choices[$postFormat[0]] = $postFormat[1];
                    }

                    $form
                        ->add(
                            'format_type',
                            RadioField::class,
                            RadioFieldOption::make()
                                ->label(trans('plugins/industry::posts.form.format_type'))
                                ->choices($choices)
                                ->toArray()
                        );
                }
            })
            ->add(
                'industrycategories[]',
                TreeCategoryField::class,
                SelectFieldOption::make()
                    ->label(trans('plugins/industry::posts.form.industrycategories'))
                    ->choices(get_industrycategories_with_children())
                    ->when($this->getModel()->id, function (SelectFieldOption $fieldOption) {
                        return $fieldOption->selected($this->getModel()->industrycategories()->pluck('category_id')->all());
                    })
                    ->when(! $this->getModel()->id, function (SelectFieldOption $fieldOption) {
                        return $fieldOption
                            ->selected(Category::query()
                                ->where('is_default', 1)
                                ->pluck('id')
                                ->all());
                    })
                    ->toArray()
            )
            ->add('image', MediaImageField::class)
            ->add(
                'stag',
                TagField::class,
                TagFieldOption::make()
                    ->label(trans('plugins/industry::posts.form.industrytags'))
                    ->when($this->getModel()->id, function (TagFieldOption $fieldOption) {
                        return $fieldOption
                            ->selected(
                                $this->getModel()
                                ->industrytags()
                                ->select('name')
                                ->get()
                                ->map(fn (Tag $item) => $item->name)
                                ->implode(',')
                            );
                    })
                    ->placeholder(trans('plugins/industry::base.write_some_industrytags'))
                    ->ajaxUrl(route('industrytags.all'))
                    ->toArray()
            )
            ->setBreakFieldPoint('status');
    }
}
