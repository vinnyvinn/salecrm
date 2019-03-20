<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id')->index();
            $table->integer('assignee_id')->index();
            $table->integer('lead_id')->unique()->index();
            $table->string('estimate_amount');
            $table->timestamp('deadline');
            $table->integer('company_id')->nullable();
            $table->string('status')->default('open');
            $table->string('stage')->default(0);
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
        Schema::dropIfExists('prospects');
    }
}
