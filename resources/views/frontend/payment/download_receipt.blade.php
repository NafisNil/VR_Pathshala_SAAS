<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $data['element'][0]['tran_id'] ?? 'Receipt' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
        }
        /* Page setup for PDF printing */
        @page { margin: 0; }
        @media print {
            body { background-color: white; -webkit-print-color-adjust: exact; }
            .print-shadow-none { box-shadow: none !important; }
        }
    </style>
</head>
<body class="p-8">
    <div class="max-w-4xl mx-auto bg-white p-10 shadow-lg print-shadow-none rounded-lg" style="min-height: 1000px;">
        @if(isset($data['element']) && count($data['element']) > 0)
            @php
                $receipt = $data['element'][0];
            @endphp
            
            <!-- Header -->
            <div class="flex justify-between items-start mb-12">
                <div>
                    <h1 class="text-4xl font-extrabold text-blue-600 tracking-wider">INVOICE</h1>
                    <p class="text-gray-500 font-medium mt-1">VR Pathshala</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 font-semibold uppercase">Invoice / Transaction ID</p>
                    <p class="text-lg font-bold text-gray-800">{{ $receipt['tran_id'] }}</p>
                    
                    <p class="text-sm text-gray-500 font-semibold uppercase mt-4">Date of Issue</p>
                    <p class="text-md font-medium text-gray-800">{{ \Carbon\Carbon::parse($receipt['validated_on'])->format('F d, Y h:i A') }}</p>
                </div>
            </div>

            <!-- Customer & Payment Details -->
            <div class="grid grid-cols-2 gap-8 mb-10 pb-8 border-b border-gray-200">
                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase mb-2">Payment Status</p>
                    @if($receipt['status'] === 'VALIDATED')
                        <span class="inline-block bg-green-100 text-green-800 font-bold px-3 py-1 rounded-full text-sm">
                            {{ $receipt['status'] }}
                        </span>
                    @else
                        <span class="inline-block bg-red-100 text-red-800 font-bold px-3 py-1 rounded-full text-sm">
                            {{ $receipt['status'] }}
                        </span>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 font-semibold uppercase mb-2">Payment Method</p>
                    <p class="text-md font-medium text-gray-800">{{ $receipt['card_issuer'] }}</p>
                    <p class="text-sm text-gray-600">Type: {{ $receipt['card_type'] }}</p>
                    @if(!empty($receipt['card_no']))
                        <p class="text-sm text-gray-600">Card No: {{ $receipt['card_no'] }}</p>
                    @endif
                </div>
            </div>

            <!-- Invoice Table -->
            <div class="mb-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-500 text-right uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-5 px-4">
                                <p class="text-gray-800 font-semibold">Subscription Payment</p>
                                <p class="text-sm text-gray-500 mt-1">Transaction Ref: {{ $receipt['tran_id'] }}</p>
                            </td>
                            <td class="py-5 px-4 text-right text-gray-800 font-medium">
                                {{ number_format((float)$receipt['currency_amount'], 2) }} {{ $receipt['currency_type'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Totals -->
            <div class="flex justify-end mb-12">
                <div class="w-1/2 md:w-1/3">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600 font-semibold">Subtotal:</span>
                        <span class="text-gray-800 font-medium">{{ number_format((float)$receipt['currency_amount'], 2) }} {{ $receipt['currency_type'] }}</span>
                    </div>
                    
                    {{-- @if(isset($receipt['discount_amount']) && $receipt['discount_amount'] > 0)
                    <div class="flex justify-between py-2 text-red-600">
                        <span class="font-semibold">Discount:</span>
                        <span class="font-medium">- {{ number_format((float)$receipt['discount_amount'], 2) }} {{ $receipt['currency_type'] }}</span>
                    </div>
                    @endif --}}
                    
                    <div class="flex justify-between py-3 border-t-2 border-gray-200 mt-2">
                        <span class="text-xl font-bold text-gray-800">Total:</span>
                        <span class="text-xl font-bold text-blue-600">
                            {{ number_format((float)$receipt['currency_amount'], 2) }} {{ $receipt['currency_type'] }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center pt-8 border-t border-gray-200">
                <p class="text-gray-600 font-semibold text-lg mb-1">Thank you for your business!</p>
                <p class="text-gray-500 text-sm">If you have any questions concerning this invoice, please contact our support team.</p>
            </div>

        @else
            <div class="flex items-center justify-center h-full min-h-[500px]">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p class="text-red-600 text-xl font-bold">No valid invoice data found.</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
