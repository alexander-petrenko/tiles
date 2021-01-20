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
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->decimal('price', 12, 2);
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('shape_id')->nullable();
            $table->unsignedBigInteger('material_id')->nullable();
            $table->unsignedBigInteger('surface_id')->nullable();
            $table->unsignedBigInteger('style_id')->nullable();
            $table->bigInteger('length')->nullable();
            $table->bigInteger('width')->nullable();
            $table->bigInteger('weight')->nullable();
            $table->bigInteger('in_box')->nullable();
            $table->bigInteger('views')->nullable()->default(0);
            $table->string('url')->nullable()->unique();
            $table->timestamps();

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('set null');
            $table->foreign('shape_id')->references('id')->on('shapes')->onDelete('set null');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('set null');
            $table->foreign('surface_id')->references('id')->on('surfaces')->onDelete('set null');
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('set null');
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
