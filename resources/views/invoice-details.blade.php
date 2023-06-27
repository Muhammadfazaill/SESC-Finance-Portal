<!DOCTYPE html>
<html>
<head>
    <title>Invoice Details</title>
    <link href="{{ asset('css/finance_style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Invoice Details</h1>
        <table>
            <tr>
                <td><strong>Reference Number:</strong></td>
                <td>{{ $invoice->reference_number }}</td>
            </tr>
            <tr>
                <td><strong>Student ID:</strong></td>
                <td>{{ $invoice->student_id }}</td>
            </tr>
            <tr>
                <td><strong>Amount:</strong></td>
                <td>{{ $invoice->amount }}</td>
            </tr>
            <tr>
                <td><strong>Due Date:</strong></td>
                <td>{{ $invoice->due_date }}</td>
            </tr>
            <tr>
                <td><strong>Fee Type:</strong></td>
                <td>{{ $invoice->fee_type }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>
                    <span id="status">{{ $invoice->status }}</span>
                </td>
            </tr>
        </table>
        <br>
        <div style="text-align: center;">
            <a href="{{ route('invoices.index') }}" id="btnFindAnotherInvoice" style="display: inline-block; margin-right: 10px;">Find Another Invoice</a>
            @if ($invoice->status !== 'Paid')
                <form action="{{ route('invoices.pay', ['invoice' => $invoice->id]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Pay Invoice</button>
                </form>
            @endif
        </div>

    </div>
</body>
</html>
