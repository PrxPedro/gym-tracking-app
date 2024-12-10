<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('content'); // The actual message content
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // User who sent the message
            $table->foreignId('recipient_id')->nullable()->constrained('users')->onDelete('cascade'); // Recipient user (optional, nullable for general posts)
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Post associated with the message
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
