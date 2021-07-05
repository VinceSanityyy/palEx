<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_replies', function (Blueprint $table) {
            $table->id();
            $table->longText('reply')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('conversation_id')->unsigned();
            $table->boolean('seen')->default(false);
            $table->string('type')->default('text')->nullable();
            $table->timestamps();
            $table->bigInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversation_replies');
    }
}
