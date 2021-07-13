<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->dateTime('date_placed');
            $table->bigInteger('payment_method')->default(1);
            //
            $table->bigInteger('status')->default(1);
            $table->bigInteger('user_address_id')->unsigned()->nullable();
            //
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('users');

            $table->foreign('user_address_id')
                ->references('id')
                ->on('user_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
