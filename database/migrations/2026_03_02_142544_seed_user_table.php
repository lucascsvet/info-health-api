<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $userId = DB::table('users')->insertGetId([
            'cpf' => '12345678901',
            'first_name' => 'Admin',
            'last_name' => 'Sistema',
            'phone' => '11999999999',
            'email' => 'admin@infohealth.com',
            'password' => Hash::make('123456'),
            'public_password' => '1234',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $emergencyContactId = DB::table('emergency_contacts')->insertGetId([
            'name' => 'Contato Emergência Admin',
            'phone' => '11988888888',
        ]);

        DB::table('clinical_data')->insert([
            'user_id' => $userId,
            'gender' => 1,
            'blood_type' => 7,
            'emergency_contact_id' => $emergencyContactId,
            'allergies' => 'Nenhuma',
            'medications' => 'Nenhum',
            'diseases' => 'Nenhuma',
            'surgeries' => 'Nenhuma',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $user = DB::table('users')->where('email', 'admin@infohealth.com')->first();
        if ($user) {
            $clinicalData = DB::table('clinical_data')->where('user_id', $user->id)->first();
            if ($clinicalData) {
                DB::table('clinical_data')->where('user_id', $user->id)->delete();
                if ($clinicalData->emergency_contact_id) {
                    DB::table('emergency_contacts')->where('id', $clinicalData->emergency_contact_id)->delete();
                }
            }
            DB::table('users')->where('id', $user->id)->delete();
        }
    }
};
