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
            $table->bigInteger('user_id')->unsigned();
            $table->string('invoice')->unique();
            $table->string('customer_name', 100);
            $table->integer('total');
            $table->integer('pay');
            $table->string('note')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
        $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
