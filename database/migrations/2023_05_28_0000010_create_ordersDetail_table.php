<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderDetail', function (Blueprint $table) {
            $table->id('OrderDetailId');
            $table->bigInteger('OrderId',false,true);
            $table->bigInteger('ItemId',false,true);
            $table->integer('Quantity');
            $table->string('Status',100);
            $table->float('BasePrice')->nullable();

            $table->foreign('OrderId')->references('OrderId')->on('order')->onDelete('cascade');
            $table->foreign('ItemId')->references('ItemId')->on('item')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderDetail');
    }
};