<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pending_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id');
            $table->integer('operator_id');
            $table->string('order_number');
            $table->string('message_type');
            $table->timestamp('create_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_notifications');
    }
};
