<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id')->index();
            $table->integer('owner_id')->index();
            $table->integer('assignee_id')->nullable()->index();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('job_title')->nullable();
            $table->string('email')->nullable(); 
            $table->string('phone')->nullable();
            $table->text('description');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('status')->default('open');
            $table->integer('stage')->default(0);
            $table->boolean('trashed')->default(false);
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
        Schema::dropIfExists('leads');
    }
}
