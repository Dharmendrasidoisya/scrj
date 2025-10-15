@php
    $layout = MetaBox::getMetaData($post, 'layout', true);
    $layout = $layout && in_array($layout, array_keys(get_blog_single_layouts())) ? $layout : 'blog-right-sidebar';
    Theme::layout($layout);
    $relatedPosts = get_related_posts($post->id, 5);
    // dd($relatedPosts);
    $related = DB::table('projectsposts')->where('status', 'published')->get();
    $relatedposts = DB::table('posts')->where('status', 'published')->get();
    $newsrelated = DB::table('newsposts')->where('status', 'published')->get();

@endphp




<?php
$servicelink = DB::table('settings')->where('key', 'permalink-botble-services-models-post')->value('value');
// dd($servicelink);
?>
<?php
// Check if the service post exists

$projectslink = DB::table('settings')->where('key', 'permalink-botble-projects-models-post')->value('value');
$newslink = DB::table('settings')->where('key', 'permalink-botble-news-models-post')->value('value');

// dd($servicelink);
?>
@if (request()->is($servicelink . '/*'))
    <?php
    // dd($post);
    // dd($post->id);
    // $posts = DB::table('servicesposts')->get();
    
    // $servicespostIds = DB::table('servicesposts')->pluck('id')->toArray(); // Extract only IDs
    // $postIds = DB::table('post_categories')->where('category_id', $servicespostIds)->pluck('post_id'); // Get only post IDs as an array
    //     // dd($postIds );
    //     // Fetch posts that match the retrieved post IDs
    //     $posts = DB::table('servicesposts')->whereIn('id', $postIds)->get();
    // // dd($posts);
    // $servicespostIds = DB::table('servicescategories')->pluck('id')->toArray(); // Extract only IDs
    // // dd($servicespostIds);
    
    // $postIds = DB::table('post_categories')
    //     ->whereIn('post_id', [$post->id]) // Convert to an array
    //     ->pluck('category_id');
    // // dd($postIds);
    //     $posts = DB::table('servicesposts')
    //     ->whereIn('id', $postIds) // Use whereIn to match multiple IDs
    //     ->orderBy('id', 'desc') // Order by ID in descending order
    //    // Limit the result to 4 records
    //     ->get();
    
    // $posts = DB::table('servicesposts')->whereIn('id', [$post->id])->get();
    
    // dd($posts);
    // dd($post->id);
    $postIds = DB::table('post_categories')->where('post_id', $post->id)->pluck('post_id'); // Get only post IDs as an array
    $categoryidfetch = DB::table('post_categories')->where('post_id', $post->id)->orderBy('post_id', 'desc')->get()->last(); // Get only post IDs as an array
    $catid = $categoryidfetch->category_id;
    
    $relatedid = DB::table('post_categories')->where('category_id', $catid)->pluck('post_id'); // Get only post IDs as an array
    
    $posts = DB::table('servicesposts')->whereIn('id', $relatedid)->where('id', '!=', $post->id)->get();
    // dd($relatedpost);
    
    // $posts = DB::table('servicesposts')
    // ->whereIn('id', $postIds) // Use whereIn to match multiple IDs
    // ->orderBy('id', 'desc') // Order by ID in descending order
    // // Limit the result to 4 records
    // ->get();
    // dd($posts);
    // $posts = DB::table('servicesposts')->get();
    ?>

    @include(Theme::getThemeNamespace() . '::views.templates.servicespostsdeatils')

@elseif(request()->is($projectslink . '/*'))
    <?php
    $projectslink = DB::table('projectsposts')->where('id', $post->id)->first();
    $postImages = $projectslink->image ? json_decode($projectslink->image) : [];
    ?>
    @include(Theme::getThemeNamespace() . '::views.templates.projectsdetails')
    @elseif(request()->is($newslink . '/*'))
    <?php
    $newslink = DB::table('newsposts')->where('id', $post->id)->first();
    $postImages = $newslink->image ? json_decode($newslink->image) : [];
    ?>
    @include(Theme::getThemeNamespace() . '::views.templates.newsdetails')
@else
    <style>
        img {
            max-width: none;
        }
		.smalllogo{
		    height: 100px;
 
		}
		@media only screen and (max-width: 600px) {
  .smallscreen {
       height: 336px!important;
    width: 336px!important;
  }
}
    </style>
<div class="page-header py-0 bg-secondary px-3 px-xl-0 border-radius-2 p-relative mb-0 overflow-hidden"
     style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.4)), url('{{ asset('themes/wowy/ads/images/home/Breadcam.jpg') }}'); background-size: cover; background-position: center;">

        <div class="container-fluid p-relative z-index-1 py-2 ">
            <div class="row mh-200px mh-lg-300px align-items-center py-4">
                <div class="col lbtop" style="text-align:center;">
                    <div class="appear-animation animated fadeInRightShorter appear-animation-visible"
                        data-appear-animation="fadeInRightShorter" data-appear-animation-delay="0"
                        style="animation-delay: 0ms;">
                        <span
                            class="badge bg-color-dark-rgba-30  rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4"><span
                                class="d-inline-flex py-1 px-2">Our Blogs</span></span>
                    </div>
                    <div class="appear-animation animated fadeIn appear-animation-visible"
                        data-appear-animation="fadeIn" data-appear-animation-delay="200"
                        style="animation-delay: 200ms;">
                        <h1 class="text-9 text-lg-12  font-weight-semibold line-height-1 mb-2">
                            {{ $post->name }}</h1>
                    </div>
                    <div class="appear-animation animated fadeIn appear-animation-visible"
                        data-appear-animation="fadeIn" data-appear-animation-delay="200"
                        style="animation-delay: 200ms;">
                        <ul class="breadcrumb d-flex text-3-5 font-weight-semi-bold pb-2 mb-3">
                            <li><a href="{{ BaseHelper::getHomepageUrl() }}"
                                    class=" text-decoration-none text-white">Home</a></li>

                            <li class="active text-color-light opacity-7">{{ $post->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid  pt-5 border-bottom border-bottom-color-grey-100 ">

        <div class="row">
            {{-- @foreach ($relatedPosts as $relatedItem) --}}
            <div class="col-lg-8  mb-lg-0 lcss">
                <style>
                    @media screen and (min-device-width: 1367px) and (max-device-width: 1440px) {
                        .smallscreen {
                            height: 470px !important;
                            width: 870px !important;
                        }
                    }
				
              
                </style>
                <article>
                    <div class="card border-0">
                        <div class="card-body z-index-1 p-0">
                            <div class="post-image ">
                                <img class="card-img-top border-radius-2 smallscreen"
                                    src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                    alt="{{ $post->name }}" style="height: 507px;width: 762px;">
                            </div>

                            <div class="card-body pt-4 " style="padding: 0px;padding: 0rem;">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                </article>

            </div>
            {{-- @endforeach --}}

            <div class="blog-sidebar col-lg-4 pt-lg-0">
                <aside class="sidebar">
                    <div class="py-1 clearfix">
                        <hr class="my-2">
                    </div>
                    <div class="px-3 mt-4">
                        <h3 class="text-color-dark text-capitalize font-weight-bold text-5 m-0 mb-3">Recent Posts</h3>
                        <div class="pb-2 mb-1">
                            @foreach ($relatedposts as $relatedItem)
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <a href="{{ Str::slug($relatedItem->name) }}">
                                        <img src="{{ RvMedia::getImageUrl($relatedItem->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                            alt="img" width="70" height="70" class="widget-posts-img">
                                    </a>
                                    <a href="{{ Str::slug($relatedItem->name) }}"
                                        class="text-color-dark text-hover-primary font-weight-bold text-3 line-height-4">
                                        {!! $relatedItem->name !!}
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>



                </aside>
            </div>
        </div>

    </div>
@endif
