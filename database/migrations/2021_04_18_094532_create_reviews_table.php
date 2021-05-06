<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->integer('rating');
            $table->text('review', 250);
            $table->timestamps();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('adoption_id');
            $table->foreign('adoption_id')->references('id')->on('adoptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
