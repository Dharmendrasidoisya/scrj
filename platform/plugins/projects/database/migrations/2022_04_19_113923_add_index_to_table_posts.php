<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('projectsposts', function (Blueprint $table) {
            $table->index('status', 'projectsposts_status_index');
            $table->index('author_id', 'projectsposts_author_id_index');
            $table->index('author_type', 'projectsposts_author_type_index');
            $table->index('created_at', 'projectsposts_created_at_index');
        });

        Schema::table('projectscategories', function (Blueprint $table) {
            $table->index('parent_id', 'projectscategories_parent_id_index');
            $table->index('status', 'projectscategories_status_index');
            $table->index('created_at', 'projectscategories_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('projectsposts', function (Blueprint $table) {
            $table->dropIndex('projectsposts_status_index');
            $table->dropIndex('projectsposts_author_id_index');
            $table->dropIndex('projectsposts_author_type_index');
            $table->dropIndex('projectsposts_created_at_index');
        });

        Schema::table('projectscategories', function (Blueprint $table) {
            $table->dropIndex('projectscategories_parent_id_index');
            $table->dropIndex('projectscategories_status_index');
            $table->dropIndex('projectscategories_created_at_index');
        });
    }
};
