<?php

namespace Botble\Solution\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Supports\Breadcrumb;
use Botble\Solution\Forms\PostForm;
use Botble\Solution\Http\Requests\PostRequest;
use Botble\Solution\Models\Post;
use Botble\Solution\Solution\StoreCategoryService;

use Botble\Solution\Tables\PostTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Base\Facades\BaseHelper;

use Botble\Solution\Repositories\Interfaces\PostInterface;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
class SolutionController extends BaseController
{
 

    public function showDetails($id)
{
    // dd($id);
    // Retrieve the specific service post
    $solutionPost = DB::table('sposts')->where('id', $id)->first();
    $postImages = $solutionPost->image ? json_decode($solutionPost->image) : [];
    // Check if the service post exists
    if (!$solutionPost) {
        abort(404); // Show 404 error if not found
    }

    // Pass data to the Blade view
    // return view('Solution.details', compact('servicePost'));
    return Theme::scope('solutiondetails', compact('solutionPost','postImages'))
    ->render();
}
  
}
