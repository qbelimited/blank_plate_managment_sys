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
            $table->unsignedInteger('platedimension_id');
            $table->integer('quantity');
            $table->integer('generate');
            $table->timestamp('manufacture_date')->useCurrent();
            $table->timestamps();

            $table->foreign('platetype_id')->references('id')->on('platetypes_table');
            $table->foreign('platedimension_id')->references('id')->on('platedimensions_table');
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
