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
            $table->integer('purchase_transaction_id')->unsigned()->onDelete('cascade');
            $table->integer('raw_material_id')->unsigned();
            $table->integer('qty');
            // per uom
            $table->bigInteger('price');
            $table->decimal('disc_1', 8, 4)->nullable();
            $table->decimal('disc_2', 8, 4)->nullable();
            $table->bigInteger('disc_amount')->nullable();
            // with discounts applied
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

