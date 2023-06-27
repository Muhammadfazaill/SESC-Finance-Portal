<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Insert dummy data for the students table
        DB::table('students')->insert([
            ['student_id' => 'c1001', 'student_name' => 'John Doe'],
            ['student_id' => 'c1002', 'student_name' => 'Jane Smith'],
        ]);

        // Insert dummy data for the invoices table
        DB::table('invoices')->insert([
            [
                'reference_number' => 'INV001',
                'student_id' => 'c1001',
                'amount' => 100.00,
                'due_date' => '2023-06-10',
                'fee_type' => 'Tuition',
                'status' => 'Outstanding',
            ],
            [
                'reference_number' => 'INV002',
                'student_id' => 'c1002',
                'amount' => 150.00,
                'due_date' => '2023-06-15',
                'fee_type' => 'Registration',
                'status' => 'Outstanding',
            ],
        ]);
    }
}
