<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('account_number');
            $table->decimal('sum', 10, 2);
            $table->decimal('commission', 10, 2);
            $table->integer('currency_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('manager_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('bank_details_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
