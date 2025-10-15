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

class IndustryCategoryController extends BaseController
{

    public function subcategory($id)
    {
        // `industrycategories` ટેબલમાંથી parent_id ના આધારે ડેટા લાવો
        $industrycategory = DB::table('industrycategories')->where('parent_id', $id)->get();

        $category = DB::table('industrycategories')->where('id', $id)->first();

        // View ને `$industrycategory` વેરિએબલ સાથે return કરો
        return Theme::scope('subcategory', compact('industrycategory', 'category'))
        ->render();
    }
    public function index()
    {
        // Fetch all categories
        $industrycategories = DB::table('industrycategories')->get();
        return view('Ads-industrycategory', compact('industrycategories'));
    }

    // Function to show subcategories based on parent_id
//     public function showSubcategories($id, $slug)
// {
 
//     // Fetch the category by slug from the industry_categories table
//     $category = DB::table('industrycategories')->where('id', $id)->first();

//     // Fetch all related subcategories from the database
//     $industrycategories = DB::table('industrycategories')
//         ->where('parent_id',$id) // Assuming 'parent_id' links to the main category
//         ->get();

//     // Pass the retrieved data to the view
//     return Theme::scope('subcategory', compact('industrycategories', 'category'))
//         ->render();
// }
    public function showSubcategories($id)
    {
      
        // Fetch subcategories where parent_id matches the clicked category's id
        $industrycategories = DB::table('industrycategories')->where('parent_id', $id)->get();
        $category = DB::table('industrycategories')->where('id', $id)->first();
   
        return Theme::scope('subcategory', compact('industrycategories', 'category'))
            ->render();
    }
    public function showCategoryPosts($id)
    {
       
        // Get category details
        $category = DB::table('industrycategories')->where('id', $id)->first();
        // $categoryposts = DB::table('industryposts')->where('id', $id)->first();
        // Get all post IDs related to this category
        $postIds = DB::table('post_categories')
            ->where('category_id', $id)
            ->pluck('post_id'); // Get only post IDs as an array
        // dd($postIds);

        $industrycategories = DB::table('industrycategories')->where('id', $id)->get();
        // dd($industrycategories);
        // Fetch posts that match the retrieved post IDs
        $posts = DB::table('industryposts')
            ->whereIn('id', $postIds)
            ->get();
        // dd($posts);
        return Theme::scope('category-posts', compact('category', 'posts', 'industrycategories'))->render();
    }
}

