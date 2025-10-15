<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('industryposts', function (Blueprint $table) {
            $table->index('status', 'industryposts_status_index');
            $table->index('author_id', 'industryposts_author_id_index');
            $table->index('author_type', 'industryposts_author_type_index');
            $table->index('created_at', 'industryposts_created_at_index');
        });

        Schema::table('industrycategories', function (Blueprint $table) {
            $table->index('parent_id', 'industrycategories_parent_id_index');
            $table->index('status', 'industrycategories_status_index');
            $table->index('created_at', 'industrycategories_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('industryposts', function (Blueprint $table) {
            $table->dropIndex('industryposts_status_index');
            $table->dropIndex('industryposts_author_id_index');
            $table->dropIndex('industryposts_author_type_index');
            $table->dropIndex('industryposts_created_at_index');
        });

        Schema::table('industrycategories', function (Blueprint $table) {
            $table->dropIndex('industrycategories_parent_id_index');
            $table->dropIndex('industrycategories_status_index');
            $table->dropIndex('industrycategories_created_at_index');
        });
    }
};
