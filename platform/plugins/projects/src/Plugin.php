<?php

namespace Botble\Projects;

use Botble\Projects\Models\Category;
use Botble\Projects\Models\Tag;
use Botble\Dashboard\Models\DashboardWidget;
use Botble\Menu\Models\MenuNode;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Facades\Setting;
use Botble\Widget\Models\Widget;
use Illuminate\Support\Facades\Schema;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('spost_projectstags');
        Schema::dropIfExists('spost_projectscategories');
        Schema::dropIfExists('projectsposts');
        Schema::dropIfExists('projectscategories');
        Schema::dropIfExists('projectstags');
        Schema::dropIfExists('projectsposts_translations');
        Schema::dropIfExists('projectscategories_translations');
        Schema::dropIfExists('projectstags_translations');

        Widget::query()
            ->where('widget_id', 'widget_projectsposts_recent')
            ->each(fn (DashboardWidget $dashboardWidget) => $dashboardWidget->delete());

        MenuNode::query()
            ->whereIn('reference_type', [Category::class, Tag::class])
            ->each(fn (MenuNode $menuNode) => $menuNode->delete());

        Setting::delete([
            'projects_post_schema_enabled',
            'projects_post_schema_type',
        ]);
    }
}
