# Job Board Platform — Design System
> This file is the single source of truth for all UI design decisions.
> Use it as a reference in Google Stitch for every page and component.
> Last updated: May 2026 — Version 1.2

---

## 1. Brand Identity

### Platform Personality
- **Feeling:** Professional and trustworthy
- **Inspired by:** LinkedIn, Indeed
- **Target Users:** Companies posting jobs, hiring managers, recruiters
- **Design Philosophy:** Clean, structured, and easy to scan — every element should serve a purpose

---

## 2. Color Palette

### Primary Colors
| Name              | Hex       | Tailwind Class       | Usage |
|-------------------|-----------|----------------------|-------|
| Primary Blue      | `#004ac6` | `primary`            | Buttons, links, active states, logo |
| Primary Container | `#2563eb` | `primary-container`  | Button hover, sidebar active item |
| Primary Dark      | `#1D4ED8` | `primary-dark`       | Button hover, emphasis, focus rings |
| Primary Light     | `#DBEAFE` | `primary-light`      | Backgrounds, highlights, badges, tags |
| Primary Fixed     | `#dbe1ff` | `primary-fixed`      | Fixed background surfaces |
| Primary Fixed Dim | `#b4c5ff` | `primary-fixed-dim`  | Dimmed fixed surfaces |

### Neutral Colors
| Name        | Hex       | Tailwind Class  | Usage |
|-------------|-----------|-----------------|-------|
| Neutral 900 | `#0F172A` | `neutral-900`   | Main headings, sidebar background |
| Neutral 700 | `#334155` | `neutral-700`   | Body text, labels, secondary headings |
| Neutral 500 | `#64748B` | `neutral-500`   | Placeholder text, hints, captions |
| Neutral 300 | `#CBD5E1` | `neutral-300`   | Borders, dividers, input borders |
| Neutral 100 | `#F1F5F9` | `neutral-100`   | Page background, section backgrounds |
| White       | `#FFFFFF` | `white`         | Cards, inputs, modals |

### Status Colors
| Name           | Hex       | Tailwind Class    | Usage |
|----------------|-----------|-------------------|-------|
| Success Green  | `#16A34A` | `success`         | Approved, active, success messages, hired |
| Success Light  | `#dcfce7` | `success-light`   | Success badge background |
| Warning Yellow | `#D97706` | `warning`         | Pending, warnings, review status |
| Warning Light  | `#fef9c3` | `warning-light`   | Warning badge background |
| Danger Red     | `#dc2626` | `danger`          | Rejected, errors, suspended, delete |
| Danger Dark    | `#b91c1c` | `danger-dark`     | Danger hover state |
| Danger Light   | `#fee2e2` | `danger-light`    | Error badge background |
| Info Blue      | `#0284C7` | `info`            | Info messages, notifications, tips |
| Info Light     | `#dbeafe` | `info-light`      | Info badge background |

### Status Badge Colors
| Status      | Background            | Text      | Tailwind BG Class      |
|-------------|-----------------------|-----------|------------------------|
| Approved    | `#DCFCE7`             | `#16A34A` | `badge-approved-bg`    |
| Pending     | `#FEF9C3`             | `#D97706` | `badge-pending-bg`     |
| Rejected    | `#FEE2E2`             | `#dc2626` | `badge-rejected-bg`    |
| Suspended   | `#F1F5F9`             | `#64748B` | `neutral-100`          |
| Active      | `#DBEAFE`             | `#004ac6` | `primary-light`        |
| Closed      | `#F1F5F9`             | `#64748B` | `neutral-100`          |
| Hired       | `#DCFCE7`             | `#16A34A` | `badge-approved-bg`    |
| Interview   | `#dbe1ff`             | `#004ac6` | `primary-fixed`        |
| Shortlisted | `#dae2fd`             | `#565e74` | `secondary-container`  |

### Surface Colors
| Name                      | Hex       | Tailwind Class               | Usage |
|---------------------------|-----------|------------------------------|-------|
| Background                | `#faf8ff` | `background`                 | App background |
| Surface                   | `#faf8ff` | `surface`                    | Default surface |
| Surface Container         | `#ededf9` | `surface-container`          | Card backgrounds |
| Surface Container Low     | `#f3f3fe` | `surface-container-low`      | Subtle backgrounds |
| Surface Container High    | `#e7e7f3` | `surface-container-high`     | Elevated surfaces |
| Surface Container Highest | `#e1e2ed` | `surface-container-highest`  | Highest elevation |
| On Surface                | `#191b23` | `on-surface`                 | Text on surface |
| On Surface Variant        | `#434655` | `on-surface-variant`         | Secondary text |
| Outline                   | `#737686` | `outline`                    | Borders, dividers |
| Outline Variant           | `#c3c6d7` | `outline-variant`            | Subtle borders |

---

## 3. Typography

### Font Family
- **Primary Font:** Inter (Google Fonts)
- **Import:** `https://fonts.google.com/specimen/Inter`
- **Fallback:** `sans-serif`
- **Icons:** Material Symbols Outlined

### Type Scale
| Role             | Size  | Weight | Line Height | Color       | Tailwind Class     | Usage |
|------------------|-------|--------|-------------|-------------|--------------------|-------|
| Page Title       | 24px  | 700    | 32px        | `#0F172A`   | `text-page-title`  | Main page headings |
| Section Heading  | 20px  | 600    | 28px        | `#0F172A`   | `text-section-heading` | Card titles |
| Sub Heading      | 16px  | 600    | 24px        | `#0F172A`   | `text-sub-heading` | Form sections |
| Body Text        | 14px  | 400    | 20px        | `#334155`   | `text-body-text`   | General content |
| Small Text       | 12px  | 400    | 16px        | `#64748B`   | `text-small-text`  | Captions, hints |
| Label Text       | 14px  | 500    | 20px        | `#334155`   | `text-label-text`  | Form labels |
| Button Text      | 14px  | 500    | 20px        | depends     | `text-button-text` | All buttons |
| Link Text        | 14px  | 500    | 20px        | `#004ac6`   | —                  | Clickable links |
| Placeholder Text | 14px  | 400    | 20px        | `#64748B`   | —                  | Input placeholders |
| Error Text       | 12px  | 400    | 16px        | `#dc2626`   | —                  | Validation errors |

---

## 4. Spacing System

Custom spacing tokens (use as Tailwind spacing classes):

| Token          | Value  | Tailwind Class  | Usage |
|----------------|--------|-----------------|-------|
| xs             | 4px    | `p-xs` / `m-xs` | Tight gaps between inline elements |
| sm             | 8px    | `p-sm` / `m-sm` | Small padding, icon gaps |
| md             | 16px   | `p-md` / `m-md` | Default padding, form gaps |
| lg             | 24px   | `p-lg` / `m-lg` | Section padding, card padding |
| xl             | 32px   | `p-xl` / `m-xl` | Page sections, large gaps |
| 2xl            | 48px   | `p-2xl`         | Page top/bottom padding |
| 3xl            | 64px   | `p-3xl`         | Hero sections |
| sidebar-width  | 240px  | `w-sidebar-width`| Sidebar width |
| header-height  | 64px   | `h-header-height`| Header height |

---

## 5. Border & Shadow System

### Border Radius
| Token    | Value  | Tailwind Class  | Usage |
|----------|--------|-----------------|-------|
| sm       | 4px    | `rounded-sm`    | Badges, tags, small elements |
| md       | 8px    | `rounded-md`    | Inputs, buttons |
| lg       | 12px   | `rounded-lg`    | Cards, modals, dropdowns |
| xl       | 16px   | `rounded-xl`    | Large cards |
| full     | 9999px | `rounded-full`  | Avatars, pills |

### Shadows
| Token    | Value                                 | Tailwind Class  | Usage |
|----------|---------------------------------------|-----------------|-------|
| sm       | `0 1px 2px rgba(0,0,0,0.05)`         | `shadow-sm`     | Subtle lift |
| md       | `0 1px 3px rgba(0,0,0,0.1)`          | `shadow`        | Cards, dropdowns |
| lg       | `0 4px 6px rgba(0,0,0,0.07)`         | `shadow-lg`     | Modals, popovers |
| xl       | `0 10px 15px rgba(0,0,0,0.1)`        | `shadow-xl`     | Floating elements |

### Borders
| Token    | Value                     | Usage |
|----------|---------------------------|-------|
| Default  | `1px solid #CBD5E1`       | Cards, inputs, dividers |
| Focus    | `2px solid #004ac6`       | Input focus state |
| Error    | `1px solid #dc2626`       | Input error state |

---

## 6. Component Design Specs

### Buttons

#### Primary Button
```
Background : #004ac6
Text       : #FFFFFF
Hover BG   : #1D4ED8
Border     : none
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
Disabled   : opacity 50%
```

#### Secondary Button
```
Background : #FFFFFF
Text       : #334155
Border     : 1px solid #CBD5E1
Hover BG   : #F1F5F9
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
```

#### Danger Button
```
Background : #dc2626
Text       : #FFFFFF
Hover BG   : #b91c1c
Border     : none
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
```

#### Ghost Button
```
Background : transparent
Text       : #004ac6
Hover BG   : #DBEAFE
Border     : none
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
```

### Loading Button State
```
Add wire:loading.attr="disabled"
Show spinner or "Processing..." text
Opacity    : 50% when disabled
Cursor     : not-allowed when disabled
```

---

### Form Inputs

#### Text Input (default)
```
Background    : #FFFFFF
Border        : 1px solid #CBD5E1
Border Radius : 8px
Padding       : 10px 14px
Font size     : 14px
Text color    : #0F172A
Placeholder   : #64748B
```

#### Text Input (focus)
```
Border        : 2px solid #004ac6
Shadow        : 0 0 0 3px #DBEAFE
Outline       : none
```

#### Text Input (error)
```
Border        : 1px solid #dc2626
Shadow        : 0 0 0 3px #fee2e2
```

#### Form Label
```
Font size     : 14px
Font weight   : 500
Color         : #334155
Margin bottom : 6px
Display       : block
```

#### Error Message
```
Font size     : 12px
Color         : #dc2626
Margin top    : 4px
Display       : block
```

#### Select Input
```
Same as text input
Add chevron icon on right
```

---

### Cards
```
Background    : #FFFFFF
Border        : 1px solid #CBD5E1
Border Radius : 12px
Padding       : 24px
Shadow        : 0 1px 3px rgba(0,0,0,0.1)
```

### Stat Cards (Dashboard)
```
Background    : #FFFFFF
Border        : 1px solid #CBD5E1
Border Radius : 12px
Padding       : 24px
Shadow        : 0 1px 3px rgba(0,0,0,0.1)
Contains:
  - Icon (top left, colored bg circle)
  - Label (12px, neutral-500)
  - Number (24px, 700, neutral-900)
  - Trend indicator (12px)
    ↑ green for positive
    ↓ red for negative
    → gray for no change
```

### Badges / Status Pills
```
Border Radius : 9999px (full)
Padding       : 2px 10px
Font size     : 12px
Font weight   : 500
(use status badge colors from section 2)
```

### Avatar (Initials)
```
Shape         : circle (rounded-full)
Size          : 32px (header) / 40px (sidebar)
Background    : generated from name (see color map below)
Text          : white, 14px, 600
Text content  : first letter of first + last name

Color map by first letter:
A-D → #004ac6 (primary)
E-H → #16A34A (success)
I-L → #D97706 (warning)
M-P → #7C3AED (purple)
Q-T → #0284C7 (info)
U-Z → #DC2626 (danger)
```

### Toast Notifications
```
Position      : fixed top-4 right-4
Max width     : 384px (max-w-sm)
Border Radius : 8px
Padding       : 12px 16px
Shadow        : shadow-md
Auto dismiss  : 4 seconds
Contains      : icon + message + close button

Success toast : bg success-light, border success, text success
Error toast   : bg danger-light, border danger, text danger
Warning toast : bg warning-light, border warning, text warning
Info toast    : bg info-light, border info, text info
```

---

## 7. Layout Structure

### Dashboard Layout
```
┌──────────────────────────────────────────────────────┐
│  SIDEBAR (240px fixed)  │  MAIN CONTENT AREA         │
│  bg: neutral-900        │                            │
│  ───────────────────    │  HEADER (64px)             │
│  Logo area (64px)       │  bg: white                 │
│  border-b neutral-700   │  border-b neutral-300      │
│  ───────────────────    │  ☰ Page Title    🔔 Avatar │
│                         │  ──────────────────────────│
│  Navigation items       │                            │
│  (each 40px height)     │  PAGE CONTENT              │
│  ───────────────────    │  bg: neutral-100           │
│  Dashboard              │  padding: 24px             │
│  Jobs                   │  min-h: calc(100vh - 64px) │
│  Applications           │                            │
│  Notifications          │  @yield('content')         │
│  ───────────────────    │                            │
│  Team (owner only)      │                            │
│  Profile (owner only)   │                            │
│                         │                            │
│  ───────────────────    │                            │
│  User info (bottom)     │                            │
│  Avatar + Name + Role   │                            │
│  Logout button          │                            │
└─────────────────────────┴────────────────────────────┘
```

### Sidebar Specs
```
Width              : 240px (w-sidebar-width)
Background         : #0F172A (neutral-900)
Position           : fixed, full height
Z-index            : 40

Logo area:
  Height           : 64px (h-header-height)
  Border bottom    : 1px solid #334155
  Contains         : app icon + app name
  Text color       : #FFFFFF

Navigation item (default):
  Height           : 40px
  Padding          : 8px 16px
  Border radius    : 8px
  Text color       : #CBD5E1 (neutral-300)
  Icon color       : #CBD5E1
  Font             : 14px / 500
  Hover BG         : #334155 (neutral-700)

Navigation item (active):
  Background       : #004ac6 (primary)
  Text color       : #FFFFFF
  Icon color       : #FFFFFF

Navigation section divider:
  Border top       : 1px solid #334155
  Margin           : 8px 0

User info area (bottom):
  Border top       : 1px solid #334155
  Padding          : 16px
  Avatar size      : 40px
  Name             : 14px / 500 / white
  Role badge       : 12px / primary-light bg / primary text
  Logout button    : ghost style, danger color on hover

Mobile:
  Hidden by default (translate-x-full)
  Show on hamburger click (translate-x-0)
  Overlay behind: bg-black/50
  Transition       : 300ms ease
```

### Header Specs
```
Height             : 64px (h-header-height)
Background         : #FFFFFF
Border bottom      : 1px solid #CBD5E1
Padding            : 0 24px
Position           : sticky top-0
Z-index            : 30

Left side:
  Hamburger menu   : visible on mobile only (lg:hidden)
  Page title       : @yield('header-title') / 20px / 600

Right side:
  Notification bell:
    Icon           : notifications (material symbols)
    Size           : 24px
    Color          : neutral-500
    Badge          : red circle with count (if unread)

  User avatar dropdown:
    Trigger        : avatar circle (initials)
    Dropdown width : 220px
    Shadow         : shadow-lg
    Border radius  : 12px
    Border         : 1px solid neutral-300
    Background     : white
    Items:
      ─ User name (non-clickable, bold)
      ─ User email (non-clickable, small, muted)
      ─ Divider
      ─ My Account
      ─ Company Profile
      ─ Divider
      ─ Logout (danger color)
```

### Page Content Area
```
Background         : #F1F5F9
Padding            : 24px
Min height         : calc(100vh - 64px)
```

### Auth Layout
```
Background         : #F1F5F9
Display            : flex, center vertically and horizontally
Min height         : 100vh
Padding            : 48px 16px

Card:
  Max width        : 440px (480px for register)
  Background       : #FFFFFF
  Border radius    : 12px
  Border           : 1px solid #CBD5E1
  Padding          : 32px
  Shadow           : 0 1px 3px rgba(0,0,0,0.1)

Logo area (above card):
  Icon             : material symbol / primary bg / white icon
  App name         : 20px / 600 / neutral-900
  Subtitle         : 14px / 400 / neutral-500
  Alignment        : centered
  Margin bottom    : 32px
```

---

## 8. Page-Specific Design Notes

### Login Page
```
Layout        : Auth layout
Card width    : 440px max
Title         : "Welcome back"
Subtitle      : "Sign in to your company account"
Fields        : Email, Password
Extras        : Remember me checkbox, Forgot password link
Button        : full width primary "Sign In"
Footer        : "Don't have an account? Register"
```

### Register Page (2 Steps)
```
Layout        : Auth layout
Card width    : 480px max

Step Indicator (top of card):
  Step 1 circle  : filled primary when active
  Step 2 circle  : filled primary when reached, gray before
  Connector line : primary when step 2 reached, gray before

Step 1 - Personal Info:
  Fields        : First name + Last name (grid), Email, Password, Confirm password
  Button        : "Next: Company Info →" full width primary

Step 2 - Company Info:
  Fields        : Company name, Industry, Company size (select), City + Country (grid)
  Buttons       : "← Back" (secondary) + "Create Account" (primary)

Footer        : "Already have an account? Sign in"
```

### Verify Email Page
```
Layout        : Auth layout
Card width    : 440px max
Icon          : email icon, primary color, large (48px)
Title         : "Check your email"
Message       : "We sent a verification link to {email}"
Resend button : secondary style, disabled after click
Countdown     : "Resend again in 60s" after clicking
Logout link   : small, bottom of card
```

### Forgot Password Page
```
Layout        : Auth layout
Card width    : 440px max
Title         : "Forgot your password?"
Subtitle      : "Enter your email and we'll send you a reset link"
Fields        : Email
Button        : full width primary "Send Reset Link"
Back link     : "← Back to login"
Success state : show success message, hide form
```

### Reset Password Page
```
Layout        : Auth layout
Card width    : 440px max
Title         : "Set new password"
Subtitle      : "Choose a strong password for your account"
Fields        : New password, Confirm password
Hidden fields : token, email
Button        : full width primary "Reset Password"
Back link     : "← Back to login"
```

### Pending Approval Page
```
Layout        : Auth layout
Card width    : 440px max
Icon          : clock / hourglass icon, warning yellow, 48px
Title         : "Account Under Review"
Message       : "Your company account is pending admin approval.
                 We will notify you at {email} once reviewed."
Timeline      : optional "usually takes 1-2 business days"
Action        : logout button only (secondary style)
```

### Rejected Page
```
Layout        : Auth layout
Card width    : 440px max
Icon          : x-circle icon, danger red, 48px
Title         : "Account Not Approved"
Reason box    : show rejection_reason from DB (warning box style)
Message       : "If you believe this is a mistake, contact support"
Actions       : Contact Support button + Logout link
```

### Suspended Page
```
Layout        : Auth layout
Card width    : 440px max
Icon          : block/ban icon, neutral-500, 48px
Title         : "Account Suspended"
Message       : Show suspended_until date if available
               "Your account is suspended until {date}"
               Or "Your account has been suspended"
Actions       : Contact Support button + Logout link
```

### Dashboard Home
```
Layout           : Dashboard layout
Header title     : "Dashboard"

Profile completion banner (show if < 100%):
  Background     : primary-light
  Border         : 1px solid primary
  Border radius  : 12px
  Padding        : 16px 24px
  Contains       : progress bar + % + missing fields list + link to profile

Stats row (4 cards, equal width grid):
  Card 1: Total Jobs Posted
    Icon bg      : primary-light
    Icon color   : primary
    Icon         : work
    Trend        : ↑ X new today

  Card 2: Total Applications
    Icon bg      : info-light
    Icon color   : info
    Icon         : description
    Trend        : ↑ X new today

  Card 3: Active Jobs
    Icon bg      : success-light
    Icon color   : success
    Icon         : check_circle
    Trend        : X closing this week

  Card 4: New Applications Today
    Icon bg      : warning-light
    Icon color   : warning
    Icon         : notifications
    Trend        : since yesterday

Recent Applications table (below stats):
  Columns      : Candidate, Job Title, Status badge, Date, Actions
  Rows         : last 5 applications
  Actions      : View button
  Empty state  : illustration + "No applications yet"
```

### Company Profile Page
```
Layout           : Dashboard layout (owner only)
Header title     : "Company Profile"

Profile completion banner:
  Same as dashboard banner
  Show missing fields with links to each section

Section 1 - Logo & Banner (top card):
  Banner         : full width, 200px height, bg neutral-100 if empty
  Logo           : 80px circle, overlapping banner bottom-left
  Edit buttons   : top right of each image

Section 2 - Basic Info card:
  Fields         : Company name, Description (textarea),
                   Industry, Specialization,
                   Company size (select), Founded year,
                   Website
  Save button    : bottom right of card

Section 3 - Location card:
  Fields         : Address, City, Country
  Save button    : bottom right of card

Section 4 - Contact Info card:
  Fields         : Contact phone, Contact email
  Save button    : bottom right of card

Section 5 - Social Links card:
  Rows           : Platform icon + label + URL input
  Platforms      : Facebook, LinkedIn
  Save button    : bottom right of card
```

### Team Management Page
```
Layout           : Dashboard layout (owner only)
Header title     : "Team Management"

Top bar:
  Left           : page title + member count badge
  Right          : "Invite Member" button (primary)

Members table:
  Columns        : Avatar+Name, Email, Role badge, Status badge,
                   Joined date, Actions
  Role badges    : company-owner (primary), hiring-manager (info)
  Status badges  : Active (success), Inactive (neutral)
  Actions        : Resend invite (if inactive), Deactivate (danger)

Empty state      : "No team members yet. Invite your first hiring manager."

Invite modal:
  Fields         : First name, Last name, Email
  Button         : "Send Invitation"
  Note           : "They will receive an email to set their password"
```

### Jobs Page
```
Layout           : Dashboard layout (both roles)
Header title     : "Job Listings"

Top bar:
  Left           : total jobs count
  Right          : "Post a Job" button (primary, owner only)

Filters bar:
  Search input   : search by job title
  Status filter  : All / Active / Draft / Closed / Expired
  Type filter    : All / Full-time / Part-time / Contract / Internship

Jobs table:
  Columns        : Job Title, Department, Status badge,
                   Applications count, Deadline, Posted date, Actions
  Actions        : Edit, View Applications, Close (owner only)

Empty state      : "No jobs posted yet. Create your first job posting."

Hiring manager view:
  Same table but no "Post a Job" button
  No close/edit actions
```

### Create/Edit Job Page
```
Layout           : Dashboard layout (owner only)
Header title     : "Post a Job" / "Edit Job"

Form sections:
  Section 1 - Basic Info:
    Job title, Category, Job type, Experience level,
    Education required, Years of experience

  Section 2 - Location:
    Location type (remote/hybrid/onsite)
    Address, City (if not remote)

  Section 3 - Salary:
    Min salary, Max salary, Currency
    Toggle: show/hide salary to applicants

  Section 4 - Description:
    Job description (rich text / textarea)
    Requirements (textarea)

  Section 5 - Documents:
    Required documents (checkboxes)
    CV, Cover letter, Portfolio, Other

  Section 6 - Screening Questions:
    Add/remove questions (dynamic)
    Max 6 questions

  Section 7 - Settings:
    Visibility (public/private/members only)
    Application deadline (date picker)
    Featured toggle (if allowed)

Bottom actions:
  Save as draft button (secondary)
  Publish button (primary)
```

### Applications Page
```
Layout           : Dashboard layout (both roles)
Header title     : "Applications"

Top bar:
  Left           : total count + filtered count
  Right          : Export button (owner only)

Filters bar:
  Search         : candidate name or email
  Job filter     : filter by specific job
  Status filter  : All / New / Reviewing / Shortlisted /
                   Interview / Offer / Hired / Rejected
  Priority filter: All / High / Medium / Low
  Date range     : filter by application date

Applications table:
  Columns        : Candidate (avatar+name), Job Title,
                   Status badge, Priority badge,
                   AI Score, Applied date, Actions
  Actions        : View, Change status, Flag

Application detail (slide-over panel):
  Candidate info : name, email, phone, avatar
  Job applied    : title, link to job
  CV download    : button
  Cover letter   : expandable section
  Screening Q&A  : questions + answers
  AI Score       : score + feedback
  Status history : timeline of status changes
  Status update  : dropdown to change status
  Priority       : set priority
  Notes          : private notes field
```

### Notifications Page
```
Layout           : Dashboard layout (both roles)
Header title     : "Notifications"

Top bar:
  Left           : unread count badge
  Right          : "Mark all as read" button

Notifications list:
  Each item      : icon + message + timestamp + read/unread dot
  Types          : new application, status change, team invite
  Click          : mark as read + navigate to relevant page

Empty state      : "You're all caught up!"
```

---

## 9. Icons

- **Icon Library:** Material Symbols Outlined (Google)
- **Import:** Already in layout head
- **Style:** Outlined for navigation and actions
- **Size:** 20px for inline (`text-xl`), 24px for standalone (`text-2xl`), 16px for badges (`text-base`)
- **Usage:** `<span class="material-symbols-outlined">icon_name</span>`

### Common Icons Used
```
dashboard       → Dashboard nav item
work            → Jobs nav item
description     → Applications nav item
notifications   → Notifications nav item
group           → Team nav item
business        → Profile nav item
menu            → Hamburger menu
close           → Close/dismiss
check_circle    → Success states
error           → Error states
warning         → Warning states
info            → Info states
logout          → Logout button
person          → User/account
settings        → Settings
edit            → Edit action
delete          → Delete action
visibility      → View action
send            → Send/invite action
upload          → File upload
download        → Export/download
add             → Add/create
arrow_back      → Back navigation
chevron_right   → Breadcrumb separator
more_vert       → Actions dropdown
```

---

## 10. Responsive Breakpoints

| Name    | Width    | Behavior |
|---------|----------|----------|
| Mobile  | < 640px  | Sidebar hidden, hamburger menu visible, single column |
| Tablet  | 640-1023px | Sidebar hidden by default, toggleable |
| Desktop | 1024px+  | Sidebar always visible, hamburger hidden |

---

## 11. Tailwind CSS Config

Current `tailwind.config.js` (do not change):

```js
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#004ac6',
          dark: '#1D4ED8',
          light: '#DBEAFE',
          container: '#2563eb',
          fixed: '#dbe1ff',
          'fixed-dim': '#b4c5ff',
          'on-fixed-variant': '#003ea8',
          'on-fixed': '#00174b',
        },
        neutral: {
          900: '#0F172A',
          700: '#334155',
          500: '#64748B',
          300: '#CBD5E1',
          100: '#F1F5F9',
        },
        success: {
          DEFAULT: '#16A34A',
          light: '#dcfce7',
        },
        warning: {
          DEFAULT: '#D97706',
          light: '#fef9c3',
        },
        danger: {
          DEFAULT: '#dc2626',
          dark: '#b91c1c',
          light: '#fee2e2',
        },
        info: {
          DEFAULT: '#0284C7',
          light: '#dbeafe',
        },
        'badge-pending-bg': '#FEF9C3',
        'badge-approved-bg': '#DCFCE7',
        'badge-rejected-bg': '#FEE2E2',
        background: '#faf8ff',
        surface: {
          DEFAULT: '#faf8ff',
          variant: '#e1e2ed',
          dim: '#d9d9e5',
          bright: '#faf8ff',
        },
        'surface-container': '#ededf9',
        'surface-container-low': '#f3f3fe',
        'surface-container-high': '#e7e7f3',
        'surface-container-highest': '#e1e2ed',
        'on-surface': '#191b23',
        'on-surface-variant': '#434655',
        outline: '#737686',
        'outline-variant': '#c3c6d7',
        secondary: {
          DEFAULT: '#565e74',
          container: '#dae2fd',
        },
      },
      borderRadius: {
        DEFAULT: '0.25rem',
        sm: '4px',
        md: '8px',
        lg: '12px',
        xl: '16px',
        full: '9999px',
      },
      spacing: {
        xl: '32px',
        '2xl': '48px',
        'sidebar-width': '240px',
        'header-height': '64px',
        '3xl': '64px',
        xs: '4px',
        sm: '8px',
        md: '16px',
        lg: '24px',
      },
      fontFamily: {
        'button-text': ['Inter'],
        'sub-heading': ['Inter'],
        'body-text': ['Inter'],
        'small-text': ['Inter'],
        'page-title': ['Inter'],
        'label-text': ['Inter'],
        'section-heading': ['Inter'],
      },
      fontSize: {
        'button-text': ['14px', { lineHeight: '20px', fontWeight: '500' }],
        'sub-heading': ['16px', { lineHeight: '24px', fontWeight: '600' }],
        'body-text': ['14px', { lineHeight: '20px', fontWeight: '400' }],
        'small-text': ['12px', { lineHeight: '16px', fontWeight: '400' }],
        'page-title': ['24px', { lineHeight: '32px', letterSpacing: '-0.02em', fontWeight: '700' }],
        'label-text': ['14px', { lineHeight: '20px', fontWeight: '500' }],
        'section-heading': ['20px', { lineHeight: '28px', fontWeight: '600' }],
      },
    },
  },
  plugins: [forms],
};
```

---

## 12. Google Fonts & Icons Import

Add to every layout `<head>`:

```html
{{-- Inter Font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet">

{{-- Material Symbols --}}
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
```

---

## 13. Email Templates Design

### Email Layout (all emails)
```
Max width      : 560px, centered
Background     : #F1F5F9 (page), #FFFFFF (card)
Border radius  : 12px
Border         : 1px solid #CBD5E1
Font           : Inter, Arial, sans-serif
Note           : NO Tailwind classes — inline CSS only
                 Email clients strip external stylesheets
```

### Email Header
```
Background     : #004ac6
Padding        : 32px
Text align     : center
Icon           : unicode emoji or simple shape (no SVG)
Title          : 20px / 700 / white
Subtitle       : 14px / rgba(255,255,255,0.8)
```

### Email Body
```
Padding        : 32px
Greeting       : 16px / 600 / #0F172A
Message        : 14px / 400 / #334155 / line-height 1.7
```

### Email Button
```
Background     : #004ac6
Color          : #FFFFFF
Padding        : 12px 32px
Border radius  : 8px
Font           : 14px / 500
Display        : inline-block
```

### Email Footer
```
Background     : #F1F5F9
Border top     : 1px solid #CBD5E1
Padding        : 24px 32px
Text align     : center
App name       : 14px / 700 / #004ac6
Links          : Support, Privacy Policy, Terms
Copyright      : 12px / #64748B
```

### Emails Used In Platform
```
1. CompanyEmailVerification
   → Sent after registration
   → Contains: verification link button, 24hr expiry notice

2. CompanyPendingApprovalEmail
   → Sent after email verification
   → Contains: pending status message, expected timeline

3. CompanyStatusChangedEmail
   → Sent when admin changes company status
   → Variants: approved, rejected (with reason), suspended

4. TeamInvitationEmail
   → Sent when owner invites hiring manager
   → Contains: invitation link, 48hr expiry, set password CTA

5. CompanyResetPasswordEmail
   → Sent on forgot password request
   → Contains: reset link button, 60min expiry notice

6. CompanyPasswordUpdatedEmail
   → Sent after successful password reset
   → Contains: confirmation, warning if not them, support link

7. ApplicationStatusEmail
   → Sent to job seeker on status change
   → Triggers: reviewing, shortlisted, interview, offer, hired, rejected
```

---

## 14. Dark Mode Notes (Future)

When implementing dark mode later, planned mappings:

| Light Token            | Dark Value  |
|------------------------|-------------|
| Page BG `#F1F5F9`      | `#0F172A`   |
| Card BG `#FFFFFF`      | `#1E293B`   |
| Border `#CBD5E1`       | `#334155`   |
| Heading `#0F172A`      | `#F1F5F9`   |
| Body text `#334155`    | `#CBD5E1`   |
| Muted `#64748B`        | `#64748B`   |
| Sidebar BG `#0F172A`   | `#000000`   |

Primary Blue `#004ac6` stays the same in both modes.

---

## 15. Livewire Components Map

```
Company Dashboard:
├── Company/Dashboard/StatsOverview       → 4 stat cards with trends
├── Company/Dashboard/ProfileCompletion   → completion banner + progress

Company Profile:
├── Company/Profile/EditBasicInfo         → basic info form
├── Company/Profile/UploadLogo            → logo upload with preview
├── Company/Profile/UploadBanner          → banner upload with preview
├── Company/Profile/EditLocation          → location form
├── Company/Profile/EditContact           → contact info form
├── Company/Profile/EditSocialLinks       → social links form

Team Management:
├── Company/Team/TeamList                 → members table
├── Company/Team/InviteMember             → invite modal
└── Company/Team/MemberActions            → deactivate / resend

Job Listings:
├── Company/Job/JobList                   → jobs table with filters
├── Company/Job/CreateJob                 → multi-section job form
├── Company/Job/EditJob                   → same as create
└── Company/Job/JobActions                → close / delete

Applications:
├── Company/Application/ApplicationList  → applications table
├── Company/Application/ApplicationDetail → slide-over detail panel
├── Company/Application/UpdateStatus     → status change dropdown
└── Company/Application/ScreeningAnswers → Q&A display

Notifications:
├── Company/Notification/NotificationList → notifications list
└── Company/Notification/NotificationBell → header bell with count
```

---

*Last updated: May 28, 2026 — Version 1.2*
*Changes in v1.2: Added all new pages, updated colors to match actual tailwind config,
added surface colors, avatar specs, toast specs, email templates list,
Livewire components map, complete icon reference*
