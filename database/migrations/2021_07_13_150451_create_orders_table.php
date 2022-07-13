<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('transaction_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned();
            // $table->bigInteger('status')->default(1); // 1 Pending, 2 To Ship, 3 Complete,  
            $table->string('status'); // 'pending', 'to ship', 'complete', 'cancelled';
            $table->bigInteger('payment_method')->default(1); // 1 Cash On Delivery, 2 Online Payment, 3 Pickup
            $table->string('customer_complete_address');
            $table->double('shipping_fee', 24, 2)->nullable();
            $table->timestamps();

            // $table->foreign('transaction_id')
            //     ->references('id')
            //     ->on('transactions');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('users');
            
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
        Schema::dropIfExists('orders');
    }
}
