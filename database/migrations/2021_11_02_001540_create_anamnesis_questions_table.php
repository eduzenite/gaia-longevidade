<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnamnesisQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anamnesis_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anamnesis_question_id')->nullable()->foreign('anamnesis_question_id')->references('id')->on('anamnesis_questions');
            $table->string('type', 2);
            $table->json('question');
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
        Schema::dropIfExists('anamnesis_questions');
    }
}
