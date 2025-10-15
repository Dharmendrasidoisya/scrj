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

use Botble\News\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Base\Facades\BaseHelper;

use Botble\News\Repositories\Interfaces\PostInterface;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;

class NewsCategoryController extends BaseController
{

    public function subcategory($id)
    {
        // `newscategories` ટેબલમાંથી parent_id ના આધારે ડેટા લાવો
        $newscategory = DB::table('newscategories')->where('parent_id', $id)->get();

        $category = DB::table('newscategories')->where('id', $id)->first();

        // View ને `$newscategory` વેરિએબલ સાથે return કરો
        return Theme::scope('subcategory', compact('newscategory', 'category'))
        ->render();
    }
    public function index()
    {
        // Fetch all categories
        $newscategories = DB::table('newscategories')->get();
        return view('Ads-newscategory', compact('newscategories'));
    }

    // Function to show subcategories based on parent_id
//     public function showSubcategories($id, $slug)
// {
 
//     // Fetch the category by slug from the news_categories table
//     $category = DB::table('newscategories')->where('id', $id)->first();

//     // Fetch all related subcategories from the database
//     $newscategories = DB::table('newscategories')
//         ->where('parent_id',$id) // Assuming 'parent_id' links to the main category
//         ->get();

//     // Pass the retrieved data to the view
//     return Theme::scope('subcategory', compact('newscategories', 'category'))
//         ->render();
// }
    public function showSubcategories($id)
    {
      
        // Fetch subcategories where parent_id matches the clicked category's id
        $newscategories = DB::table('newscategories')->where('parent_id', $id)->get();
        $category = DB::table('newscategories')->where('id', $id)->first();
   
        return Theme::scope('subcategory', compact('newscategories', 'category'))
            ->render();
    }
    public function showCategoryPosts($id)
    {
       
        // Get category details
        $category = DB::table('newscategories')->where('id', $id)->first();
        // $categoryposts = DB::table('newsposts')->where('id', $id)->first();
        // Get all post IDs related to this category
        $postIds = DB::table('post_categories')
            ->where('category_id', $id)
            ->pluck('post_id'); // Get only post IDs as an array
        // dd($postIds);

        $newscategories = DB::table('newscategories')->where('id', $id)->get();
        // dd($newscategories);
        // Fetch posts that match the retrieved post IDs
        $posts = DB::table('newsposts')
            ->whereIn('id', $postIds)
            ->get();
        // dd($posts);
        return Theme::scope('category-posts', compact('category', 'posts', 'newscategories'))->render();
    }
}

