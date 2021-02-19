<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->float('sub_total',15,2);
            $table->float('tax',15,2);
            $table->float('grand_total',15,2);
            $table->string('invoice_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status');
            $table->string('payment_token')->nullable();
            $table->string('communication_mode');
            $table->unsignedTinyInteger('status');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
