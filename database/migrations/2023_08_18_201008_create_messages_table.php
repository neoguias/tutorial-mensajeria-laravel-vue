<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->references('id')->on('users');
            $table->integer('from')->unsigned()->references('id')->on('users');
            $table->integer('to')->unsigned()->references('id')->on('users');
            $table->string('subject')->default("(no subject)");
            $table->text('content');
            $table->dateTime('read_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
