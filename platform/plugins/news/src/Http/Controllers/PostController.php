<?php

namespace Botble\News\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\Breadcrumb;
use Botble\News\Forms\PostForm;
use Botble\News\Http\Requests\PostRequest;
use Botble\News\Models\Post;
use Botble\News\News\StoreCategoryService;
use Botble\News\News\StoreTagService;
use Botble\News\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Theme\Facades\Theme;

class PostController extends BaseController
{

    public function show($id)
    {
        // Fetch the specific newspost from the database
        $post = DB::table('newsposts')->where('id', $id)->where('status', 'published')->first();
        $newscategories = DB::table('newscategories')->where('parent_id', $id)->get();
    
        if (!$post) {
            abort(404); // Show 404 page if post not found
        }
    
        return Theme::scope('newsposts', compact('post','newscategories'))->render();
    }

    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/news::base.menu_name'))
            ->add(trans('plugins/news::posts.menu_name'), route('newsposts.index'));
    }

    public function index(PostTable $dataTable)
    {
        $this->pageTitle(trans('plugins/news::posts.menu_name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/news::posts.create'));

        return PostForm::create()->renderForm();
    }

    public function store(
        PostRequest $request,
        Storetagservice $newstagservice,
        StoreCategoryService $categoryService
    ) {
        $postForm = PostForm::create();

        $postForm->saving(function (PostForm $form) use ($request, $newstagservice, $categoryService) {
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

            $newstagservice->execute($request, $post);

            $categoryService->execute($request, $post);
        });

        return $this
            ->httpResponse()
            ->setPreviousRoute('newsposts.index')
            ->setNextRoute('newsposts.edit', $postForm->getModel()->getKey())
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
        Storetagservice $newstagservice,
        StoreCategoryService $categoryService,
    ) {
        PostForm::createFromModel($post)
            ->setRequest($request)
            ->saving(function (PostForm $form) use ($categoryService, $newstagservice) {
                $request = $form->getRequest();

                $post = $form->getModel();
                $post->fill($request->input());
                $post->save();

                $form->fireModelEvents($post);

                $newstagservice->execute($request, $post);

                $categoryService->execute($request, $post);
            });

        return $this
            ->httpResponse()
            ->setPreviousRoute('newsposts.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Post $post)
    {
        return DeleteResourceAction::make($post);
    }

    public function getWidgetRecentnewsposts(Request $request): BaseHttpResponse
    {
        $limit = $request->integer('paginate', 10);
        $limit = $limit > 0 ? $limit : 10;

        $newsposts = Post::query()
            ->with(['slugable'])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();

        return $this
            ->httpResponse()
            ->setData(view('plugins/news::widgets.newsposts', compact('newsposts', 'limit'))->render());
    }
}
