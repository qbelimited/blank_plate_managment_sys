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
            $table->unsignedInteger('platetype_id');
            $table->foreign('platetype_id')->references('id')->on('platetypes_table');
            $table->unsignedInteger('platedimension_id');
            $table->foreign('platedimension_id')->references('id')->on('platedimensions_table');
            $table->integer('quantity');
            $table->integer('generate');
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
