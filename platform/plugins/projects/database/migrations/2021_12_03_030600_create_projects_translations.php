<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('projectsposts_translations')) {
            Schema::create('projectsposts_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('projectsposts_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'projectsposts_id'], 'projectsposts_translations_primary');
            });
        }

        // if (! Schema::hasTable('projectscategories_translations')) {
        //     Schema::create('projectscategories_translations', function (Blueprint $table) {
        //         $table->string('lang_code', 20);
        //         $table->foreignId('projectscategories_id');
        //         $table->string('name', 255)->nullable();
        //         $table->string('description', 400)->nullable();

        //         $table->primary(['lang_code', 'categories_id'], 'projectscategories_translations_primary');
        //     });
        // }

        if (! Schema::hasTable('projectstags_translations')) {
            Schema::create('projectstags_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('tags_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'tags_id'], 'projectstags_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('projectsposts_translations');
        Schema::dropIfExists('projectscategories_translations');
        Schema::dropIfExists('projectstags_translations');
    }
};
