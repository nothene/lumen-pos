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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');
        
            $table->foreign('recipe_id')->references('ID')
                ->on('recipes')->onDelete('set null'); 
        });

        Schema::table('product_price', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');

            $table->foreign('product_id')->references('ID')
                ->on('products')->onDelete('set null');      
        });

        Schema::table('sell_transactions', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');    
        });     
        
        Schema::table('sell_transaction_details', function (Blueprint $table) {
            $table->foreign('sell_transaction_id')->references('ID')
                ->on('sell_transactions')->onDelete('set null');

            $table->foreign('product_id')->references('ID')
                ->on('products')->onDelete('set null');
        });    

        Schema::table('recipes', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');   
        });

        Schema::table('recipe_details', function (Blueprint $table) {
            $table->foreign('recipe_id')->references('ID')
                ->on('recipes')->onDelete('set null');

            $table->foreign('product_id')->references('ID')
                ->on('products')->onDelete('set null');     
        });

        Schema::table('productions', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');

            $table->foreign('recipe_id')->references('ID')
                ->on('recipes')->onDelete('set null');                

            $table->foreign('product_id')->references('ID')
                ->on('products')->onDelete('set null'); 
        });        

        Schema::table('production_details', function (Blueprint $table) {
            $table->foreign('production_id')->references('ID')
                ->on('productions')->onDelete('set null');

            $table->foreign('product_id')->references('ID')
                ->on('products')->onDelete('set null');     
        }); 

        Schema::table('purchase_transactions', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');                         
        });         
        
        Schema::table('purchase_transaction_details', function (Blueprint $table) {
            $table->foreign('purchase_transaction_id')->references('ID')
                ->on('purchase_transactions')->onDelete('set null');

            $table->foreign('raw_material_id')->references('ID')
                ->on('products')->onDelete('set null');
        });                 

        Schema::table('product_onhands', function (Blueprint $table) {
            $table->foreign('company_id')->references('ID')
                ->on('companies')->onDelete('set null');

            $table->foreign('product_id')->references('ID')
                ->on('products')->onDelete('set null');                                        
        });                         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['company_id', 'recipe_id']);
        });

        Schema::table('product_price', function (Blueprint $table) {
            $table->dropForeign(['company_id', 'product_id']);
        });        

        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });     

        Schema::table('recipe_details', function (Blueprint $table) {
            $table->dropForeign(['recipe_id', 'product_id']);
        });     
    }
};
