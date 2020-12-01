<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('cost', 8, 2);
            $table->decimal('quantity', 8, 2);
            $table->unsignedInteger('cashier_id')->references('id')->on('users');
            $table->string('coupon_code')->default('NULL');
            $table->decimal('discount', 5, 2)->default(0);
            $table->string('comments', 255)->default('NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
