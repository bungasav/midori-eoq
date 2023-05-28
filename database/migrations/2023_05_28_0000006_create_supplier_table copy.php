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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id('SupplierId');
            $table->string('Name');
            $table->string('Address',500);
            $table->string('PhoneNumber',100);
            $table->string('BankName',100);
            $table->string('AccountName');
            $table->string('AccountNumber',100);
            $table->string('Status',100);
            $table->dateTime('CreatedDate');
            $table->string('CreatedBy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier');
    }
};