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

use Botble\Projects\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Base\Facades\BaseHelper;

use Botble\Projects\Repositories\Interfaces\PostInterface;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;

class ProjectsCategoryController extends BaseController
{

    public function subcategory($id)
    {
        // `projectscategories` ટેબલમાંથી parent_id ના આધારે ડેટા લાવો
        $projectscategory = DB::table('projectscategories')->where('parent_id', $id)->get();

        $category = DB::table('projectscategories')->where('id', $id)->first();

        // View ને `$projectscategory` વેરિએબલ સાથે return કરો
        return Theme::scope('subcategory', compact('projectscategory', 'category'))
        ->render();
    }
    public function index()
    {
        // Fetch all categories
        $projectscategories = DB::table('projectscategories')->get();
        return view('Ads-projectscategory', compact('projectscategories'));
    }

    // Function to show subcategories based on parent_id
//     public function showSubcategories($id, $slug)
// {
 
//     // Fetch the category by slug from the projects_categories table
//     $category = DB::table('projectscategories')->where('id', $id)->first();

//     // Fetch all related subcategories from the database
//     $projectscategories = DB::table('projectscategories')
//         ->where('parent_id',$id) // Assuming 'parent_id' links to the main category
//         ->get();

//     // Pass the retrieved data to the view
//     return Theme::scope('subcategory', compact('projectscategories', 'category'))
//         ->render();
// }
    public function showSubcategories($id)
    {
      
        // Fetch subcategories where parent_id matches the clicked category's id
        $projectscategories = DB::table('projectscategories')->where('parent_id', $id)->get();
        $category = DB::table('projectscategories')->where('id', $id)->first();
   
        return Theme::scope('subcategory', compact('projectscategories', 'category'))
            ->render();
    }
    public function showCategoryPosts($id)
    {
       
        // Get category details
        $category = DB::table('projectscategories')->where('id', $id)->first();
        // $categoryposts = DB::table('projectsposts')->where('id', $id)->first();
        // Get all post IDs related to this category
        $postIds = DB::table('post_categories')
            ->where('category_id', $id)
            ->pluck('post_id'); // Get only post IDs as an array
        // dd($postIds);

        $projectscategories = DB::table('projectscategories')->where('id', $id)->get();
        // dd($projectscategories);
        // Fetch posts that match the retrieved post IDs
        $posts = DB::table('projectsposts')
            ->whereIn('id', $postIds)
            ->get();
        // dd($posts);
        return Theme::scope('category-posts', compact('category', 'posts', 'projectscategories'))->render();
    }
}

