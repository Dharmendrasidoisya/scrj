<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('projectscategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->foreignId('parent_id')->default(0);
            $table->string('description',0)->nullable();
            $table->string('shortdescription', 400)->nullable();
            $table->string('seo_title', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->foreignId('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('projectstags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->foreignId('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('description', 400)->nullable()->default('');
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('projectsposts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('specification')->nullable();
			 $table->longText('location')->nullable();
            $table->string('status', 60)->default('published');
            $table->foreignId('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('image', 255)->nullable();
            $table->json('images')->nullable()->change();
			   $table->string('pdf')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->string('format_type', 30)->nullable();
            $table->timestamps();
        });

        Schema::create('projectsposts_tags', function (Blueprint $table) {
            $table->foreignId('tag_id')->index();
            $table->foreignId('post_id')->index();
        });

        Schema::create('projectsposts_categories', function (Blueprint $table) {
            $table->foreignId('category_id')->index();
            $table->foreignId('post_id')->index();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('projectsposts_tags');
        Schema::dropIfExists('projectsposts_categories');
        Schema::dropIfExists('projectsposts');
        Schema::dropIfExists('projectscategories');
        Schema::dropIfExists('projectstags');
    }
};
