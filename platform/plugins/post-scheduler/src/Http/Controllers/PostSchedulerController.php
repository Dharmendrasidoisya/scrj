
<?php

use Illuminate\Http\Request;
use App\Models\PostScheduler;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Theme\Facades\Theme;

class PostSchedulerController extends BaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'publish_date' => 'required|date',
            'publish_time' => 'required',
        ]);
    
        $currentDate = now()->format('Y-m-d');
        $currentTime = now()->format('H:i');
    
        $publishDate = $request->input('publish_date');
        $publishTime = $request->input('publish_time');
    
        // If date and time match current time, set status to PUBLISHED
        $status = ($publishDate === $currentDate && $publishTime === $currentTime) 
            ? BaseStatusEnum::PUBLISHED 
            : BaseStatusEnum::DRAFT;
    
        $post = new PostScheduler();
        $post->publish_date = $publishDate;
        $post->publish_time = $publishTime;
        $post->status = $status;
        $post->save();
        return Theme::scope('status')->render()->with('success', 'Post saved successfully!');;
        // return redirect()->route('your.route.index')->with('success', 'Post saved successfully!');
    }
}
