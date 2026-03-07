
<h2 style="margin-bottom:10px;">Company Account Verified Successfully</h2>

<p>Hello <strong>{{ $company->name }}</strong>,</p>

<p>
    We are pleased to inform you that your company account on <strong>{{ config('app.name') }}</strong> has been successfully verified.
</p>

<p>
    You now have full access to our platform's business features. You can log in to your dashboard to start posting jobs and managing your company profile.
</p>

<div style="margin-top:25px;">
    <a href="{{ config('app.url') }}/login" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Go to Dashboard</a>
</div>

<p style="margin-top:30px;">
    Best regards,<br>
    <strong>The {{ config('app.name') }} Team</strong>
</p>

