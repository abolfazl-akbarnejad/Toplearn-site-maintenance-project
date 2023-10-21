<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // سوال
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable()->comment('عنوان');
            $table->text('description');
            $table->tinyInteger('status')->default(0)->comment('0=> unActive  , 1 =>Active');
            $table->tinyInteger('seen')->default(0)->comment('0 => unseen(دیده نشده)  , 1 => seen(دیده شده)');
            $table->foreignId('reference_id')->constrained('ticket_admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('ticket_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('priority_id')->constrained('ticket_priorities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
