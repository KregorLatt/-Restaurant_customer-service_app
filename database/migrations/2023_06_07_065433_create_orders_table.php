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

            $table->text('description')->nullable();
            $table->dateTime('order_time');
            $table->unsignedBigInteger('menu_item_id')->nullable()
                    ->references('id')
                    ->on('menu_items');
            $table->unsignedBigInteger('server_id')
            ->references('id')
            ->on('users');
            $table->timestamps();
            $table->boolean('done');
            $table->boolean('delivered');

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
