<x-core::form.on-off.checkbox
    name="industry_post_schema_enabled"
    :label="trans('plugins/industry::base.settings.enable_industry_post_schema')"
    :checked="setting('industry_post_schema_enabled', true)"
    :description="trans('plugins/industry::base.settings.enable_industry_post_schema_description')"
    data-bb-toggle="collapse"
    data-bb-target=".industry_post_schema_type"
    class="mb-0"
    :wrapper="false"
/>

<x-core::form.fieldset
    class="industry_post_schema_type mt-3"
    data-bb-value="1"
    @style(['display: none' => !setting('industry_post_schema_enabled', true)])
>
    <x-core::form.select
        name="industry_post_schema_type"
        :label="trans('plugins/industry::base.settings.schema_type')"
        :options="[
            'NewsArticle' => 'NewsArticle',
            'News' => 'News',
            'Article' => 'Article',
            'IndustryPosting' => 'IndustryPosting',
        ]"
        :value="setting('industry_post_schema_type', 'NewsArticle')"
    />
</x-core::form.fieldset>
