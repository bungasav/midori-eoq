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
        Schema::create('order', function (Blueprint $table) {
            $table->id('OrderId');
            $table->string('OrderReference',100);
            $table->dateTime('OrderDate');
            $table->float('TotalAmount');
            $table->bigInteger('SupplierId',false,true);
            $table->bigInteger('UserId',false,true);
            $table->string('Status',100);

            $table->foreign('SupplierId')->references('SupplierId')->on('supplier')->onDelete('cascade');
            $table->foreign('UserId')->references('UserId')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};