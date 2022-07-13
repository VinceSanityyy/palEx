<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('full_name');
            $table->string('phone');
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();;
            $table->string('province')->nullable();
            $table->boolean('selected')->default(false);
            $table->bigInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('customer_id')
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
        Schema::dropIfExists('customer_addresses');
    }
}
