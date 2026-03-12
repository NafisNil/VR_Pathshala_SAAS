<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Changed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-top: 5px solid #b33969; /* Theme color */
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333333;
            font-size: 24px;
            margin: 0;
        }
        .content {
            color: #555555;
            line-height: 1.6;
            font-size: 16px;
        }
        .content p {
            margin-bottom: 20px;
        }
        .alert-box {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-left: 4px solid #ffeeba;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #999999;
            font-size: 14px;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }
        .button-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            background-color: #b33969;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        .btn:hover {
            background-color: #902d53;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Password Changed Successfully</h1>
        </div>
        <div class="content">
            <p>Hello{{ isset($user) ? ' ' . $user->name : '' }},</p>
            
            <p>This email is to confirm that the password for your account has recently been changed successfully.</p>
            
            <div class="button-wrapper">
                <a href="{{ config('app.url') }}/user-login" class="btn">Log in to your account</a>
            </div>

            <div class="alert-box">
                <strong>Didn't make this change?</strong><br>
                If you did not authorize this change, please contact our support team immediately to secure your account.
            </div>

            <p>Thanks,<br>The {{ config('app.name', 'VR Pathshala') }} Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name', 'VR Pathshala') }}. All rights reserved.
        </div>
    </div>
</body>
</html>