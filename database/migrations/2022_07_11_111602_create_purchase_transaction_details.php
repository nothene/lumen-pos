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
        Schema::create('purchase_transaction_details', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('purchase_transaction_id')->unsigned();
            $table->integer('raw_material_id')->unsigned();
            $table->integer('qty');
            $table->bigInteger('price');
            $table->integer('disc_1')->nullable();
            $table->integer('disc_2')->nullable();
            $table->integer('disc_amount')->nullable();
            $table->bigInteger('total');

            // $table->foreign('purchase_transaction_id')->references('ID')
            //     ->on('purchase_transactions')->onDelete('set null');

            // $table->foreign('raw_material_id')->references('ID')
            //     ->on('products')->onDelete('set null');
            
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
        Schema::dropIfExists('purchase_transaction_details');
    }
};

