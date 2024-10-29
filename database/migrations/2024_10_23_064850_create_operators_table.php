<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->integer('customer_id');
            $table->integer('id')->primary();
            $table->string('name', 100);
            $table->string('surname_1', 100)->nullable();
            $table->string('surname_2', 100)->nullable();
            $table->integer('phone')->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('order_notifications_enabled');
            $table->string('order_notifications_email', 100)->nullable();
            $table->boolean('order_notifications_by_email');
            $table->boolean('order_notifications_by_sms');
            $table->boolean('order_notifications_by_push');
            $table->boolean('deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};
