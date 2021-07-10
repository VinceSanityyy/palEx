<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('quantity')->unsigned();
            $table->boolean('selected')->default(false);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('cart_id')
                ->references('id')
                ->on('carts');

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
        Schema::dropIfExists('cart_items');
    }
}
