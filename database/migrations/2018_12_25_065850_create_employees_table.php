<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_number');
            $table->string('name');
            $table->string('nationality');
            $table->string('marital_status');
            $table->dateTime('birth_date');
            $table->dateTime('hire_date');
            $table->string('iqama');
            $table->dateTime('iqama_exp');
            $table->string('proffesion')->nullable();
            $table->string('sponsorship_transfer')->nullable();
            $table->string('insurance')->nullable();
            $table->string('division');
            $table->string('job_title')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->double('salary');
            $table->text('notes')->nullable();

            $table->integer('department_id');
            $table->integer('city_id');

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
        Schema::dropIfExists('employees');
    }
}
