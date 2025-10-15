
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
    <textarea name="description3" class="form-control " placeholder="description  ">{{ Arr::get($attributes, 'description3') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">{{ __('Description4') }}</label>
    <textarea name="description4" class="form-control " placeholder="description  ">{{ Arr::get($attributes, 'description4') }}</textarea>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ __('Category') }}</label>
    {!! Form::customSelect('category_id', ['' => __('All')] + $categories, Arr::get($attributes, 'category_id')) !!}
</div>
