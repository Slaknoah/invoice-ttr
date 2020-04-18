<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenceToInvoiceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedInteger('tourist_id');
            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('service_id');
            $table->foreign('tourist_id')->references('id')->on('tourists');
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_tourist_id_foreign');
            $table->dropForeign('invoices_hotel_id_foreign');
            $table->dropForeign('invoices_service_id_foreign');
            $table->dropColumn(['tourist_id', 'hotel_id', 'service_id']);
        });
    }
}
