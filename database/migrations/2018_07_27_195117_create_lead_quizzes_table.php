<?php

    use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('questions');
            $table->boolean('trashed')->default(0);
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
        Schema::dropIfExists('lead_quizzes');
    }
}
