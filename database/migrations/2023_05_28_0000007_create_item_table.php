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
        Schema::create('item', function (Blueprint $table) {
            $table->id('ItemId');
            $table->string('Name');
            $table->bigInteger('SupplierId',false,true);
            $table->bigInteger('UserId',false,true);
            $table->string('Description',500);
            $table->integer('UnitInStock');
            $table->string('UnitOfMeasurement',100);
            $table->string('Status',100);
            $table->dateTime('CreatedDate');
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
        Schema::dropIfExists('item');
    }
};