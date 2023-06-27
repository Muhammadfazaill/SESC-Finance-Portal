<!DOCTYPE html>
<html>
<head>
    <title>Payment Portal</title>
    <link href="{{ asset('css/finance_style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div id="payment_portal">
            <h1>Payment Portal</h1>
            @if (session('error'))
                <div id="error">{{ session('error') }}</div><br>
            @endif
            <div>
                <form action="{{ route('invoices.find') }}" method="POST">
                    @csrf
                    <label for="reference_number">Reference Number:</label>
                    <input type="text" name="referenceNumber" placeholder="Enter reference number" required>
                    <button type="submit">Find Invoice</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
