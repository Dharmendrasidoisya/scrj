<div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="Title">
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon') }}</label>
    {!! Form::mediaImage('icon', Arr::get($attributes, 'icon')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon2') }}</label>
    {!! Form::mediaImage('icon2', Arr::get($attributes, 'icon2')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon3') }}</label>
    {!! Form::mediaImage('icon3', Arr::get($attributes, 'icon3')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon4') }}</label>
    {!! Form::mediaImage('icon4', Arr::get($attributes, 'icon4')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon5') }}</label>
    {!! Form::mediaImage('icon5', Arr::get($attributes, 'icon5')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon6') }}</label>
    {!! Form::mediaImage('icon6', Arr::get($attributes, 'icon6')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon7') }}</label>
    {!! Form::mediaImage('icon7', Arr::get($attributes, 'icon7')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon8') }}</label>
    {!! Form::mediaImage('icon8', Arr::get($attributes, 'icon8')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon9') }}</label>
    {!! Form::mediaImage('icon9', Arr::get($attributes, 'icon9')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon10') }}</label>
    {!! Form::mediaImage('icon10', Arr::get($attributes, 'icon10')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon11') }}</label>
    {!! Form::mediaImage('icon11', Arr::get($attributes, 'icon11')) !!}
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Icon12') }}</label>
    {!! Form::mediaImage('icon12', Arr::get($attributes, 'icon12')) !!}
</div>

{!! Theme::partial('shortcodes.includes.autoplay-settings', compact('attributes')) !!}
