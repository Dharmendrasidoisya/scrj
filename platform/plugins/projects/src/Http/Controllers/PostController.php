<?php

namespace Botble\Projects\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\Breadcrumb;
use Botble\Projects\Forms\PostForm;
use Botble\Projects\Http\Requests\PostRequest;
use Botble\Projects\Models\Post;
use Botble\Projects\Projects\StoreCategoryService;
use Botble\Projects\Projects\StoreTagService;
use Botble\Projects\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Theme\Facades\Theme;

class PostController extends BaseController
{

    public function show($id)
    {
        // Fetch the specific projectspost from the database
        $post = DB::table('projectsposts')->where('id', $id)->where('status', 'published')->first();
        $projectscategories = DB::table('projectscategories')->where('parent_id', $id)->get();
    
        if (!$post) {
            abort(404); // Show 404 page if post not found
        }
    
        return Theme::scope('projectsposts', compact('post','projectscategories'))->render();
    }

    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/projects::base.menu_name'))
            ->add(trans('plugins/projects::posts.menu_name'), route('projectsposts.index'));
    }

    public function index(PostTable $dataTable)
    {
        $this->pageTitle(trans('plugins/projects::posts.menu_name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/projects::posts.create'));

        return PostForm::create()->renderForm();
    }

    public function store(
        PostRequest $request,
        Storetagservice $projectstagservice,
        StoreCategoryService $categoryService
    ) {
        $postForm = PostForm::create();

        $postForm->saving(function (PostForm $form) use ($request, $projectstagservice, $categoryService) {
            $input = $request->input();
            $input['images'] = array_values(array_filter($input['images'] ?? []));
            $data['images'] = json_encode($request->input('images', []));
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

            $projectstagservice->execute($request, $post);

            $categoryService->execute($request, $post);
        });

        return $this
            ->httpResponse()
            ->setPreviousRoute('projectsposts.index')
            ->setNextRoute('projectsposts.edit', $postForm->getModel()->getKey())
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
        Storetagservice $projectstagservice,
        StoreCategoryService $categoryService,
    ) {
        PostForm::createFromModel($post)
            ->setRequest($request)
            ->saving(function (PostForm $form) use ($categoryService, $projectstagservice) {
                $request = $form->getRequest();

                $input = $request->input();
                $input['images'] = array_values(array_filter($input['images'] ?? []));
                $data['images'] = json_encode($request->input('images', []));
                $post = $form->getModel();
                $post->fill($input);
                $post->save();

                $form->fireModelEvents($post);

                $projectstagservice->execute($request, $post);

                $categoryService->execute($request, $post);
            });

        return $this
            ->httpResponse()
            ->setPreviousRoute('projectsposts.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Post $post)
    {
        return DeleteResourceAction::make($post);
    }

    public function getWidgetRecentprojectsposts(Request $request): BaseHttpResponse
    {
        $limit = $request->integer('paginate', 10);
        $limit = $limit > 0 ? $limit : 10;

        $projectsposts = Post::query()
            ->with(['slugable'])
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();

        return $this
            ->httpResponse()
            ->setData(view('plugins/projects::widgets.projectsposts', compact('projectsposts', 'limit'))->render());
    }
}
