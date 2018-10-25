<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('name_de');
            $table->string('name_it');
            $table->string('description_en')->nullable();
            $table->string('description_fr')->nullable();
            $table->string('description_de')->nullable();
            $table->string('description_it')->nullable();
            $table->string('slug')->unique();
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->integer('order')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
