<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('industrycategories', 'author_type')) {
            Schema::table('industrycategories', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('industrycategories', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('industrytags', 'author_type')) {
            Schema::table('industrytags', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('industrytags', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('industryposts', 'author_type')) {
            Schema::table('industryposts', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('industryposts', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('industrycategories', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('industrytags', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('industryposts', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });
    }
};
