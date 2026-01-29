# System Admin Dashboard - Primary Panels (Filament Structure)

Since you're using **Filament** for the admin dashboard, here's the recommended panel structure:

---

## 🎯 Primary Panels Overview

```
System Admin Dashboard (Filament)
│
├── 📊 Dashboard (Home)
├── 👥 Users Management
├── 🏢 Companies Management
├── 📋 Jobs Management
├── 📝 Applications Management
├── 💳 Billing & Subscriptions
├── 🎫 Support Tickets
├── ⚙️ Settings & Configuration
├── 📈 Analytics & Reports
└── 🔧 System Tools
```

---

## 1. 📊 Dashboard (Home Panel)

**Purpose**: Overview of entire platform at a glance

### Widgets to Include:

#### Stats Cards (Top Row)
```php
// Filament Stat Widgets
- Total Users (with growth %)
- Total Companies (with growth %)
- Active Jobs (current count)
- Total Applications (this month)
- Monthly Revenue (MRR)
- Platform Uptime (%)
```

#### Charts (Middle Section)
```php
// Filament Chart Widgets
- User Growth Chart (Line chart - last 30 days)
- Revenue Trend (Area chart - last 12 months)
- Applications Over Time (Bar chart - last 7 days)
- Job Postings by Category (Pie chart)
```

#### Recent Activity Feed
```php
// Latest activity widget
- New user registrations (last 10)
- New company signups (last 10)
- Jobs posted today
- Applications submitted today
- Support tickets (urgent only)
```

#### Quick Actions
```php
// Action buttons
- Verify pending companies
- Review flagged content
- Respond to urgent tickets
- View system health
```

#### Alerts & Notifications
```php
// Alert widgets
- System alerts (errors, warnings)
- Pending tasks
- Failed payments
- Expiring subscriptions
```

**Filament Code Structure:**
```php
// app/Filament/Widgets/StatsOverview.php
class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Active Companies', Company::where('status', 'active')->count())
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('MRR', '$' . number_format($mrr, 2))
                ->description('Monthly Recurring Revenue')
                ->color('primary'),
        ];
    }
}
```

---

## 2. 👥 Users Management Panel

**Purpose**: Manage all platform users (Job Seekers & Company Users)

### Filament Resource: `UserResource`

#### List View (Table)
```php
// Columns
- ID
- Avatar (image)
- Name (searchable, sortable)
- Email (searchable)
- User Type (badge: job_seeker, company_admin, hiring_manager)
- Company (if company user)
- Status (badge: active, suspended, inactive)
- Email Verified (boolean icon)
- Registered Date (sortable, date format)
- Last Login (sortable, date format)
```

#### Filters
```php
// Table Filters
- User Type (select: all, job_seeker, company users)
- Status (select: active, suspended, deleted)
- Email Verified (toggle: yes/no)
- Registration Date (date range)
- Last Active (date range)
- Country (select dropdown)
```

#### Table Actions
```php
// Row Actions
- View (view details)
- Edit (edit user)
- Suspend (with reason modal)
- Delete (with confirmation)
- Login As (impersonate user)
- Send Email
```

#### Bulk Actions
```php
// Bulk Actions
- Bulk Suspend
- Bulk Delete
- Bulk Email
- Export Selected
```

#### Form (Create/Edit)
```php
// Form Fields
Tabs::make('User Details')
    ->tabs([
        Tab::make('Basic Info')
            ->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('email')->email()->required(),
                Select::make('type')->options([
                    'job_seeker' => 'Job Seeker',
                    'company_admin' => 'Company Admin',
                    'hiring_manager' => 'Hiring Manager',
                    'platform_admin' => 'Platform Admin',
                ]),
            ]),
        
        Tab::make('Account Status')
            ->schema([
                Select::make('status'),
                Toggle::make('email_verified'),
                DateTimePicker::make('email_verified_at'),
            ]),
        
        Tab::make('Activity')
            ->schema([
                Placeholder::make('created_at'),
                Placeholder::make('last_login_at'),
                Placeholder::make('login_count'),
            ]),
    ])
```

#### Custom Pages
```php
// Additional Pages
- User Activity Log (detailed timeline)
- User Applications (if job seeker)
- User Jobs (if company user)
```

---

## 3. 🏢 Companies Management Panel

**Purpose**: Manage all companies on the platform

### Filament Resource: `CompanyResource`

#### List View (Table)
```php
// Columns
- ID
- Logo (image column)
- Company Name (searchable, sortable)
- Industry
- Size (badge)
- Subscription Plan (badge with color)
- Status (badge: active, suspended)
- Verified (boolean icon with color)
- Active Jobs (count)
- Total Applications (count)
- Member Since (date)
```

#### Filters
```php
// Table Filters
- Status (active, suspended, inactive)
- Subscription Plan (free, basic, pro, enterprise)
- Verified (yes/no)
- Industry (select)
- Company Size (select)
- Has Active Jobs (toggle)
- Registration Date (date range)
```

#### Table Actions
```php
// Row Actions
- View Company Profile
- Edit
- Verify Company (if not verified)
- Suspend/Unsuspend
- Manage Subscription
- View Jobs
- View Applications
- View Team Members
- Delete
```

#### Form (Create/Edit)
```php
// Form Sections
Section::make('Company Information')
    ->schema([
        TextInput::make('name')->required(),
        TextInput::make('website')->url(),
        Select::make('industry'),
        Select::make('size'),
        TextInput::make('founded_year'),
        Textarea::make('description'),
    ]),

Section::make('Branding')
    ->schema([
        FileUpload::make('logo')->image(),
        FileUpload::make('cover_photo')->image(),
        ColorPicker::make('primary_color'),
    ]),

Section::make('Status & Verification')
    ->schema([
        Select::make('status'),
        Toggle::make('verified'),
        DateTimePicker::make('verified_at'),
    ]),

Section::make('Subscription')
    ->schema([
        Select::make('subscription_plan'),
        Select::make('subscription_status'),
        DatePicker::make('subscription_ends_at'),
    ]),
```

#### Relation Managers
```php
// Relation Managers (Tabs on View Page)
- TeamMembersRelationManager (users belonging to company)
- JobsRelationManager (jobs posted by company)
- ApplicationsRelationManager (applications received)
- BillingHistoryRelationManager (payment history)
```

---

## 4. 📋 Jobs Management Panel

**Purpose**: Oversee and moderate all job postings

### Filament Resource: `JobResource`

#### List View (Table)
```php
// Columns
- ID
- Job Title (searchable, sortable)
- Company (with logo, searchable)
- Category
- Type (badge: full-time, part-time, remote)
- Location
- Salary Range (formatted)
- Status (badge: active, draft, closed, suspended)
- Views (count)
- Applications (count with trend icon)
- Posted Date (date, sortable)
- Expires (date)
```

#### Filters
```php
// Table Filters
- Status (active, draft, closed, suspended)
- Job Type (full-time, part-time, contract, remote)
- Category (select from categories)
- Company (select)
- Posted Date (date range)
- Has Applications (toggle)
- Flagged/Reported (toggle)
- Expiring Soon (toggle - next 7 days)
```

#### Table Actions
```php
// Row Actions
- View (public view)
- Edit
- Suspend (with reason)
- Approve (if flagged)
- Delete
- Duplicate
- View Applications
- Contact Poster
```

#### Bulk Actions
```php
// Bulk Actions
- Bulk Suspend
- Bulk Delete
- Bulk Approve
- Export Selected
```

#### Form (Create/Edit)
```php
// Form Wizard
Wizard::make([
    Step::make('Basic Info')
        ->schema([
            TextInput::make('title')->required(),
            Select::make('company_id'),
            Select::make('category_id'),
            Select::make('type'),
            Select::make('level'),
        ]),
    
    Step::make('Description')
        ->schema([
            RichEditor::make('description'),
            RichEditor::make('requirements'),
            RichEditor::make('responsibilities'),
        ]),
    
    Step::make('Location & Salary')
        ->schema([
            TextInput::make('location'),
            Toggle::make('remote_allowed'),
            TextInput::make('salary_min')->numeric(),
            TextInput::make('salary_max')->numeric(),
        ]),
    
    Step::make('Status & Settings')
        ->schema([
            Select::make('status'),
            DatePicker::make('deadline'),
            Toggle::make('featured'),
        ]),
])
```

#### Custom Widgets
```php
// Job Analytics Widget (on view page)
- Views over time chart
- Applications funnel
- Match score distribution
- Top referral sources
```

---

## 5. 📝 Applications Management Panel

**Purpose**: Monitor all applications across platform

### Filament Resource: `ApplicationResource`

#### List View (Table)
```php
// Columns
- ID
- Applicant Name (with avatar, searchable)
- Applied For (job title, searchable)
- Company
- Applied Date (sortable)
- Status (badge with colors)
- Match Score (progress bar or badge)
- Rating (star display)
- Is Read (boolean icon)
```

#### Filters
```php
// Table Filters
- Status (new, reviewing, shortlisted, interview, offer, hired, rejected)
- Job (select dropdown)
- Company (select dropdown)
- Applied Date (date range)
- Match Score (range: >80%, 60-80%, <60%)
- Is Read (toggle)
- Has Rating (toggle)
```

#### Table Actions
```php
// Row Actions
- View Application Details
- View Candidate Profile
- Download Resume
- View Communication Thread
```

#### View Page Sections
```php
// Infolist Sections
Section::make('Applicant Information')
    ->schema([
        TextEntry::make('user.name'),
        TextEntry::make('user.email'),
        TextEntry::make('user.phone'),
        ImageEntry::make('user.avatar'),
    ]),

Section::make('Application Details')
    ->schema([
        TextEntry::make('job.title'),
        TextEntry::make('company.name'),
        TextEntry::make('status')->badge(),
        TextEntry::make('applied_at'),
    ]),

Section::make('Documents')
    ->schema([
        TextEntry::make('resume_url')->url(),
        TextEntry::make('cover_letter')->html(),
    ]),

Section::make('Screening Answers')
    ->schema([
        RepeatableEntry::make('screening_answers'),
    ]),
```

---

## 6. 💳 Billing & Subscriptions Panel

**Purpose**: Manage revenue, subscriptions, payments

### Filament Resource: `SubscriptionResource`

#### List View (Table)
```php
// Columns
- Company Name (searchable)
- Plan (badge with color)
- Status (badge: active, cancelled, past_due)
- Price (formatted currency)
- Billing Cycle (monthly/yearly)
- Current Period End (date)
- Total Paid (lifetime value)
- Next Billing Date
```

#### Filters
```php
// Table Filters
- Plan (free, basic, pro, enterprise)
- Status (active, cancelled, past_due, trialing)
- Billing Cycle (monthly, yearly)
- Expiring Soon (next 7 days)
```

#### Stats Widgets
```php
// Revenue Stats
- MRR (Monthly Recurring Revenue)
- ARR (Annual Recurring Revenue)
- Total Revenue This Month
- New Subscriptions This Month
- Churn Rate
- Average Revenue Per User (ARPU)
```

#### Custom Pages
```php
// Additional Pages
- Revenue Dashboard
- Payment Transactions
- Failed Payments
- Refunds Management
- Coupons & Discounts
```

#### Actions
```php
// Row Actions
- View Subscription Details
- Change Plan
- Cancel Subscription
- Issue Refund
- Apply Coupon
- Extend Trial
- View Invoices
```

---

## 7. 🎫 Support Tickets Panel

**Purpose**: Customer support and help desk

### Filament Resource: `SupportTicketResource`

#### List View (Table)
```php
// Columns
- Ticket ID
- Subject (searchable)
- User (name with avatar)
- Category (badge)
- Priority (badge with colors: urgent=red, high=orange, normal=blue)
- Status (badge: new, open, pending, resolved, closed)
- Assigned To (admin user)
- Created At (date with time ago)
- Last Reply (date)
```

#### Filters
```php
// Table Filters
- Status (new, open, pending, resolved, closed)
- Priority (urgent, high, normal, low)
- Category (technical, billing, account, feature_request, bug, etc.)
- Assigned To (select admin users + unassigned)
- Created Date (date range)
```

#### Table Actions
```php
// Row Actions
- View & Reply
- Change Status
- Change Priority
- Assign To
- Close Ticket
- Mark as Spam
```

#### Form (Create Ticket - Admin side)
```php
// Form
Select::make('user_id')->searchable(),
TextInput::make('subject')->required(),
Select::make('category'),
Select::make('priority'),
RichEditor::make('message'),
FileUpload::make('attachments')->multiple(),
```

#### Custom Ticket View Page
```php
// Ticket Thread View
- Original message
- All replies (chronological)
- Internal notes (admin only)
- Reply form
- Canned responses dropdown
- Attachment uploads
- Change status/priority inline
```

#### Stats Widgets
```php
// Support Metrics
- Open Tickets
- Avg Response Time
- Avg Resolution Time
- Customer Satisfaction Score
- Tickets Closed Today
```

---

## 8. ⚙️ Settings & Configuration Panel

**Purpose**: Platform-wide settings and configuration

### Navigation Structure:
```php
// Settings Menu Items
Settings
├── General Settings
├── Email Settings
├── Payment Settings
├── Job Categories
├── Skills Management
├── Locations
├── Subscription Plans
├── System Settings
└── Admin Users
```

### General Settings Page
```php
// Form
TextInput::make('site_name'),
TextInput::make('site_url'),
Textarea::make('site_description'),
FileUpload::make('site_logo'),
FileUpload::make('favicon'),
TextInput::make('contact_email'),
TextInput::make('support_email'),
```

### Email Settings Page
```php
// Form
Select::make('mail_driver')->options(['smtp', 'sendgrid', 'ses']),
TextInput::make('mail_host'),
TextInput::make('mail_port'),
TextInput::make('mail_username'),
TextInput::make('mail_password')->password(),
TextInput::make('mail_from_address'),
TextInput::make('mail_from_name'),
```

### Payment Settings Page
```php
// Form
Toggle::make('payments_enabled'),
Select::make('payment_gateway')->options(['stripe']),
TextInput::make('stripe_public_key'),
TextInput::make('stripe_secret_key')->password(),
TextInput::make('stripe_webhook_secret')->password(),
Select::make('currency')->options(['USD', 'EUR', 'GBP']),
Toggle::make('allow_trial'),
TextInput::make('trial_days')->numeric(),
```

### Job Categories Resource
```php
// CRUD for categories
- Name
- Slug
- Parent Category (for hierarchy)
- Icon
- Order
- Active/Inactive
```

### Skills Resource
```php
// CRUD for skills
- Skill Name
- Slug
- Category (programming, soft_skill, tool, etc.)
- Trending (toggle)
```

### Subscription Plans Resource
```php
// CRUD for plans
- Plan Name
- Price
- Billing Cycle (monthly/yearly)
- Features (JSON or repeater)
- Job Posting Limit
- Team Member Limit
- Active/Inactive
- Trial Eligible
```

### Admin Users Resource
```php
// Manage admin users
- Name
- Email
- Role (super_admin, moderator, support, analyst)
- Permissions
- Active/Inactive
- Last Login
```

---

## 9. 📈 Analytics & Reports Panel

**Purpose**: Detailed analytics and reporting

### Custom Pages:

#### Platform Analytics Page
```php
// Widgets
- User Growth Chart (line chart)
- Revenue Trend (area chart)
- Job Postings Over Time (bar chart)
- Applications Funnel
- Geographic Distribution (map if possible)
- Top Companies (table)
- Top Job Categories (pie chart)
```

#### User Analytics Page
```php
// Metrics
- Total Users
- Active Users (DAU, WAU, MAU)
- New Registrations Trend
- User Retention Rate
- User Engagement Score
- Most Active Users
- User Demographics
```

#### Revenue Analytics Page
```php
// Metrics
- MRR Trend
- ARR
- Revenue by Plan
- New vs Churned Revenue
- LTV (Lifetime Value)
- Churn Analysis
- Payment Success Rate
```

#### Job Analytics Page
```php
// Metrics
- Jobs Posted Trend
- Jobs by Category
- Average Time to Fill
- Application Rate
- Most Popular Jobs
- Jobs Performance
```

---

## 10. 🔧 System Tools Panel

**Purpose**: Technical tools and utilities

### Navigation Items:

#### Activity Logs
```php
// Filament Activity Log Resource
- View all system actions
- Filter by user, action type, date
- Search logs
- Export logs
```

#### Database Backup
```php
// Custom Page
- Trigger manual backup
- Download backups
- Restore from backup
- Scheduled backups configuration
```

#### Cache Management
```php
// Custom Page
- Clear application cache
- Clear view cache
- Clear route cache
- Clear config cache
- Optimize application
```

#### Queue Management
```php
// Monitor queues
- Jobs in queue
- Failed jobs
- Retry failed jobs
- Clear queue
```

#### System Health
```php
// Health Check Dashboard
- Server status
- Database connection
- Cache connection
- Email service
- Payment gateway
- Storage space
- Memory usage
```

---

## 📱 Filament Navigation Structure

```php
// AdminPanelProvider.php

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->login()
        ->colors([
            'primary' => Color::Blue,
        ])
        ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
        ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
        ->pages([
            Pages\Dashboard::class,
        ])
        ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
        ->widgets([
            Widgets\AccountWidget::class,
            Widgets\FilamentInfoWidget::class,
        ])
        ->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ])
        ->authMiddleware([
            Authenticate::class,
        ])
        ->navigationGroups([
            'User Management',
            'Content Management',
            'Financial',
            'Support',
            'Configuration',
            'System',
        ]);
}
```

---

## 🎨 Recommended Filament Plugins

```bash
# For better admin experience
composer require filament/spatie-laravel-settings-plugin
composer require filament/spatie-laravel-media-library-plugin
composer require filament/spatie-laravel-tags-plugin
composer require bezhansalleh/filament-shield  # Permissions
composer require pxlrbt/filament-excel  # Export
composer require alperenersoy/filament-export  # Export
composer require ryangjchandler/filament-navigation  # Navigation builder
```

---

This structure gives you a complete, organized Filament admin panel for managing your entire Job Board platform!