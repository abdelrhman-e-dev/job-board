<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #F1F5F9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 560px;
            margin: 40px auto;
            background-color: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #CBD5E1;
            overflow: hidden;
        }
        .header {
            background-color: #2563EB;
            padding: 32px;
            text-align: center;
        }
        .header h1 {
            color: #FFFFFF;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }
        .body {
            padding: 32px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 600;
            color: #0F172A;
            margin-bottom: 16px;
        }
        .message {
            font-size: 14px;
            color: #334155;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .button-wrapper {
            text-align: center;
            margin-bottom: 24px;
        }
        .button {
            display: inline-block;
            background-color: #2563EB;
            color: #FFFFFF !important;
            font-size: 14px;
            font-weight: 500;
            padding: 12px 32px;
            border-radius: 8px;
            text-decoration: none;
        }
        .expiry {
            font-size: 12px;
            color: #64748B;
            text-align: center;
            margin-bottom: 24px;
        }
        .divider {
            border: none;
            border-top: 1px solid #CBD5E1;
            margin: 24px 0;
        }
        .footer {
            font-size: 12px;
            color: #64748B;
            text-align: center;
            padding: 0 32px 32px;
        }
    </style>
</head>
<body>
    <div class="container">

        {{-- Header --}}
        <div class="header">
            <h1>{{ $appName }}</h1>
        </div>

        {{-- Body --}}
        <div class="body">

            {{-- Greeting --}}
            <p class="greeting">Hi {{ $firstName }},</p>

            {{-- Message --}}
            <p class="message">
                You are receiving this email because we received a password reset request for your company account. 
                If you did not request a password reset, no further action is required.
            </p>

            {{-- Reset Button --}}
            <div class="button-wrapper">
                <a href="{{ $resetUrl }}" class="button">
                    Reset Password
                </a>
            </div>

            {{-- Expiry Notice --}}
            <p class="expiry">
                This password reset link will expire in {{ $expiryMinutes }} minutes.
            </p>

            <hr class="divider">

            {{-- Fallback Link --}}
            <p class="message">
                If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
            </p>
            <p style="font-size: 12px; color: #2563EB; word-break: break-all;">
                {{ $resetUrl }}
            </p>

        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>
                This is an automated email, please do not reply.
            </p>
            <p>© {{ date('Y') }} {{ $appName }}. All rights reserved.</p>
        </div>

    </div>
</body>
</html>
