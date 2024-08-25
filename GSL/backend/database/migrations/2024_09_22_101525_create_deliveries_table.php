<?php

// database/migrations/xxxx_xx_xx_create_deliveries_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained();
            $table->foreignId('delivery_service_id')->constrained();
            $table->foreignId('deliverer_id')->constrained('users');
            $table->string('status');
            $table->datetime('estimated_delivery');
            $table->datetime('actual_delivery')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
