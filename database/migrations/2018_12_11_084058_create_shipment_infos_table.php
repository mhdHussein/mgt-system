<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sent_count');
            $table->double('sent_amount');
            $table->double('cash');
            $table->double('credit');
            $table->double('deposited_amount');
            $table->integer('returned_shipments');
            $table->integer('delivared_shipments');
            $table->integer('fiscal_deficit');
            $table->integer('lost_shipments');
            $table->integer('fuel');

            $table->integer('courier_id');
            $table->integer('supervisor_id');

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
        Schema::dropIfExists('shipment_infos');
    }
}
