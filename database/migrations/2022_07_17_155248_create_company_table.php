<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('email')->unique();
            $table->string('postcode', 11);
            $table->integer('prefecture_id', 11)->unsigned();
            $table->text('city');
            $table->text('local');
            $table->text('street_address')->nullable();
            $table->text('busines_hour')->nullable();
            $table->text('regular_holiday')->nullable();
            $table->text('phone')->nullable();
            $table->text('fax')->nullable();
            $table->text('url')->nullable();
            $table->text('license_number')->nullable();
            $table->text('image');
            $table->timestamps();
            $table->foreign('prefecture_id')->references('id')->on('prefectures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
