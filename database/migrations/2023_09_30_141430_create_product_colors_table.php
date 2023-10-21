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
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('price_increase', 20, 3)->default(0);
            $table->tinyInteger('status')->default(0)->comment('0=> unActive  , 1 =>Active');
            $table->tinyInteger('sold_number')->default(0)->comment('تعداد محصول فروش رفته');
            $table->tinyInteger('frozen_number')->default(0);
            $table->tinyInteger('marketable_number')->default(1)->comment('تعداد قابل فروش');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
