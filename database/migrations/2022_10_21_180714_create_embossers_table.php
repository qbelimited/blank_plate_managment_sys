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
        Schema::create('embossers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plate_id')->constrained();
            $table->foreignId('embosser_color_id')->constrained();
            $table->foreignId('serial_number_id')->constrained();
            $table->string('embosser_text');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('embossers');
    }
};
