# Job Board Platform — Design System
> This file is the single source of truth for all UI design decisions.
> Use it as a reference in Google Stitch for every page and component.

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
| Name          | Hex       | Usage |
|---------------|-----------|-------|
| Primary Blue  | `#2563EB` | Buttons, links, active states, logo |
| Primary Dark  | `#1D4ED8` | Button hover, emphasis, focus rings |
| Primary Light | `#DBEAFE` | Backgrounds, highlights, badges, tags |

### Neutral Colors
| Name          | Hex       | Usage |
|---------------|-----------|-------|
| Neutral 900   | `#0F172A` | Main headings, sidebar background |
| Neutral 700   | `#334155` | Body text, labels, secondary headings |
| Neutral 500   | `#64748B` | Placeholder text, hints, captions |
| Neutral 300   | `#CBD5E1` | Borders, dividers, input borders |
| Neutral 100   | `#F1F5F9` | Page background, section backgrounds |
| White         | `#FFFFFF` | Cards, inputs, modals |

### Status Colors
| Name           | Hex       | Usage |
|----------------|-----------|-------|
| Success Green  | `#16A34A` | Approved, active, success messages, hired |
| Warning Yellow | `#D97706` | Pending, warnings, review status |
| Danger Red     | `#DC2626` | Rejected, errors, suspended, delete actions |
| Info Blue      | `#0284C7` | Info messages, notifications, tips |

### Status Badge Colors
| Status      | Background  | Text      |
|-------------|-------------|-----------|
| Approved    | `#DCFCE7`   | `#16A34A` |
| Pending     | `#FEF9C3`   | `#D97706` |
| Rejected    | `#FEE2E2`   | `#DC2626` |
| Suspended   | `#F1F5F9`   | `#64748B` |
| Active      | `#DBEAFE`   | `#2563EB` |
| Closed      | `#F1F5F9`   | `#64748B` |

---

## 3. Typography

### Font Family
- **Primary Font:** Inter (Google Fonts)
- **Import:** `https://fonts.google.com/specimen/Inter`
- **Fallback:** `sans-serif`

### Type Scale
| Role             | Size  | Weight | Color       | Usage |
|------------------|-------|--------|-------------|-------|
| Page Title       | 24px  | 700    | `#0F172A`   | Main page headings |
| Section Heading  | 20px  | 600    | `#0F172A`   | Card titles, section headers |
| Sub Heading      | 16px  | 600    | `#0F172A`   | Form sections, sub titles |
| Body Text        | 14px  | 400    | `#334155`   | General content, descriptions |
| Small Text       | 12px  | 400    | `#64748B`   | Captions, hints, timestamps |
| Label Text       | 14px  | 500    | `#334155`   | Form labels |
| Button Text      | 14px  | 500    | depends     | All buttons |
| Link Text        | 14px  | 500    | `#2563EB`   | Clickable links |
| Placeholder Text | 14px  | 400    | `#64748B`   | Input placeholders |
| Error Text       | 12px  | 400    | `#DC2626`   | Validation errors |

---

## 4. Spacing System

Use multiples of 4px for all spacing:

| Token  | Value | Usage |
|--------|-------|-------|
| xs     | 4px   | Tight gaps between inline elements |
| sm     | 8px   | Small padding, icon gaps |
| md     | 16px  | Default padding, form gaps |
| lg     | 24px  | Section padding, card padding |
| xl     | 32px  | Page sections, large gaps |
| 2xl    | 48px  | Page top/bottom padding |
| 3xl    | 64px  | Hero sections |

---

## 5. Border & Shadow System

### Border Radius
| Token    | Value  | Usage |
|----------|--------|-------|
| sm       | 4px    | Badges, tags, small elements |
| md       | 8px    | Inputs, buttons |
| lg       | 12px   | Cards, modals, dropdowns |
| xl       | 16px   | Large cards |
| full     | 9999px | Avatars, pills |

### Shadows
| Token    | Value                                      | Usage |
|----------|--------------------------------------------|-------|
| sm       | `0 1px 2px rgba(0,0,0,0.05)`              | Subtle lift, inputs on focus |
| md       | `0 1px 3px rgba(0,0,0,0.1)`               | Cards, dropdowns |
| lg       | `0 4px 6px rgba(0,0,0,0.07)`              | Modals, popovers |
| xl       | `0 10px 15px rgba(0,0,0,0.1)`             | Floating elements |

### Borders
| Token    | Value                        | Usage |
|----------|------------------------------|-------|
| Default  | `1px solid #CBD5E1`          | Cards, inputs, dividers |
| Focus    | `2px solid #2563EB`          | Input focus state |
| Error    | `1px solid #DC2626`          | Input error state |

---

## 6. Component Design Specs

### Buttons

#### Primary Button
```
Background : #2563EB
Text       : #FFFFFF
Hover BG   : #1D4ED8
Border     : none
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
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
Background : #DC2626
Text       : #FFFFFF
Hover BG   : #B91C1C
Border     : none
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
```

#### Ghost Button (link style)
```
Background : transparent
Text       : #2563EB
Hover BG   : #DBEAFE
Border     : none
Radius     : 8px
Padding    : 10px 20px
Font       : 14px / 500
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
Border        : 2px solid #2563EB
Shadow        : 0 0 0 3px #DBEAFE
Outline       : none
```

#### Text Input (error)
```
Border        : 1px solid #DC2626
Shadow        : 0 0 0 3px #FEE2E2
```

#### Form Label
```
Font size     : 14px
Font weight   : 500
Color         : #334155
Margin bottom : 6px
```

#### Error Message
```
Font size     : 12px
Color         : #DC2626
Margin top    : 4px
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

---

### Badges / Status Pills
```
Border Radius : 9999px (full)
Padding       : 2px 10px
Font size     : 12px
Font weight   : 500
(use status colors from section 2)
```

---

## 7. Layout Structure

### Dashboard Layout
```
┌─────────────────────────────────────────────────────┐
│                    SIDEBAR (240px)      MAIN CONTENT │
│  ┌──────────────┐  ┌──────────────────────────────┐ │
│  │ Logo         │  │ Header (64px height)          │ │
│  │              │  │ Page Title + Actions          │ │
│  │ Nav Items    │  ├──────────────────────────────┤ │
│  │              │  │                              │ │
│  │ - Dashboard  │  │  Page Content                │ │
│  │ - Jobs       │  │  (padding: 24px)             │ │
│  │ - Apps       │  │                              │ │
│  │ - Team       │  │                              │ │
│  │ - Profile    │  │                              │ │
│  │              │  │                              │ │
│  │ User Info    │  │                              │ │
│  └──────────────┘  └──────────────────────────────┘ │
└─────────────────────────────────────────────────────┘
```

### Sidebar Specs
```
Width         : 240px (desktop) / hidden (mobile)
Background    : #0F172A
Logo area     : 64px height, border-bottom 1px solid #334155
Nav item text : #CBD5E1 / 14px / 500
Nav item hover: background #334155
Nav active    : background #2563EB, text #FFFFFF
Bottom area   : user avatar + name + logout
```

### Header Specs
```
Height        : 64px
Background    : #FFFFFF
Border bottom : 1px solid #CBD5E1
Padding       : 0 24px
Contains      : page title (left) + notifications + avatar (right)
```

### Page Content Area
```
Background    : #F1F5F9
Padding       : 24px
Min height    : calc(100vh - 64px)
```

---

### Auth Layout
```
┌─────────────────────────────────────┐
│         Background: #F1F5F9         │
│                                     │
│         ┌─────────────────┐         │
│         │  Logo + Name    │         │
│         │                 │         │
│         │  Card: #FFFFFF  │         │
│         │  Radius: 12px   │         │
│         │  Padding: 32px  │         │
│         │  Shadow: md     │         │
│         │                 │         │
│         │  [Form Content] │         │
│         │                 │         │
│         └─────────────────┘         │
│                                     │
│         Max width: 440px            │
│         Centered vertically         │
└─────────────────────────────────────┘
```

---

## 8. Page-Specific Design Notes

### Login Page
```
Layout        : Auth layout (centered card)
Card width    : 440px max
Logo          : centered, Primary Blue, 40px
Platform name : centered, 20px, 600, Neutral 900
Subtitle      : centered, 14px, 400, Neutral 500
Form gap      : 20px between fields
Button        : full width, Primary
Footer link   : "Don't have an account? Register" centered
```

### Register Page
```
Layout        : Auth layout (centered card)
Card width    : 480px max
Steps         : single page form (no multi-step for now)
Fields        : Company name, Your name, Email, Password, Confirm password
Button        : full width, Primary
Footer link   : "Already have an account? Login" centered
```

### Pending Approval Page
```
Layout        : Auth layout
Icon          : clock icon, Warning Yellow
Title         : "Account Under Review"
Message       : friendly explanation of pending status
Action        : logout button only
```

### Rejected Page
```
Layout        : Auth layout
Icon          : x-circle icon, Danger Red
Title         : "Account Not Approved"
Message       : show rejection reason from database
Action        : contact support link + logout button
```

### Suspended Page
```
Layout        : Auth layout
Icon          : ban icon, Neutral 500
Title         : "Account Suspended"
Message       : show suspended until date if available
Action        : contact support link + logout button
```

### Dashboard Home
```
Layout        : Dashboard layout
Top           : profile completion banner (if incomplete)
Stats row     : 4 stat cards (total jobs, total applications, active jobs, new applications)
Recent        : latest applications table
```

### Jobs Page
```
Layout        : Dashboard layout
Top bar       : page title + "Create Job" button (right)
Filters       : status filter, search input
Table         : job title, status, applications count, deadline, actions
Actions       : edit, close, view applications
```

### Applications Page
```
Layout        : Dashboard layout
Top bar       : page title + filters
Filters       : job filter, status filter, search
Table         : candidate name, job title, status badge, date, priority, actions
Detail view   : slide-over panel or separate page
```

### Company Profile Page
```
Layout        : Dashboard layout
Sections      : Basic Info, Logo & Banner, Location, Contact, Social Links
Each section  : separate card with save button
```

### Team Management Page
```
Layout        : Dashboard layout (Owner only)
Top bar       : page title + "Invite Member" button
Table         : name, email, role, status, actions
Actions       : deactivate, resend invitation
```

---

## 9. Icons

- **Icon Library:** Heroicons (free, works great with Tailwind)
- **Style:** Outline for navigation and actions, Solid for status indicators
- **Size:** 20px for inline, 24px for standalone, 16px for badges
- **Color:** Inherits from parent text color

---

## 10. Responsive Breakpoints

| Name   | Width   | Notes |
|--------|---------|-------|
| Mobile | < 640px | Sidebar hidden, hamburger menu |
| Tablet | 640px+  | Sidebar hidden by default, toggleable |
| Desktop| 1024px+ | Sidebar always visible |

---

## 11. Tailwind CSS Config

Add this to `tailwind.config.js`:

```js
theme: {
    extend: {
        colors: {
            primary: {
                DEFAULT: '#2563EB',
                dark:    '#1D4ED8',
                light:   '#DBEAFE',
            },
            neutral: {
                900: '#0F172A',
                700: '#334155',
                500: '#64748B',
                300: '#CBD5E1',
                100: '#F1F5F9',
            },
            success: '#16A34A',
            warning: '#D97706',
            danger:  '#DC2626',
            info:    '#0284C7',
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        borderRadius: {
            sm:   '4px',
            md:   '8px',
            lg:   '12px',
            xl:   '16px',
            full: '9999px',
        },
    },
},
```

---

## 12. Google Fonts Import

Add this to your main layout `<head>`:

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
```

---

## 13. Dark Mode Notes (Future)

When implementing dark mode later, these are the planned mappings:

| Light              | Dark               |
|--------------------|--------------------|
| Page BG `#F1F5F9`  | `#0F172A`          |
| Card BG `#FFFFFF`  | `#1E293B`          |
| Border `#CBD5E1`   | `#334155`          |
| Text `#0F172A`     | `#F1F5F9`          |
| Body text `#334155`| `#CBD5E1`          |
| Muted `#64748B`    | `#64748B`          |

Primary Blue stays the same in both modes.

---

*Last updated: May 2026 — Version 1.0*
