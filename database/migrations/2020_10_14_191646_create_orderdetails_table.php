<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('qty');
            $table->integer('subtotal');
            $table->timestamps();
        });

        Schema::table('orderdetails', function (Blueprint $table) {
        $table->foreign('order_id')->references('id')->on('orders')
        ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('orderdetails', function (Blueprint $table) {
        $table->foreign('product_id')->references('id')->on('products')
        ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
}
