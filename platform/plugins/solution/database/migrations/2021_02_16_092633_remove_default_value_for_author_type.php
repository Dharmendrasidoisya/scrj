<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('scategories', 'author_type')) {
            Schema::table('scategories', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('scategories', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('stags', 'author_type')) {
            Schema::table('stags', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('stags', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('sposts', 'author_type')) {
            Schema::table('sposts', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('sposts', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('scategories', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('stags', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('sposts', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });
    }
};
