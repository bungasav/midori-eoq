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
        Schema::create('productionDetail', function (Blueprint $table) {
            $table->id('ProductionDetailId');
            $table->bigInteger('ProductionId',false,true);
            $table->bigInteger('ItemId',false,true);
            $table->tinyInteger('Quantity');
            $table->string('Status',100);
            $table->bigInteger('UserId',false,true);
            $table->dateTime('CreatedDate');

            $table->foreign('ProductionId')->references('ProductionId')->on('production')->onDelete('cascade');
            $table->foreign('ItemId')->references('ItemId')->on('item')->onDelete('cascade');
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
        Schema::dropIfExists('productionDetail');
    }
};