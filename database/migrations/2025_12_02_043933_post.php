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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('brief_description');
            $table->foreignId('author')->constrained('users');
            $table->string('tags')->nullable();
            $table->string('link')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
            $table->integer('views')->default(0);
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->string('thumbnail')->nullable();
            $table->integer('upvote')->default(0);
            $table->integer('downvote')->default(0);
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->foreignId('post')->constrained('posts')->onDelete('cascade');
            $table->integer('upvote')->default(0);
            $table->integer('downvote')->default(0);
            $table->foreignId('author')->constrained('users');
            $table->foreignId('parent_comment_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
    }
};
