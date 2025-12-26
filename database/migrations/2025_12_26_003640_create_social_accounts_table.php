<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('provider_name');        // e.g. 'google'
            $table->string('provider_id');          // provider user id
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->timestamp('token_expires_at')->nullable(); // when the access token expires
            $table->json('profile')->nullable();   // raw provider profile JSON
            $table->timestamps();

            $table->unique(['provider_name', 'provider_id']);
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_accounts');
    }
}
