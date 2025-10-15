<div class="mb-3">
    <label for="widget-name">{{ trans('core/base::forms.name') }}</label>
    <input
        class="form-control"
        name="name"
        type="text"
        value="{{ $config['name'] }}"
    >
</div>
<div class="mb-3">
    <label for="content">{{ trans('core/base::forms.content') }}</label>
    <textarea
    type="text"
        class="form-control"
        name="content"
        {{-- class="ckeditor" cols="80" id="editor1" name="editor1" rows="10" --}}
        rows="7"
    >{{ $config['content'] }}</textarea>
    <div ></div>
</div>
<script src="../script/ckeditor/ckeditor.js" type="text/javascript"></script>

    {{-- <script>
      CKEDITOR.replace( 'editor1' );
    </script> --}}

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('content');
    });
</script>
<style>
    #cke_notifications_area_content{
display: none;
    }
</style> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
