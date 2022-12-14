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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plate_color_id')->constrained();
            $table->foreignId('plate_dimension_id')->constrained();
            $table->integer('batch_code');
            $table->integer('quantity');
            $table->tinyInteger('job_status')->default(0);
            $table->integer('serial_starts');
            $table->foreignId('production_week_id')->constrained();
            $table->foreignId('production_year_id')->constrained();
            $table->timestamp('manufacture_date')->useCurrent();
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
        Schema::dropIfExists('productions');
    }
};
