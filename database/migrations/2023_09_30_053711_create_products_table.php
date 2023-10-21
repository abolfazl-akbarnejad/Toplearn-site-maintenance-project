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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('interoduction')->comment("توضیخات ");
            $table->string('slug')->unique()->nullable();
            $table->text('image');
            $table->decimal('weght', 10, 2)->comment('وزن');
            $table->decimal('length', 10, 1)->comment('طول');
            $table->decimal('width', 10, 1)->comment('عرض');
            $table->decimal('hitght', 10, 1)->comment('ارتفاع');
            $table->decimal('price', 20, 3)->comment('قیمت');
            $table->tinyInteger('status')->default(0)->comment('0=> unActive  , 1 =>Active');
            $table->tinyInteger('marketable')->default(1)->comment('1 => can be sold , 0=> not for selling');
            $table->text('tags');
            $table->tinyInteger('sold_number')->default(0)->comment('تعداد محصول فروش رفته');
            $table->tinyInteger('frozen_number')->default(0);
            $table->tinyInteger('marketable_number')->default(1)->comment('تعداد قابل فروش');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
