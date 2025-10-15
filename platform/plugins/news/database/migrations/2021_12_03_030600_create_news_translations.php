<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('newsposts_translations')) {
            Schema::create('newsposts_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('newsposts_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'newsposts_id'], 'newsposts_translations_primary');
            });
        }

        // if (! Schema::hasTable('newscategories_translations')) {
        //     Schema::create('newscategories_translations', function (Blueprint $table) {
        //         $table->string('lang_code', 20);
        //         $table->foreignId('newscategories_id');
        //         $table->string('name', 255)->nullable();
        //         $table->string('description', 400)->nullable();

        //         $table->primary(['lang_code', 'categories_id'], 'newscategories_translations_primary');
        //     });
        // }

        if (! Schema::hasTable('newstags_translations')) {
            Schema::create('newstags_translations', function (Blueprint $table) {
                $table->string('lang_code', 20);
                $table->foreignId('tags_id');
                $table->string('name', 255)->nullable();
                $table->string('description', 400)->nullable();

                $table->primary(['lang_code', 'tags_id'], 'newstags_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('newsposts_translations');
        Schema::dropIfExists('newscategories_translations');
        Schema::dropIfExists('newstags_translations');
    }
};
