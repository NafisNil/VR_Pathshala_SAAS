<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0056b3;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .content p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .receipt-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .receipt-details th, .receipt-details td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eeeeee;
        }
        .receipt-details th {
            color: #666;
            font-weight: bold;
            width: 40%;
        }
        .total-row th, .total-row td {
            font-weight: bold;
            font-size: 18px;
            color: #0056b3;
            border-bottom: none;
            padding-top: 20px;
        }
        .footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777;
        }
        .btn {
            display: inline-block;
            background-color: #0056b3;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Receipt</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>Thank you for your payment to VR Pathshala! We have successfully received your transaction. Below are the details of your payment:</p>
            
            <table class="receipt-details">
                <tr>
                    <th>Transaction ID:</th>
                    <td>{{ $paymentDetails['transaction_id'] }}</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>{{ $paymentDetails['date'] }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $paymentDetails['plan_name'] }}</td>
                </tr>
                <tr class="total-row">
                    <th>Amount Paid:</th>
                    <td>{{ number_format((float)$paymentDetails['amount'], 2) }} {{ $paymentDetails['currency'] }}</td>
                </tr>
            </table>

            <p>Your subscription is now active. You can log in to your account to start exploring our features.</p>

            <div style="text-align: center;">
                <a href="{{ url('/user-dashboard') }}" class="btn">Go to Dashboard</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} VR Pathshala. All rights reserved.</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>