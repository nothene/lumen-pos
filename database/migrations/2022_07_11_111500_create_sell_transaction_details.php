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
        Schema::create('sell_transaction_details', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('sell_transaction_id')->unsigned();
            $table->integer('product_id');
            $table->integer('qty');
            $table->bigInteger('price');
            $table->decimal('disc_1', 8, 4)->nullable();
            $table->decimal('disc_2', 8, 4)->nullable();
            $table->bigInteger('disc_amount')->nullable();
            $table->bigInteger('total');
            $table->integer('cogs')->nullable();

            // $table->foreign('sell_transaction_id')->references('ID')
            //     ->on('sell_transactions')->onDelete('set null');

            // $table->foreign('product_id')->references('ID')
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
        Schema::dropIfExists('sell_transaction_details');       
    }
};
