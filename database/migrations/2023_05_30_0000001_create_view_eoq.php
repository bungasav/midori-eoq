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
        DB::statement("
        CREATE VIEW view_eoq AS
        select 
            i.Name ItemName, 
            AVG(od.BasePrice) ItemPrice, 
            SUM(od.Quantity) AS D, 
            AVG(od.BasePrice) * 0.2 AS H, 
            ROUND(
                AVG(od.BasePrice * od.Quantity), 
                3
            ) AS C, 
            ROUND(
                AVG(od.Quantity), 
                2
            ) AS R, 
            ROUND(
                SQRT(
                (
                2 * AVG(
                            od.BasePrice * od.Quantity * od.Quantity
                        )
                ) 
                / (
                    AVG(od.BasePrice) * 0.2
                )
                )
            ) AS EOQ 
            from 
            item i 
            LEFT JOIN orderdetail od on od.ItemId = i.ItemId 
            GROUP by 
            i.Name;
");
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_eoq");   
    }
};