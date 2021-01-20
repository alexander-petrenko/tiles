<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('texture_id')->nullable();
            $table->string('url')->nullable()->unique();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('texture_id')->references('id')->on('textures')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
