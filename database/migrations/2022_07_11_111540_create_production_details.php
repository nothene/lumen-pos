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
        Schema::create('production_details', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('production_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('qty_used')->unsigned()->nullable();

            // $table->foreign('production_id')->references('ID')
            //     ->on('productions')->onDelete('set null');

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
        Schema::dropIfExists('production_details');
    }
};
