<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('scategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->foreignId('parent_id')->default(0);
            $table->string('description')->nullable();
            $table->string('status', 60)->default('published');
            $table->foreignId('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('stags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->foreignId('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('description')->nullable()->default('');
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('sposts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published');
            $table->foreignId('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('image', 255)->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->string('format_type', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('spost_tags', function (Blueprint $table) {
            $table->foreignId('tag_id')->index();
            $table->foreignId('post_id')->index();
        });

        Schema::create('spost_categories', function (Blueprint $table) {
            $table->foreignId('category_id')->index();
            $table->foreignId('post_id')->index();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('spost_tags');
        Schema::dropIfExists('spost_categories');
        Schema::dropIfExists('sposts');
        Schema::dropIfExists('scategories');
        Schema::dropIfExists('stags');
    }
};
