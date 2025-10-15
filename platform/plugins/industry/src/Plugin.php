<?php

namespace Botble\Industry;

use Botble\Industry\Models\Category;
use Botble\Industry\Models\Tag;
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
        Schema::dropIfExists('spost_industrytags');
        Schema::dropIfExists('spost_industrycategories');
        Schema::dropIfExists('industryposts');
        Schema::dropIfExists('industrycategories');
        Schema::dropIfExists('industrytags');
        Schema::dropIfExists('industryposts_translations');
        Schema::dropIfExists('industrycategories_translations');
        Schema::dropIfExists('industrytags_translations');

        Widget::query()
            ->where('widget_id', 'widget_industryposts_recent')
            ->each(fn (DashboardWidget $dashboardWidget) => $dashboardWidget->delete());

        MenuNode::query()
            ->whereIn('reference_type', [Category::class, Tag::class])
            ->each(fn (MenuNode $menuNode) => $menuNode->delete());

        Setting::delete([
            'industry_post_schema_enabled',
            'industry_post_schema_type',
        ]);
    }
}
