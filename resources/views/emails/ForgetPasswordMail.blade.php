<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            letter-spacing: 2px;
            margin: 20px 0;
            display: inline-block;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Authentication Requested</h2>
        <p>Dear {{ $user ?? 'User' }},</p>
        <p>Your One-Time Password (OTP) for verification is:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>Please use this code to complete your verification.</p>
        <p>If you did not request this OTP, please ignore this email.</p>
        
        <div class="footer">
            &copy; {{ date('Y') }} VR Pathshala SaaS. All rights reserved.
        </div>
    </div>
</body>
</html>