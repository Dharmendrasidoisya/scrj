<?php

namespace Botble\Solution\Services;

use Botble\ACL\Models\User;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Solution\Forms\TagForm;
use Botble\Solution\Models\Post;
use Botble\Solution\Models\Tag;
use Botble\Solution\Services\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTagService extends StoreTagServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $stagsInput = $request->input('stag');

        if (! $stagsInput) {
            $stagsInput = [];
        } else {
            $stagsInput = collect(json_decode($stagsInput, true))->pluck('value')->all();
        }

        $stags = $post->stags->pluck('name')->all();

        if (count($stags) != count($stagsInput) || count(array_diff($stags, $stagsInput)) > 0) {
            $post->stags()->detach();
            foreach ($stagsInput as $tagName) {
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
                    $post->stags()->attach($stag->id);
                }
            }
        }
    }
}
