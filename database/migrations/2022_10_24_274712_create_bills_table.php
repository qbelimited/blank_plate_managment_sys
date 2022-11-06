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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('received_item_id')->constrained();
            $table->string('invoice');
            $table->foreignId('currency_id')->constrained();
            $table->string('note')->nullable();
            $table->boolean('ispaid')->default(0);
            $table->date('paid_at')->nullable();
            $table->string('paid_by')->nullable();
            $table->string('method_of_payment')->nullable();
            $table->boolean('isconfirmed')->default(0);
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
        Schema::dropIfExists('bills');
    }
};
