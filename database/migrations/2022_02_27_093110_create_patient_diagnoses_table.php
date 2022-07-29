<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_diagnoses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('pa_id')->constrained('patient_appointments');
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->string('diagnosis', 250)->nullable();
            $table->char('temp', 2);
            $table->char('bp', 3);
            $table->char('weight', 3);
            $table->char('height', 3);
            $table->char('pulse_rate', 3);
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
        Schema::table('patient_diagnoses', function(Blueprint $table){
            $table->dropForeign(['pa_id', 'patient_id', 'doctor_id']);
            $table->drop();
        });
    }
}
