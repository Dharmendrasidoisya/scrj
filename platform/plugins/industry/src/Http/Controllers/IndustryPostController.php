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

use Botble\Industry\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Base\Facades\BaseHelper;

use Botble\Industry\Repositories\Interfaces\PostInterface;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
class IndustryPostController extends BaseController
{
    public function show($id)
    {
        $category = DB::table('industrycategories')->where('id', $id)->first();
        // $categoryposts = DB::table('industryposts')->where('id', $id)->first();
        // Get all post IDs related to this category
        $postIds = DB::table('post_categories')
            ->where('post_id', $id)
            ->pluck('post_id'); // Get only post IDs as an array
        // dd($postIds);

        $industrycategories = DB::table('industrycategories')->where('id', $id)->get();
        // dd($industrycategories);
        // Fetch posts that match the retrieved post IDs
        $posts = DB::table('industryposts')
        ->whereNotIn('id', $postIds) // Exclude records with IDs in $postIds
        ->orderBy('id', 'desc') // Order by ID in descending order
        ->limit(4) // Limit the result to 4 records
        ->get();
    
       

        // Fetch the post details by ID
        $post = DB::table('industryposts')->where('id', $id)->first();
        $postImages = $post->image ? json_decode($post->image) : [];
        if (!$post) {
            return abort(404); // Show 404 page if post not found
        }
        $industrycategories = DB::table('industrycategories')
        ->where('is_featured', 1)
        ->get();
        // return view('service-post-details', compact('post'));
        return Theme::scope('service-post-details', compact('post','postImages','posts','industrycategories'))->render();
    }
   
    
}
