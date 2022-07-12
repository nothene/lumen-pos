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
        Schema::create('recipe_details', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty_needed')->unsigned();

            // $table->foreign('recipe_id')->references('ID')
            //     ->on('recipes')->onDelete('set null');

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
        Schema::dropIfExists('recipe_details');
    }
};
