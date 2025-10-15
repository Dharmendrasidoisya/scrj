<?php

namespace Botble\Solution\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\Solution\Forms\TagForm;
use Botble\Solution\Http\Requests\TagRequest;
use Botble\Solution\Models\Tag;
use Botble\Solution\Tables\TagTable;
use Illuminate\Support\Facades\Auth;

class TagController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/solution::base.menu_name'))
            ->add(trans('plugins/solution::tags.menu'), route('stags.index'));
    }

    public function index(TagTable $dataTable)
    {
        $this->pageTitle(trans('plugins/solution::tags.menu'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/solution::tags.create'));

        return TagForm::create()->renderForm();
    }

    public function store(TagRequest $request)
    {
        $form = TagForm::create();

        $form
            ->saving(function (TagForm $form) use ($request) {
                $form
                    ->getModel()
                    ->fill([...$request->validated(),
                        'author_id' => Auth::guard()->id(),
                        'author_type' => User::class,
                    ])
                    ->save();
            });

        return $this
            ->httpResponse()
            ->setPreviousRoute('stags.index')
            ->setNextRoute('stags.edit', $form->getModel()->getKey())
            ->withCreatedSuccessMessage();
    }

    public function edit(Tag $stag)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $stag->name]));

        return TagForm::createFromModel($stag)->renderForm();
    }

    public function update(Tag $stag, TagRequest $request)
    {
        TagForm::createFromModel($stag)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('stags.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Tag $stag)
    {
        return DeleteResourceAction::make($stag);
    }

    public function getAllstags()
    {
        return Tag::query()->pluck('name')->all();
    }
}
