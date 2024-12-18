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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->cascadeOnDelete()->cascadeOnUpdate();  
            $table->boolean('cart')->default(false);
            $table->string('orderLocation')->default('null');
            $table->double('orderPrice')->default(0);
            $table->double('deliveryPrice')->default(0);
            $table->double('totalPrice')->default(0);
            $table->string('bankAccount')->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
