<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('name')->nullable();
            $table->foreignId('description')->nullable();
            $table->foreignId('price')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('weight')->nullable();
            $table->foreignId('length')->nullable();
            $table->foreignId('height')->nullable();
            $table->foreignId('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
