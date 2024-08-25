<?php

// database/migrations/xxxx_xx_xx_create_inventories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity');
            $table->string('location');
            $table->foreignId('managed_by')->constrained('users');
            $table->datetime('last_updated');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
