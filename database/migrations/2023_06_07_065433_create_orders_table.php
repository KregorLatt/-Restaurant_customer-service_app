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
            $table->string('name',128);
            $table->integer('basePrice_cents');
            $table->text('description')->nullable();
            $table->dateTime('ordering_time');
            $table->unsignedBigInteger('MenuItem_id')->nullable()
                    ->references('id')
                    ->on('MenuItem');
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
