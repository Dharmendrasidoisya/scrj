<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('projectscategories', 'author_type')) {
            Schema::table('projectscategories', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('projectscategories', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('projectstags', 'author_type')) {
            Schema::table('projectstags', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('projectstags', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('projectsposts', 'author_type')) {
            Schema::table('projectsposts', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('projectsposts', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('projectscategories', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('projectstags', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('projectsposts', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });
    }
};
