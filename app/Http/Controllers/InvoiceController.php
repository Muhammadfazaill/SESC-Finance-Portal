<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('payment-portal');
    }

    public function find(Request $request)
    {
        $referenceNumber = $request->input('referenceNumber');

        $invoice = Invoice::where('reference_number', $referenceNumber)->first();

        if ($invoice) {
            return redirect()->route('invoices.show', $invoice);
        } else {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found.');
        }
    }

    public function createcourse(Request $request)
    {
        // Gather course registration data from the request
        $student_id = $request->input('student_id');
        $course_id = $request->input('course_id');
        $price = $request->input('price');
        $fee_type = $request->input('feetype');
        $currentDate = Carbon::now();
        $newDate = $currentDate->addDays(7);

        $invoice = new Invoice(); 
        $invoice->student_id = $student_id;
        $invoice->reference_number = $course_id;
        $invoice->amount = $price; 
        $invoice->fee_type = $fee_type;
        $invoice->status = 'Outstanding';
        $invoice->due_date = $newDate;
        $invoice->save();
        return response()->json(['message' => 'Invoice created successfully']);
    }

    public function createlibraryinvoice(Request $request)
    {
        $student_id = $request->input('student_id');
        $ref_no = Str::random(8);
        $price = $request->input('amount');
        $fee_type = $request->input('type');
        $due_date = $request->input('due_date');
        
        $invoice = new Invoice(); 
        $invoice->student_id = $student_id;
        $invoice->reference_number = $ref_no;
        $invoice->amount = $price; 
        $invoice->fee_type = $fee_type;
        $invoice->status = 'Outstanding';
        $invoice->due_date = $due_date;
        $invoice->save();return response()->json(['message' => 'Invoice created successfully', 'reference' => $ref_no]);
    }

    public function getOutstandingInvoices(Request $request)
    {
        // Retrieve the student ID from the request
        $studentId = $request->input('student_id');

        // Find the outstanding invoices for the student
        $invoices = Invoice::where('student_id', $studentId)
                           ->where('status', 'Outstanding')
                           ->get();
        if ($invoices->isEmpty()) {
                            // Return a 404 status code if no invoices are found
            return response()->json(['message' => 'No outstanding invoices found'], 404);
        }
                    
        // Return the outstanding invoices
        return response()->json($invoices, 200);
    }
    
    public function createstudent(Request $request)
    {
        $userId = $request->input('student_id');
        $firstName = $request->input('name');

        // Create a new student record
        $student = new Student();
        $student->student_id = $userId;
        $student->student_name = $firstName;

        $student->save();

        return response()->json(['message' => 'Student created successfully']);
    }

    public function show(Invoice $invoice)
    {
        return view('invoice-details', compact('invoice'));
    }

    public function pay(Invoice $invoice)
    {
        // Update the invoice status to 'Paid'
        $invoice->status = 'Paid';
        $invoice->save();
        return redirect()->route('invoices.show', $invoice);
    }
}
