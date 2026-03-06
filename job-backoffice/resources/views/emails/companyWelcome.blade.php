<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h1 style="color: #333;">Welcome to {{ $appName }}! 👋</h1>

    <p style="color: #666; font-size: 16px; line-height: 1.6;">
        Hi {{ $user->name }},
    </p>

    <p style="color: #666; font-size: 16px; line-height: 1.6;">
        Thank you for creating an account. We're excited to have you on board!
    </p>

    <p style="color: #666; font-size: 16px; line-height: 1.6;">
        Here are some things you can do to get started:
    </p>

    <ul style="color: #666; font-size: 16px; line-height: 1.8;">
        <li>Complete your profile</li>
        <li>Explore our features</li>
        <li>Connect with other users</li>
    </ul>

    <div style="margin-top: 30px; padding: 20px; background-color: #f5f5f5; border-radius: 5px;">
        <a href="{{ config('app.url') }}/dashboard"
           style="display: inline-block; padding: 12px 30px; background-color: #3b82f6; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Go to Dashboard
        </a>
    </div>

    <p style="color: #999; font-size: 14px; margin-top: 30px;">
        If you have any questions, feel free to <a href="mailto:support@example.com" style="color: #3b82f6;">contact our support team</a>.
    </p>

    <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">

    <p style="color: #999; font-size: 12px;">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </p>
</div>