<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('sposts', function (Blueprint $table) {
            $table->index('status', 'sposts_status_index');
            $table->index('author_id', 'sposts_author_id_index');
            $table->index('author_type', 'sposts_author_type_index');
            $table->index('created_at', 'sposts_created_at_index');
        });

        Schema::table('scategories', function (Blueprint $table) {
            $table->index('parent_id', 'scategories_parent_id_index');
            $table->index('status', 'scategories_status_index');
            $table->index('created_at', 'scategories_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('sposts', function (Blueprint $table) {
            $table->dropIndex('sposts_status_index');
            $table->dropIndex('sposts_author_id_index');
            $table->dropIndex('sposts_author_type_index');
            $table->dropIndex('sposts_created_at_index');
        });

        Schema::table('scategories', function (Blueprint $table) {
            $table->dropIndex('scategories_parent_id_index');
            $table->dropIndex('scategories_status_index');
            $table->dropIndex('scategories_created_at_index');
        });
    }
};
