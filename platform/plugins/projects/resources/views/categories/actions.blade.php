<a
    class="btn btn-icon btn-primary"
    data-bs-toggle="tooltip"
    data-bs-original-title="{{ trans('core/base::tables.edit') }}"
    href="{{ route('projectscategories.edit', $item->id) }}"
>
    <x-core::icon name="ti ti-edit" />
</a>
<a
    class="btn btn-icon btn-danger deleteDialog"
    data-bs-toggle="tooltip"
    data-section="{{ route('projectscategories.destroy', $item->id) }}"
    data-bs-original-title="{{ trans('core/base::tables.delete_entry') }}"
    href="#"
    role="button"
>
    <x-core::icon name="ti ti-trash" />
</a>
