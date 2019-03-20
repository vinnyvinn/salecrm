
  <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id')->index();
            $table->integer('assignee_id')->index();
            $table->integer('prospect_id')->index()->nullable();
            $table->integer('customer_id')->index()->nullable();
            $table->integer('opportunity_id')->index()->nullable();
            $table->integer('lead_id')->index()->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('type');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('cost')->default();
            $table->text('note')->nullable();
//            $table->timestamp('date');
            $table->timestamp('deadline')->nullable();
            $table->boolean('cancelled')->default(false);
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('activities');
    }
}
