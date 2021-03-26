<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->string('title', 70);
            $table->longText('description');
            $table->boolean('dog_of_the_week');
            $table->boolean('adopted');
            $table->longText('image_ids'); // foreign keys - de a controllerben fogom beallitani, mivel tobb kep idt is akarok tombben jsonna alakitva lementeni
            $table->timestamps();
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('animal_type_id');
            $table->foreign('animal_type_id')->references('id')->on('animal_types');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
