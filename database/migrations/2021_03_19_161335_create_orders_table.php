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
            $table->string('code');
            $table->string('customer');
            $table->string('phone_number');
            $table->string('email');
            $table->string('product_id');
            $table->integer('number_order');
            $table->string('image');
            $table->char('total');
            $table->string('province');
            $table->string('district');
            $table->string('ward');
            $table->string('way');
            $table->enum('status', [0, 1, 2, 3]);
            $table->string('note');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
