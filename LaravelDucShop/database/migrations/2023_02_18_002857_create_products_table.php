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
            $table->float("price");
            $table->longText('description');
            $table->string("type")->default("Fruit And Vegetable")->nullable();
            $table->string("image_path")->nullable();
            $table->tinyInteger("cart")->default(0)->nullable();
            $table->integer("cart_quantity")->default(1)->nullable();
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
