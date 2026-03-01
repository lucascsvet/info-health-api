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
        DB::table('genders')->insert([
            ['id' => 1, 'description' => 'Masculino'],
            ['id' => 2, 'description' => 'Feminino'],
            ['id' => 3, 'description' => 'Não informado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('genders')->truncate();
    }
};
