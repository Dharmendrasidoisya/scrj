<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="Title">
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Header Title') }}</label>
    <input type="text" name="headertitle" value="{{ Arr::get($attributes, 'headertitle') }}" class="form-control" placeholder="Header Title">
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description') }}</label>
    <textarea name="description" class="form-control " placeholder="description">{{ Arr::get($attributes, 'description') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Icon') }}</label>
    {!! Form::mediaImage('icon', Arr::get($attributes, 'icon')) !!}
</div>
{!! Theme::partial('shortcodes.includes.autoplay-settings', compact('attributes')) !!}
