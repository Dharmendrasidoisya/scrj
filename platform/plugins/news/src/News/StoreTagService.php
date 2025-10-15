<?php

namespace Botble\News\News;

use Botble\ACL\Models\User;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\News\Forms\TagForm;
use Botble\News\Models\Post;
use Botble\News\Models\Tag;
use Botble\News\News\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTagService extends StoreTagServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $newstagsInput = $request->input('stag');

        if (! $newstagsInput) {
            $newstagsInput = [];
        } else {
            $newstagsInput = collect(json_decode($newstagsInput, true))->pluck('value')->all();
        }

        $newstags = $post->newstags->pluck('name')->all();

        if (count($newstags) != count($newstagsInput) || count(array_diff($newstags, $newstagsInput)) > 0) {
            $post->newstags()->detach();
            foreach ($newstagsInput as $tagName) {
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
                    $post->newstags()->attach($stag->id);
                }
            }
        }
    }
}
