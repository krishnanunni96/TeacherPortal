<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_settings', function (Blueprint $table) {
            $table->id();
            $table->string('application_name');
            $table->string('application_title');
            $table->longText('app_logo');
            $table->longText('favicon');
            $table->string('mobile');
            $table->string('email_id');
            $table->string('currency_symbol');
            $table->integer('tax_percentage');
            $table->integer('payrun_period');
            $table->integer('total_paid_leave');
            $table->string('country');
            $table->string('state');
            $table->string('district');
            $table->string('pincode');
            $table->longText('address');
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
        Schema::dropIfExists('master_settings');
    }
}
