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
            $table->id()->unsigned();
            $table->string('name');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->text('image')->nullable();
            $table->text('desc')->nullable();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('in_price')->default(0);
            $table->bigInteger('out_price')->default(0);
            $table->integer('status')->default(1);
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
