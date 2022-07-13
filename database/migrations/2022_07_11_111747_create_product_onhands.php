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
        Schema::create('product_onhands', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            // negative allowed
            $table->integer('qty')->nullable();

            $table->unique(['company_id', 'product_id']);

            // $table->foreign('company_id')->references('ID')
            //     ->on('companies')->onDelete('set null');

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
        Schema::dropIfExists('product_onhands');
    }
};
