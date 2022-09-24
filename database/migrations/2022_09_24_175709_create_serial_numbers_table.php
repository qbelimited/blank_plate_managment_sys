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
        Schema::create('serialnumbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('production_id');
            $table->string('serial');
            $table->timestamps();

            $table->foreign('production_id')->references('id')->on('productions_table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serialnumbers');
    }
};
