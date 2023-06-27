<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateCourseInvoice()
    {
        // Create a new student
        $student = Student::factory()->create();

        $response = $this->json('POST', '/createcourse', [
            'student_id' => $student->id,
            'course_id' => 'COURSE123',
            'price' => 500,
            'feetype' => 'course',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Invoice created successfully']);

        // Verify that the invoice was saved to the database
        $this->assertDatabaseHas('invoices', [
            'student_id' => $student->id,
            'reference_number' => 'COURSE123',
            'amount' => 500,
            'fee_type' => 'course',
            'status' => 'Outstanding',
        ]);
    }

    public function testCreateLibraryInvoice()
    {
        // Create a new student
        $student = Student::factory()->create();

        $response = $this->json('POST', '/createlibraryinvoice', [
            'student_id' => $student->id,
            'amount' => 200,
            'type' => 'library',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Invoice created successfully']);

        // Verify that the invoice was saved to the database
        $this->assertDatabaseHas('invoices', [
            'student_id' => $student->id,
            'amount' => 200,
            'fee_type' => 'library',
            'status' => 'Outstanding',
        ]);
    }
}
