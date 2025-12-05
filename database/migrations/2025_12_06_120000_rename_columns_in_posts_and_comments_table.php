<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('author', 'author_id');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('author', 'author_id');
            $table->renameColumn('post', 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('author_id', 'author');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('author_id', 'author');
            $table->renameColumn('post_id', 'post');
        });
    }
};
