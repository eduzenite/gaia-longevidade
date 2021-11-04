<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id')->foreign('menu_id')->references('id')->on('menus');
            $table->string('title');
            $table->string('amount', 50);
            $table->string('calorie', 50);
            $table->json('time');
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
        Schema::dropIfExists('menu_food');
    }
}
