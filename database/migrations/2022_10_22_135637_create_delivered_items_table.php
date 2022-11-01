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
        Schema::create('delivered_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plate_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->boolean('delivered')->default(0);
            $table->date('date')->nullable();
            $table->foreignId('company_id')->constrained();
            $table->string('quantity');
            $table->string('cost');
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
        Schema::dropIfExists('delivered_items');
    }
};
