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
        Schema::create('transactionDetail', function (Blueprint $table) {
            $table->id('TransactionDetailId');
            $table->bigInteger('TransactionId',false,true);
            $table->bigInteger('ItemId',false,true);
            $table->integer('Quantity');
            $table->string('Status',100);

            $table->foreign('TransactionId')->references('TransactionId')->on('transaction')->onDelete('cascade');
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
        Schema::dropIfExists('transactionDetail');
    }
};