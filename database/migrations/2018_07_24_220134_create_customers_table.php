<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id')->nullable();
            $table->integer('assignee_id')->index();
            $table->string('estimate_amount')->nullable();
            $table->integer('company_id')->index()->nullable();
            $table->integer('prospect_id')->unique()->nullable()->index();
            $table->string('bank_name');
            $table->string('bank_address');
            $table->string('owner_id');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('job_title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('bank_branch');
            $table->string('bank_code');
            $table->string('swiftcode');
            $table->string('bank_account_no');
            $table->string('payment_date');
            $table->string('payment_mode');
            $table->string('currency');
            $table->string('co_name_1');
            $table->string('co_contact_name_1');
            $table->string('co_address_1');
            $table->string('co_city_1');
            $table->string('co_postcode_1');
            $table->string('co_phone_1');
            $table->string('co_email_1');
            $table->string('co_comment_1');
            $table->string('co_name_2')->nullable();
            $table->string('co_contact_name_2')->nullable();
            $table->string('co_address_2')->nullable();
            $table->string('co_city_2')->nullable();
            $table->string('co_postcode_2')->nullable();
            $table->string('co_phone_2')->nullable();
            $table->string('co_email_2')->nullable();
            $table->string('co_comment_2')->nullable();
            $table->string('terms');
            $table->string('pin_cert');
            $table->string('vat_cert');
            $table->string('co_reg_cert');
            $table->string('rep_id_file');
            $table->string('directors_list');
            $table->string('utility_bill');
            $table->string('total_turnover_1');
            $table->string('total_assets_1');
            $table->string('current_assets_1');
            $table->string('total_liabilities_1');
            $table->string('current_liabilities_1');
            $table->string('profit_before_taxes_1');
            $table->string('profit_after_taxes_1');
            $table->string('total_turnover_2')->nullable();
            $table->string('total_assets_2')->nullable();
            $table->string('current_assets_2')->nullable();
            $table->string('total_liabilities_2')->nullable();
            $table->string('current_liabilities_2')->nullable();
            $table->string('profit_before_taxes_2')->nullable();
            $table->string('profit_after_taxes_2')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
