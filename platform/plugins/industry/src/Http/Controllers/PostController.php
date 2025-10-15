<?php

namespace Botble\Industry\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\Breadcrumb;
use Botble\Industry\Forms\PostForm;
use Botble\Industry\Http\Requests\PostRequest;
use Botble\Industry\Models\Post;
use Botble\Industry\Industry\StoreCategoryService;
use Botble\Industry\Industry\StoreTagService;
use Botble\Industry\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Theme\Facades\Theme;

class PostController extends BaseController
{

    public function show($id)
    {
        // Fetch the specific industrypost from the database
        $post = DB::table('industryposts')->where('id', $id)->where('status', 'published')->first();
        $industrycategories = DB::table('industrycategories')->where('parent_id', $id)->get();
    
        if (!$post) {
            abort(404); // Show 404 page if post not found
        }
    
        return Theme::scope('industryposts', compact('post','industrycategories'))->render();
    }

    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/industry::base.menu_name'))
            ->add(trans('plugins/industry::posts.menu_name'), route('industryposts.index'));
    }

    public function index(PostTable $dataTable)
    {
        $this->pageTitle(trans('plugins/industry::posts.menu_name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/industry::posts.create'));

        return PostForm::create()->renderForm();
    }

    public function store(
        PostRequest $request,
        Storetagservice $industrytagservice,
        StoreCategoryService $categoryService
    ) {
        $postForm = PostForm::create();

        $postForm->saving(function (PostForm $form) use ($request, $industrytagservice, $categoryService) {
            $form
                ->getModel()
                ->fill([
                    ...$request->input(),
                    'author_id' => Auth::guard()->id(),
                    'author_type' => User::class,
                ])
                ->save();

            $post = $form->getModel();

            $form->fireModelEvents($post);

            $industrytagservice->execute($request, $post);

            $categoryService->execute($request, $post);
        });

        return $this
            ->httpResponse()
            ->setPreviousRoute('industryposts.index')
            ->setNextRoute('industryposts.edit', $postForm->getModel()->getKey())
            ->withCreatedSuccessMessage();
    }

    public function edit(Post $post)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $post->name]));

        return PostForm::createFromModel($post)->renderForm();
    }

    public function update(
        Post $post,
        PostRequest $request,
        Storetagservice $industrytagservice,
        StoreCategoryService $categoryService,
    ) {
        PostForm::createFromModel($post)
            ->setRequest($request)
            ->saving(function (PostForm $form) use ($categoryService, $industrytagservice) {
                $request = $form->getRequest();

                $post = $form->getModel();
                $post->fill($request->input());
                $post->save();

                $form->fireModelEvents($post);

                $industrytagservice->execute($request, $post);

                $categoryService->execute($request, $post);
            });

        return $this
            ->httpResponse()
            ->setPreviousRoute('industryposts.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Post $post)
    {
        return DeleteResourceAction::make($post);
    }

    public function getWidgetRecentindustryposts(Request $request): BaseHttpResponse
    {
        $limit = $request->integer('paginate', 10);
        $limit = $limit > 0 ? $limit : 10;

        $industryposts = Post::query()
            ->with(['slugable'])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();

        return $this
            ->httpResponse()
            ->setData(view('plugins/industry::widgets.industryposts', compact('industryposts', 'limit'))->render());
    }
}
