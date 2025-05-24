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
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedInteger('subcategory_id');
            $table->unsignedInteger('category_id');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('old_price')->nullable();
            $table->string('new_price')->nullable();
            $table->string('stock')->nullable();
            $table->string('stock_status')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('warranty')->nullable();
            $table->string('warranty_unit')->nullable();
            $table->string('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('status')->default(1);
            $table->string('featured')->default(0);
            $table->string('best_selling')->default(0);
            $table->string('new_arrival')->default(0);
            $table->string('trending')->default(0);
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
