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
            $table->string('name')->nullable(false);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->double('price')->nullable(false);
            $table->boolean('offer')->default(false)->nullable();
            $table->double('offer_price')->nullable();
            $table->boolean('status')->default(false)->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->foreignId('category_id')->constrained('categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
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
