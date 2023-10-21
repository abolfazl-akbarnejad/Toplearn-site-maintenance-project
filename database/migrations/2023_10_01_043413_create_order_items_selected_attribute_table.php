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
        Schema::create('order_items_selected_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_attribute')->constrained('category_attributes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_value_id')->constrained('category_values')->onDelete('cascade')->onUpdate('cascade');
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items_selected_attribute');
    }
};
