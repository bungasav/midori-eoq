<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW view_rop AS
        SELECT 
        i.Name, 
        SUM(od.Quantity) OrderCount, 
        (
          (
            (5 / 100) * SUM(pd.Quantity)
          ) + SUM(pd.Quantity)
        ) X, 
        SUM(pd.Quantity) Y, 
        (
          (
            (
              (5 / 100) * SUM(pd.Quantity)
            ) + SUM(pd.Quantity)
          ) - SUM(pd.Quantity)
        ) 'X-Y', 
        ROUND(
          (
            1.65 * (
              SQRT(
                POW(
                  (
                    (
                      (
                        (5 / 100) * (
                          SUM(pd.Quantity)
                        )
                      ) + (
                        SUM(od.Quantity)
                      )
                    ) - (
                      SUM(pd.Quantity)
                    )
                  ), 
                  2
                ) / 12
              )
            )
          ), 
          3
        ) AS safety_stock, 
        ROUND(
          (
            3 * (
              SUM(pd.Quantity) / 360
            )
          ), 
          3
        ) AS LQ, 
        ROUND(
          (
            (
              1.65 * (
                SQRT(
                  POW(
                    (
                      (
                        (
                          (5 / 100) * (
                            SUM(pd.Quantity)
                          )
                        ) + (
                          SUM(pd.Quantity)
                        )
                      ) - (
                        SUM(pd.Quantity)
                      )
                    ), 
                    2
                  ) / 12
                )
              )
            ) + (
              3 * (
                SUM(pd.Quantity) / 360
              )
            )
          ), 
          3
        ) AS ROP 
      FROM 
        item i 
        JOIN orderdetail od on od.ItemId = i.ItemId 
        LEFT JOIN productiondetail pd on pd.ItemId = i.ItemId 
        LEFT JOIN `order` o on od.OrderId = o.OrderId 
        where i.Type = 'material'
        and i.status = 'ACTIVE' 
        and o.Status = 'APPROVED'
      GROUP BY 
        i.Name");
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_rop");
    }
};