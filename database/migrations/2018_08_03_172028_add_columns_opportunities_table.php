<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunities', function (Blueprint $table) {
            $table->integer('customer_id')->nullable()->index();
            $table->integer('creator_id')->nullable()->index();
            $table->integer('assignee_id')->nullable()->index();
            $table->timestamp('deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->dropColumn('deadline');
            $table->dropColumn('creator_id');
            $table->dropColumn('assignee_id');

        });
    }
}
