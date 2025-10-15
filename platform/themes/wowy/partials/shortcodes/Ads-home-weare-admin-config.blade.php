<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="Title">
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description') }}</label>
    <textarea name="description" class="form-control " placeholder="description">{{ Arr::get($attributes, 'description') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description2') }}</label>
    <textarea name="description2" class="form-control " placeholder="description Second ">{{ Arr::get($attributes, 'description2') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description3') }}</label>
    <textarea name="description3" class="form-control " placeholder="description Third ">{{ Arr::get($attributes, 'description3') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description4') }}</label>
    <textarea name="description4" class="form-control " placeholder="description Four ">{{ Arr::get($attributes, 'description4') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description5') }}</label>
    <textarea name="description5" class="form-control " placeholder="description Five ">{{ Arr::get($attributes, 'description5') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description6') }}</label>
    <textarea name="description6" class="form-control " placeholder="description Six ">{{ Arr::get($attributes, 'description6') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Icon1') }}</label>
    {!! Form::mediaImage('icon1', Arr::get($attributes, 'icon1')) !!}
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Icon2') }}</label>
    {!! Form::mediaImage('icon2', Arr::get($attributes, 'icon2')) !!}
</div>
{!! Theme::partial('shortcodes.includes.autoplay-settings', compact('attributes')) !!}
