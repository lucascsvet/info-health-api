<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('blood_types')->insert([
            ['id' => 1, 'description' => 'A+'],
            ['id' => 2, 'description' => 'A-'],
            ['id' => 3, 'description' => 'B+'],
            ['id' => 4, 'description' => 'B-'],
            ['id' => 5, 'description' => 'AB+'],
            ['id' => 6, 'description' => 'AB-'],
            ['id' => 7, 'description' => 'O+'],
            ['id' => 8, 'description' => 'O-'],
            ['id' => 10, 'description' => 'Não informado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('blood_types')->truncate();
    }
};
