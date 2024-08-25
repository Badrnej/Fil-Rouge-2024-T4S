<?php

// database/migrations/xxxx_xx_xx_create_delivery_services_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryServicesTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_services');
    }
}
