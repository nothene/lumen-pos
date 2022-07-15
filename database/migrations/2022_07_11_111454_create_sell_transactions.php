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
        Schema::create('sell_transactions', function (Blueprint $table) {
            $table->increments('ID')->unsigned();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->boolean('is_cancelled')->default(false)->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->boolean('is_printed')->default(false)->nullable();
            $table->timestamp('printed_at')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->integer('disc_amount')->nullable();
            $table->bigInteger('grand_total')->nullable();
            $table->text('notes')->nullable();

            // $table->foreign('company_id')->references('ID')
            //     ->on('companies')->onDelete('set null');            
            
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
        Schema::dropIfExists('sell_transactions');
    }
};
