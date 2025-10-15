<?php

namespace Botble\Industry\Industry;

use Botble\ACL\Models\User;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Industry\Forms\TagForm;
use Botble\Industry\Models\Post;
use Botble\Industry\Models\Tag;
use Botble\Industry\Industry\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTagService extends StoreTagServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $industrytagsInput = $request->input('stag');

        if (! $industrytagsInput) {
            $industrytagsInput = [];
        } else {
            $industrytagsInput = collect(json_decode($industrytagsInput, true))->pluck('value')->all();
        }

        $industrytags = $post->industrytags->pluck('name')->all();

        if (count($industrytags) != count($industrytagsInput) || count(array_diff($industrytags, $industrytagsInput)) > 0) {
            $post->industrytags()->detach();
            foreach ($industrytagsInput as $tagName) {
                if (! trim($tagName)) {
                    continue;
                }

                $stag = Tag::query()->where('name', $tagName)->first();

                if ($stag === null && ! empty($tagName)) {
                    $form = TagForm::create();

                    $form
                        ->saving(function (TagForm $form) use ($tagName) {
                            $form
                                ->getModel()
                                ->fill([
                                    'name' => $tagName,
                                    'author_id' => Auth::guard()->check() ? Auth::guard()->id() : 0,
                                    'author_type' => User::class,
                                    'status' => BaseStatusEnum::PUBLISHED,
                                ])
                                ->save();

                            $form->setRequest($form->getRequest()->merge(['slug' => $tagName]));
                        });

                    $stag = $form->getModel();
                }

                if (! empty($stag)) {
                    $post->industrytags()->attach($stag->id);
                }
            }
        }
    }
}
