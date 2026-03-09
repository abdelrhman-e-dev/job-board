<div style="font-family: 'Georgia', 'Times New Roman', serif; line-height: 1.7; color: #1a1a1a; max-width: 620px; margin: 30px auto; background: #ffffff;">

    {{-- Header Banner --}}
    <div style="background: #c0392b; padding: 32px 40px; border-radius: 8px 8px 0 0;">
        <p style="margin: 0 0 6px 0; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.7);">{{ config('app.name') }}</p>
        <h1 style="margin: 0; font-size: 26px; font-weight: 400; color: #ffffff; letter-spacing: -0.5px;">Account Suspension Notice</h1>
    </div>

    {{-- Body --}}
    <div style="padding: 40px; border: 1px solid #e8e8e8; border-top: none; border-radius: 0 0 8px 8px;">

        <p style="font-size: 16px; margin-top: 0;">Dear <strong>{{ $company->name }}</strong>,</p>

        <p style="font-size: 16px;">We are writing to inform you that your account on <strong>{{ config('app.name') }}</strong> has been <strong style="color: #c0392b;">suspended</strong>, effective immediately.</p>

        {{-- Suspension Details Box --}}
        <div style="background: #fdf3f2; border-left: 4px solid #c0392b; border-radius: 4px; padding: 20px 24px; margin: 28px 0;">
            <p style="margin: 0 0 10px 0; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #c0392b;">Suspension Details</p>
            <table style="width: 100%; border-collapse: collapse; font-size: 15px;">
                <tr>
                    <td style="padding: 5px 0; color: #666; width: 140px;">Duration</td>
                    <td style="padding: 5px 0; font-weight: 600;">
                        {{ ceil(now()->diffInDays(\Carbon\Carbon::parse($company->suspended_until))) }} day(s)
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px 0; color: #666;">Suspended Until</td>
                    <td style="padding: 5px 0; font-weight: 600;">{{ \Carbon\Carbon::parse($company->suspended_until)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 0; color: #666; vertical-align: top;">Status</td>
                    <td style="padding: 5px 0;">
                        <span style="display: inline-block; background: #c0392b; color: #fff; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 3px 10px; border-radius: 20px;">Active Suspension</span>
                    </td>
                </tr>
            </table>
        </div>

        {{-- What's affected --}}
        <p style="font-size: 16px; font-weight: 600; margin-bottom: 12px;">What this means for your account:</p>
        <ul style="font-size: 15px; padding-left: 20px; margin: 0 0 24px 0; color: #333;">
            <li style="margin-bottom: 8px;"><strong>All job listings you have published are now blocked</strong> and are no longer visible to candidates.</li>
            <li style="margin-bottom: 8px;">Access to your employer dashboard has been restricted.</li>
            <li style="margin-bottom: 8px;">New job postings cannot be submitted during the suspension period.</li>
            <li style="margin-bottom: 8px;">Your listings will be automatically reviewed for reinstatement once the suspension period ends.</li>
        </ul>

        <p style="font-size: 15px; color: #444;">If you believe this suspension was issued in error, or if you have questions about this decision, please reach out to our support team. We are happy to review your case and provide clarification.</p>

        {{-- CTA --}}
        <div style="text-align: center; margin: 32px 0 8px;">
            <a href="mailto:support@{{ parse_url(config('app.url'), PHP_URL_HOST) }}" style="display: inline-block; background: #1a1a1a; color: #ffffff; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 13px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; padding: 14px 32px; border-radius: 4px;">Contact Support</a>
        </div>

        {{-- Divider --}}
        <hr style="border: none; border-top: 1px solid #ebebeb; margin: 36px 0 24px;">

        <p style="font-size: 13px; color: #999; margin: 0;">Best regards,<br>
        <span style="color: #1a1a1a; font-weight: 600;">The {{ config('app.name') }} Team</span></p>

    </div>
</div>