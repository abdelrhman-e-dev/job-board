<div style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 10px;">
    <h1 style="color: #e3342f; font-size: 24px; border-bottom: 2px solid #e3342f; padding-bottom: 10px; margin-top: 0;">Account Suspension Notice</h1>
    <p style="font-size: 16px;">Hello <strong>{{ $company->name }}</strong>,</p>
    <p style="font-size: 16px;">We are writing to inform you that your company account has been suspended for <strong>{{ $company->suspended_until->diffInDays(now()) }}</strong> days, effective immediately.</p>
    <p style="font-size: 16px;">During this period, access to your dashboard and active listings will be restricted. If you believe this suspension was made in error or have questions regarding this decision, please contact our support team for further clarification.</p>
    <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">
    <p style="font-size: 14px; color: #777;">Best regards,<br><span style="color: #333; font-weight: bold;">{{ config('app.name') }} Team</span></p>
</div>
