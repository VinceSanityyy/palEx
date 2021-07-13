<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->bigInteger('quantity')->unsigned();
            $table->double('price', 24, 2)->nullable();

            $table->bigInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('users');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
