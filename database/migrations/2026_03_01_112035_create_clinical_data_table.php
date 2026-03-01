<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clinical_data', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('gender');
            $table->foreign('gender')->references('id')->on('genders');

            $table->integer('blood_type');
            $table->foreign('blood_type')->references('id')->on('blood_types');

            $table->integer('emergency_contact_id')->nullable();
            $table->foreign('emergency_contact_id')->references('id')->on('emergency_contacts')->onDelete('cascade');

            $table->text('allergies')->nullable();
            $table->text('medications')->nullable();
            $table->text('diseases')->nullable();
            $table->text('surgeries')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinical_data', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['gender']);
            $table->dropForeign(['blood_type']);
            $table->dropForeign(['emergency_contact_id']);
        });

        Schema::dropIfExists('clinical_data');
    }
};
