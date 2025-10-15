<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('newscategories', 'author_type')) {
            Schema::table('newscategories', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('newscategories', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('newstags', 'author_type')) {
            Schema::table('newstags', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('newstags', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });

        if (! Schema::hasColumn('newsposts', 'author_type')) {
            Schema::table('newsposts', function (Blueprint $table) {
                $table->string('author_type', 255);
            });
        }

        Schema::table('newsposts', function (Blueprint $table) {
            $table->string('author_type', 255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('newscategories', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('newstags', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });

        Schema::table('newsposts', function (Blueprint $table) {
            $table->string('author_type', 255)->default(addslashes(User::class))->change();
        });
    }
};
