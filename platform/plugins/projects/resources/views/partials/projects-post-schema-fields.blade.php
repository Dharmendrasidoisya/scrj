<x-core::form.on-off.checkbox
    name="projects_post_schema_enabled"
    :label="trans('plugins/projects::base.settings.enable_projects_post_schema')"
    :checked="setting('projects_post_schema_enabled', true)"
    :description="trans('plugins/projects::base.settings.enable_projects_post_schema_description')"
    data-bb-toggle="collapse"
    data-bb-target=".projects_post_schema_type"
    class="mb-0"
    :wrapper="false"
/>

<x-core::form.fieldset
    class="projects_post_schema_type mt-3"
    data-bb-value="1"
    @style(['display: none' => !setting('projects_post_schema_enabled', true)])
>
    <x-core::form.select
        name="projects_post_schema_type"
        :label="trans('plugins/projects::base.settings.schema_type')"
        :options="[
            'NewsArticle' => 'NewsArticle',
            'News' => 'News',
            'Article' => 'Article',
            'ProjectsPosting' => 'ProjectsPosting',
        ]"
        :value="setting('projects_post_schema_type', 'NewsArticle')"
    />
</x-core::form.fieldset>
