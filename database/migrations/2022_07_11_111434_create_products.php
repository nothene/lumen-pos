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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('company_id')->unsigned()->nullable()->default(1);
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('color')->nullable();
            $table->boolean('is_raw_material');
            $table->boolean('is_active');
            $table->string('uom_name')->nullable()->default('buah');
            $table->integer('recipe_id')->unsigned()->nullable();

            // $table->foreign('company_id')->references('ID')
            //     ->on('companies')->onDelete('set null');

            // $table->foreign('recipe_id')->references('ID')
            //     ->on('recipes')->onDelete('set null');                
            
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
        Schema::dropIfExists('products');
    }
};
