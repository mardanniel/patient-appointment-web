<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname', 50);
            $table->string('mname', 50)->nullable();
            $table->string('lname', 50);
            $table->string('email', 200)->unique();
            $table->string('password');
            $table->boolean('gender');
            $table->date('dob');
            $table->string('contact_num');
            $table->string('street', 100);
            $table->string('barangay', 100);
            $table->string('city', 100);
            $table->string('profile_image')->default('default-profile.png');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_open')->default(1);
            $table->string('degree', 200);
            $table->string('expertise', 200);
            $table->rememberToken();
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
        Schema::dropIfExists('doctors');
    }
}
