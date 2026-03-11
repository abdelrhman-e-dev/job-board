<div style="font-family: 'Georgia', 'Times New Roman', serif; line-height: 1.7; color: #1a1a1a; max-width: 620px; margin: 30px auto; background: #ffffff;">

    {{-- Header Banner --}}
    <div style="background: #27ae60; padding: 32px 40px; border-radius: 8px 8px 0 0;">
        <p style="margin: 0 0 6px 0; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: rgba(255,255,255,0.7);">{{ config('app.name') }}</p>
        <h1 style="margin: 0; font-size: 26px; font-weight: 400; color: #ffffff; letter-spacing: -0.5px;">Account Reinstated</h1>
    </div>

    {{-- Body --}}
    <div style="padding: 40px; border: 1px solid #e8e8e8; border-top: none; border-radius: 0 0 8px 8px;">

        <p style="font-size: 16px; margin-top: 0;">Dear <strong>{{ $company->name }}</strong>,</p>

        <p style="font-size: 16px;">We are pleased to inform you that your account on <strong>{{ config('app.name') }}</strong> has been <strong style="color: #27ae60;">reinstated</strong>, effective immediately. Your suspension period has now ended.</p>

        {{-- Reinstatement Details Box --}}
        <div style="background: #f2fdf5; border-left: 4px solid #27ae60; border-radius: 4px; padding: 20px 24px; margin: 28px 0;">
            <p style="margin: 0 0 10px 0; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #27ae60;">Reinstatement Details</p>
            <table style="width: 100%; border-collapse: collapse; font-size: 15px;">
                <tr>
                    <td style="padding: 5px 0; color: #666; width: 140px;">Reinstated On</td>
                    <td style="padding: 5px 0; font-weight: 600;">{{ now()->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 0; color: #666; vertical-align: top;">Status</td>
                    <td style="padding: 5px 0;">
                        <span style="display: inline-block; background: #27ae60; color: #fff; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 3px 10px; border-radius: 20px;">Active</span>
                    </td>
                </tr>
            </table>
        </div>

        {{-- What's restored --}}
        <p style="font-size: 16px; font-weight: 600; margin-bottom: 12px;">Your account has been fully restored:</p>
        <ul style="font-size: 15px; padding-left: 20px; margin: 0 0 24px 0; color: #333;">
            <li style="margin-bottom: 8px;"><strong>All your job listings have been unblocked</strong> and are now visible to candidates again.</li>
            <li style="margin-bottom: 8px;">Full access to your employer dashboard has been restored.</li>
            <li style="margin-bottom: 8px;">You can now publish and manage new job postings.</li>
            <li style="margin-bottom: 8px;">All account features are available to you as normal.</li>
        </ul>

        <p style="font-size: 15px; color: #444;">We encourage you to review our <a href="{{ config('app.url') }}/terms" style="color: #27ae60; text-decoration: underline;">Terms of Service</a> to ensure continued compliance and avoid future disruptions to your account.</p>

        <p style="font-size: 15px; color: #444;">If you have any questions or need assistance getting started again, our support team is always here to help.</p>

        {{-- CTA --}}
        <div style="text-align: center; margin: 32px 0 8px;">
            <a href="{{ config('app.url') }}/dashboard" style="display: inline-block; background: #1a1a1a; color: #ffffff; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 13px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; padding: 14px 32px; border-radius: 4px;">Go to Dashboard</a>
        </div>

        {{-- Divider --}}
        <hr style="border: none; border-top: 1px solid #ebebeb; margin: 36px 0 24px;">

        <p style="font-size: 13px; color: #999; margin: 0;">Best regards,<br>
        <span style="color: #1a1a1a; font-weight: 600;">The {{ config('app.name') }} Team</span></p>

    </div>
</div>