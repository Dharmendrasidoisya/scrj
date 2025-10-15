<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('industryposts_translations')) {
            Schema::create('industryposts_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('industryposts_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'industryposts_id'], 'industryposts_translations_primary');
            });
        }

        // if (! Schema::hasTable('industrycategories_translations')) {
        //     Schema::create('industrycategories_translations', function (Blueprint $table) {
        //         $table->string('lang_code', 20);
        //         $table->foreignId('industrycategories_id');
        //         $table->string('name', 255)->nullable();
        //         $table->string('description', 400)->nullable();

        //         $table->primary(['lang_code', 'categories_id'], 'industrycategories_translations_primary');
        //     });
        // }

        if (! Schema::hasTable('industrytags_translations')) {
            Schema::create('industrytags_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('tags_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'tags_id'], 'industrytags_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('industryposts_translations');
        Schema::dropIfExists('industrycategories_translations');
        Schema::dropIfExists('industrytags_translations');
    }
};
