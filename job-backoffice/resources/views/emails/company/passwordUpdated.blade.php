<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Updated</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #F1F5F9;
            padding: 40px 16px;
        }

        .container {
            max-width: 560px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #CBD5E1;
            overflow: hidden;
        }

        /* Header */
        .header {
            background-color: #004ac6;
            padding: 32px;
            text-align: center;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            line-height: 48px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin: 0 auto 16px auto;
            font-size: 22px;
        }

        .header h1 {
            color: #FFFFFF;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Body */
        .body {
            padding: 32px;
        }

        .greeting {
            font-size: 16px;
            font-weight: 600;
            color: #0F172A;
            margin-bottom: 12px;
        }

        .message {
            font-size: 14px;
            color: #334155;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        /* Success Badge */
        .success-badge {
            background-color: #dcfce7;
            border: 1px solid #16A34A;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .success-badge-inner {
            display: table;
            width: 100%;
        }

        .success-badge-icon-cell {
            display: table-cell;
            width: 36px;
            vertical-align: middle;
        }

        .success-badge-icon {
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background-color: #16A34A;
            border-radius: 50%;
            color: #FFFFFF !important;
            font-size: 18px;
            font-weight: 700;
        }

        .success-badge-content {
            display: table-cell;
            vertical-align: middle;
            padding-left: 12px;
        }

        .success-badge-text {
            font-size: 14px;
            font-weight: 600;
            color: #16A34A;
        }

        .success-badge-subtext {
            font-size: 12px;
            color: #334155;
            margin-top: 2px;
        }

        /* Details */
        .details-box {
            background-color: #F1F5F9;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .details-title {
            font-size: 12px;
            font-weight: 600;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
        }

        .details-row {
            display: table;
            width: 100%;
            padding: 6px 0;
            border-bottom: 1px solid #CBD5E1;
        }

        .details-row:last-child {
            border-bottom: none;
        }

        .details-label {
            display: table-cell;
            font-size: 13px;
            color: #64748B;
            width: 50%;
        }

        .details-value {
            display: table-cell;
            font-size: 13px;
            font-weight: 500;
            color: #0F172A;
            text-align: right;
        }

        /* Warning Box */
        .warning-box {
            background-color: #fef9c3;
            border: 1px solid #D97706;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .warning-box-title {
            font-size: 14px;
            font-weight: 600;
            color: #D97706;
            margin-bottom: 6px;
        }

        .warning-box-message {
            font-size: 13px;
            color: #334155;
            line-height: 1.6;
        }

        /* Button */
        .button-wrapper {
            text-align: center;
            margin-bottom: 24px;
        }

        .button {
            display: inline-block;
            background-color: #004ac6;
            color: #FFFFFF !important;
            font-size: 14px;
            font-weight: 500;
            padding: 12px 32px;
            border-radius: 8px;
            text-decoration: none;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #CBD5E1;
            margin: 24px 0;
        }

        /* Footer */
        .footer {
            background-color: #F1F5F9;
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #CBD5E1;
        }

        .footer-app-name {
            font-size: 14px;
            font-weight: 700;
            color: #004ac6;
            margin-bottom: 8px;
        }

        .footer-text {
            font-size: 12px;
            color: #64748B;
            line-height: 1.6;
        }

        .footer-links {
            margin-top: 12px;
        }

        .footer-link {
            font-size: 12px;
            color: #004ac6;
            text-decoration: none;
            margin: 0 8px;
        }
    </style>
</head>

<body>
    <div class="container">

        {{-- Header --}}
        <div class="header">
            {{-- Unicode lock icon - works in all email clients --}}
            <div class="header-icon">🔒</div>
            <h1>Password Updated</h1>
            <p>Your account security has been changed</p>
        </div>

        {{-- Body --}}
        <div class="body">

            {{-- Greeting --}}
            <p class="greeting">Hi {{ $fullName }},</p>

            {{-- Message --}}
            <p class="message">
                We are writing to confirm that your password
                for your {{ $appName }} account has been
                successfully updated.
            </p>

            {{-- Success Badge --}}
            <div class="success-badge">
                <div class="success-badge-inner">
                    {{-- Use table-cell for reliable vertical centering --}}
                    <div class="success-badge-icon-cell">
                        <div class="success-badge-icon">✓</div>
                    </div>
                    <div class="success-badge-content">
                        <div class="success-badge-text">
                            Password changed successfully
                        </div>
                        <div class="success-badge-subtext">
                            Your account is now secured with
                            your new password
                        </div>
                    </div>
                </div>
            </div>

            {{-- Change Details --}}
            <div class="details-box">
                <div class="details-title">Change Details</div>

                <div class="details-row">
                    <span class="details-label">Account</span>
                    <span class="details-value">{{ $email }}</span>
                </div>

                <div class="details-row">
                    <span class="details-label">Date & Time</span>
                    <span class="details-value">
                        {{ now()->format('M d, Y \a\t h:i A') }}
                    </span>
                </div>

                <div class="details-row">
                    <span class="details-label">Status</span>
                    <span class="details-value"
                        style="color: #16A34A;">
                        ✓ Confirmed
                    </span>
                </div>
            </div>

            {{-- Warning Box --}}
            <div class="warning-box">
                <div class="warning-box-title">
                    ⚠ Did not make this change?
                </div>
                <p class="warning-box-message">
                    If you did not request this password change,
                    your account may be compromised. Please contact
                    our support team immediately and secure
                    your account.
                </p>
            </div>

            {{-- Contact Support Button --}}
            <div class="button-wrapper">
                <a href="mailto:{{ config('mail.from.address') }}"
                    class="button">
                    Contact Support
                </a>
            </div>

            <hr class="divider">

            {{-- Security Tips --}}
            <p class="message"
                style="font-size: 13px; color: #64748B;">
                <strong style="color: #334155;">
                    Security Tips:
                </strong><br>
                • Never share your password with anyone<br>
                • Use a unique password for each account<br>
                • Enable two-factor authentication for
                  extra security
            </p>

        </div>

        {{-- Footer --}}
        <div class="footer">
            <div class="footer-app-name">{{ $appName }}</div>
            <p class="footer-text">
                This is an automated security notification.<br>
                Please do not reply to this email.
            </p>
            <div class="footer-links">
                <a href="#" class="footer-link">Support</a>
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Terms of Service</a>
            </div>
            <p class="footer-text" style="margin-top: 12px;">
                © {{ date('Y') }} {{ $appName }}.
                All rights reserved.
            </p>
        </div>

    </div>
</body>
</html>