<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->unsignedBigInteger('chat_id');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('send');
            $table->foreign('send')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('receive');
            $table->foreign('receive')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('read_at')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
