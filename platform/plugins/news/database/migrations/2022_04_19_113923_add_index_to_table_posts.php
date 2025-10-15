<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('newsposts', function (Blueprint $table) {
            $table->index('status', 'newsposts_status_index');
            $table->index('author_id', 'newsposts_author_id_index');
            $table->index('author_type', 'newsposts_author_type_index');
            $table->index('created_at', 'newsposts_created_at_index');
        });

        Schema::table('newscategories', function (Blueprint $table) {
            $table->index('parent_id', 'newscategories_parent_id_index');
            $table->index('status', 'newscategories_status_index');
            $table->index('created_at', 'newscategories_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('newsposts', function (Blueprint $table) {
            $table->dropIndex('newsposts_status_index');
            $table->dropIndex('newsposts_author_id_index');
            $table->dropIndex('newsposts_author_type_index');
            $table->dropIndex('newsposts_created_at_index');
        });

        Schema::table('newscategories', function (Blueprint $table) {
            $table->dropIndex('newscategories_parent_id_index');
            $table->dropIndex('newscategories_status_index');
            $table->dropIndex('newscategories_created_at_index');
        });
    }
};
