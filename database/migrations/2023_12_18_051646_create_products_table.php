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
            $table->string('product_name');
            $table->foreignId('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->string('sku');  
            $table->string('product_icon')->nullable();
            $table->string('product_gallery')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_dprice')->nullable();
            $table->integer('product_discount')->nullable();
            $table->string('qty')->default(0);
            $table->text('product_description')->nullable();
            $table->integer('product_lquantity');
            $table->string('product_shipping')->nullable();
            $table->integer('return')->default(0);
            $table->integer('codstatus')->default(0);
            $table->integer('status')->default(0);
            $table->string('shiptime')->nullable();
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
