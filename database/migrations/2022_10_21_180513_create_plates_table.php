<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->string('number_plate');
            $table->foreignId('plate_color_id')->constrained();
            $table->foreignId('plate_dimension_id')->constrained();
            $table->boolean('storage');
            $table->foreignId('warehouse_id')->nullable()->constrained();
            $table->foreignId('serial_number_id')->constrained();
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
        Schema::dropIfExists('plates');
    }
};
