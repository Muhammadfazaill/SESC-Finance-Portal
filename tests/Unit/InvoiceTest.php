<?php

namespace Tests\Unit;

use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testInvoiceCreation()
    {
        // Create a new invoice
        $invoice = Invoice::create([
            'reference_number' => 'REF123',
            'student_id' => 1,
            'amount' => 1000,
            'due_date' => '2023-06-15',
            'fee_type' => 'course',
            'status' => 'Outstanding',
        ]);

        // Check that the invoice was saved to the database
        $this->assertDatabaseHas('invoices', [
            'reference_number' => 'REF123',
            'student_id' => 1,
            'amount' => 1000,
            'due_date' => '2023-06-15',
            'fee_type' => 'course',
            'status' => 'Outstanding',
        ]);
    }
}
