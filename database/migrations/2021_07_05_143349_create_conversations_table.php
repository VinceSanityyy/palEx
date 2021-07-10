<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_one_id')->unsigned();
            $table->bigInteger('user_two_id')->unsigned();
            $table->timestamps();
            $table->bigInteger('status')->default(1);


             // Foreign Keys
            $table->foreign('user_one_id')
                ->references('id')
                ->on('users');

            $table->foreign('user_two_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
