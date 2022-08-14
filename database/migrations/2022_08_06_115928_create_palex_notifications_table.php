<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalexNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palex_notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->text('title')->nullable();
            $table->text('body')->nullable();
            $table->text('link')->nullable();
            $table->text('link_end_point')->nullable();
            $table->text('image_link')->nullable();
            $table->string('type')->nullable();
            $table->text('other_data')->nullable();
            $table->boolean('seen')->default(false);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('palex_notifications');
    }
}