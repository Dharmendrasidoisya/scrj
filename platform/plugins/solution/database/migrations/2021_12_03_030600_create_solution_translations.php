<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('sposts_translations')) {
            Schema::create('sposts_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('sposts_id');
                $table->string('name', 255)->nullable();
                $table->string('description')->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'sposts_id'], 'sposts_translations_primary');
            });
        }

        if (! Schema::hasTable('scategories_translations')) {
            Schema::create('scategories_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('categories_id');
                $table->string('name', 255)->nullable();
                $table->string('description')->nullable();

                $table->primary(['lang_code', 'categories_id'], 'scategories_translations_primary');
            });
        }

        if (! Schema::hasTable('stags_translations')) {
            Schema::create('stags_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('tags_id');
                $table->string('name', 255)->nullable();
                $table->string('description')->nullable();

                $table->primary(['lang_code', 'tags_id'], 'stags_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sposts_translations');
        Schema::dropIfExists('scategories_translations');
        Schema::dropIfExists('stags_translations');
    }
};
