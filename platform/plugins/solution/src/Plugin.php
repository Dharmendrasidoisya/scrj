<?php

namespace Botble\Solution;

use Botble\Solution\Models\Category;
use Botble\Solution\Models\Tag;
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
        Schema::dropIfExists('spost_stags');
        Schema::dropIfExists('spost_scategories');
        Schema::dropIfExists('sposts');
        Schema::dropIfExists('scategories');
        Schema::dropIfExists('stags');
        Schema::dropIfExists('sposts_translations');
        Schema::dropIfExists('scategories_translations');
        Schema::dropIfExists('stags_translations');

        Widget::query()
            ->where('widget_id', 'widget_sposts_recent')
            ->each(fn (DashboardWidget $dashboardWidget) => $dashboardWidget->delete());

        MenuNode::query()
            ->whereIn('reference_type', [Category::class, Tag::class])
            ->each(fn (MenuNode $menuNode) => $menuNode->delete());

        Setting::delete([
            'solution_post_schema_enabled',
            'solution_post_schema_type',
        ]);
    }
}
