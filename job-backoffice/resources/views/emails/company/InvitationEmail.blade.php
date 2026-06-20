<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You're Invited!</title>
</head>

<body style="margin:0; padding:0; background-color:#F1F5F9; font-family: Inter, Arial, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color:#F1F5F9; padding: 48px 16px;">
        <tr>
            <td align="center">

                <table role="presentation" width="560" cellpadding="0" cellspacing="0"
                    style="max-width:560px; width:100%; background-color:#FFFFFF; border:1px solid #CBD5E1; border-radius:12px; overflow:hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#004ac6; padding:32px; text-align:center;">
                            <div style="font-size:20px; font-weight:700; color:#FFFFFF; line-height:28px;">
                                You're Invited! 🎉
                            </div>
                            <div
                                style="font-size:14px; color:rgba(255,255,255,0.85); margin-top:8px; line-height:20px;">
                                {{ $companyName }} has invited you to their team
                            </div>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="background-color:#FFFFFF; padding:32px;">

                            <div style="font-size:16px; font-weight:600; color:#0F172A; line-height:24px;">
                                Hi {{ $firstName }},
                            </div>

                            <div
                                style="font-size:14px; font-weight:400; color:#334155; line-height:1.7; margin-top:12px;">
                                {{ $inviterName }} has invited you to join <strong>{{ $companyName }}</strong>
                                as a Hiring Manager. Click the button below to set your password
                                and get started.
                            </div>

                            {{-- CTA Button --}}
                            <table role="presentation" align="center" cellpadding="0" cellspacing="0"
                                style="margin-top:24px;">
                                <tr>
                                    <td style="border-radius:8px; background-color:#004ac6;">
                                        <a href="{{ $invitationUrl }}"
                                            style="display:inline-block; padding:12px 32px; font-size:14px; font-weight:500; color:#FFFFFF; text-decoration:none;">
                                            Accept Invitation &amp; Set Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            {{-- Expiry note --}}
                            <div style="font-size:12px; color:#64748B; margin-top:16px; line-height:16px;">
                                This link expires on {{ $expiresAt->format('F j, Y') }} at
                                {{ $expiresAt->format('g:i A') }}.
                            </div>

                            {{-- Fallback link --}}
                            <div style="font-size:12px; color:#64748B; margin-top:16px; line-height:1.6;">
                                If the button above doesn't work, copy and paste this link into your browser:<br>
                                <a href="{{ $invitationUrl }}"
                                    style="color:#004ac6; word-break:break-all;">{{ $invitationUrl }}</a>
                            </div>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td
                            style="background-color:#F1F5F9; border-top:1px solid #CBD5E1; padding:24px 32px; text-align:center;">
                            <div style="font-size:14px; font-weight:700; color:#004ac6;">
                                Shaghalni
                            </div>
                            <div style="font-size:12px; color:#64748B; margin-top:8px;">
                                <a href="#" style="color:#64748B; text-decoration:none;">Support</a>
                                &nbsp;·&nbsp;
                                <a href="#" style="color:#64748B; text-decoration:none;">Privacy Policy</a>
                                &nbsp;·&nbsp;
                                <a href="#" style="color:#64748B; text-decoration:none;">Terms</a>
                            </div>
                            <div style="font-size:12px; color:#64748B; margin-top:12px;">
                                &copy; {{ date('Y') }} Shaghalni. All rights reserved.
                            </div>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
