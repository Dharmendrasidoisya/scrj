<x-core::form.on-off.checkbox
    name="solution_post_schema_enabled"
    :label="trans('plugins/solution::base.settings.enable_solution_post_schema')"
    :checked="setting('solution_post_schema_enabled', true)"
    :description="trans('plugins/solution::base.settings.enable_solution_post_schema_description')"
    data-bb-toggle="collapse"
    data-bb-target=".solution_post_schema_type"
    class="mb-0"
    :wrapper="false"
/>

<x-core::form.fieldset
    class="solution_post_schema_type mt-3"
    data-bb-value="1"
    @style(['display: none' => !setting('solution_post_schema_enabled', true)])
>
    <x-core::form.select
        name="solution_post_schema_type"
        :label="trans('plugins/solution::base.settings.schema_type')"
        :options="[
            'NewsArticle' => 'NewsArticle',
            'News' => 'News',
            'Article' => 'Article',
            'SolutionPosting' => 'SolutionPosting',
        ]"
        :value="setting('solution_post_schema_type', 'NewsArticle')"
    />
</x-core::form.fieldset>
