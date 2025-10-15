<?php

namespace Botble\Projects\Projects;

use Botble\ACL\Models\User;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Projects\Forms\TagForm;
use Botble\Projects\Models\Post;
use Botble\Projects\Models\Tag;
use Botble\Projects\Projects\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTagService extends StoreTagServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $projectstagsInput = $request->input('stag');

        if (! $projectstagsInput) {
            $projectstagsInput = [];
        } else {
            $projectstagsInput = collect(json_decode($projectstagsInput, true))->pluck('value')->all();
        }

        $projectstags = $post->projectstags->pluck('name')->all();

        if (count($projectstags) != count($projectstagsInput) || count(array_diff($projectstags, $projectstagsInput)) > 0) {
            $post->projectstags()->detach();
            foreach ($projectstagsInput as $tagName) {
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
                    $post->projectstags()->attach($stag->id);
                }
            }
        }
    }
}
