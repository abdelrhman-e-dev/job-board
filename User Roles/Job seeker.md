# 1. 👤 JOB SEEKER

## 1.1 User Profile

### Who They Are
Job Seekers are individuals actively searching for employment opportunities or passively exploring career options. They represent the demand side of the job marketplace and are the primary value drivers for attracting companies to the platform.

### Demographics
- **Age Range:** 18–65 years old  
- **Education Levels:** High school diploma to PhD  

#### Experience Levels
- Fresh graduates (0–1 years)  
- Early career (1–3 years)  
- Mid-level professionals (3–7 years)  
- Senior professionals (7–15 years)  
- Executive level (15+ years)  

- **Geographic Distribution:** Global, with focus on major employment markets  
- **Device Usage:** 75% mobile, 25% desktop  
- **Technical Proficiency:** Varies from basic to advanced  

---

## User Personas

### Persona A: Sarah — The Career Changer
- **Age:** 28  
- **Current Role:** Marketing Specialist  
- **Education:** Bachelor’s in Communications  
- **Experience:** 5 years in traditional marketing  
- **Goal:** Transition to digital marketing role with better salary  

**Pain Points**
- Lacks some required technical skills  
- Unsure how to position career change in applications  
- Needs to learn new tools quickly  

**Behavior**
- Searches daily, applies to 3–5 jobs per week  
- Heavily researches companies before applying  
- Takes online courses to fill skill gaps  
- Very responsive to application feedback  

---

### Persona B: James — The Fresh Graduate
- **Age:** 22  
- **Current Status:** Recent Computer Science graduate  
- **Education:** Bachelor’s in Computer Science  
- **Experience:** Internships and academic projects  
- **Goal:** Land first full-time software engineering role  

**Pain Points**
- Limited work experience  
- Competing with experienced candidates  
- Uncertainty about salary expectations  
- ATS systems reject resume due to formatting  

**Behavior**
- Applies to 20–30 jobs per week  
- Uses mobile app extensively  
- Needs guidance on CV optimization  
- Follows up frequently on applications  

---

### Persona C: Michael — The Passive Seeker
- **Age:** 35  
- **Current Role:** Senior Product Manager (employed)  
- **Education:** MBA  
- **Experience:** 12 years in product management  
- **Goal:** Find better opportunity with higher compensation or more interesting challenges  

**Pain Points**
- Limited time to job search  
- Needs discretion (currently employed)  
- High standards for new opportunities  
- Wants personalized, relevant matches only  

**Behavior**
- Checks platform 2–3 times per week  
- Applies to 1–2 highly targeted jobs per month  
- Relies heavily on recommendations  
- Values quality over quantity  

## 1.2 Complete Feature Access

### A. Registration & Authentication

#### Features
- Email registration with verification  
- Social login (Google, LinkedIn)  
- Password reset functionality  
- Two-factor authentication (optional)  
- Remember me on trusted devices  
- Single Sign-On (SSO) for future integrations  

#### User Flow
Landing Page → Click **Sign Up** → Choose method (Email / Google / LinkedIn)  
→ Enter details → Verify email → Complete basic profile → Dashboard  

#### Data Collected
- **Email address** (required)  
- **Password** (required, minimum 8 characters)  
- **First name** (required)  
- **Last name** (required)  
- Phone number (optional)  
- Location (city, country)  
- Agreement to Terms & Privacy Policy  

#### Security Features
- Encrypted password storage (bcrypt)  
- Email verification required before full access  
- Account lockout after 5 failed login attempts  
- Session timeout after 30 minutes of inactivity  
- Suspicious login detection and notification  

---

### B. Profile Management

#### Profile Sections

### 1. Personal Information
- Full name  
- Profile photo (optional, max 5MB)  
- Email (verified)  
- Phone number  
- Current location (city, state, country)  
- Willing to relocate (yes / no)  
- Open to remote work (yes / no)  
- Professional headline (e.g., *Senior Software Engineer*)  
- Bio / Summary (max 500 characters)  

---

### 2. Work Experience
- Unlimited entries allowed  

For each experience:
- Job title  
- Company name  
- Location  
- Start date (month / year)  
- End date or **Currently working here**  
- Description (max 2000 characters)  
- Key achievements (bullet points)  
- Order control (drag & drop)  

---

### 3. Education
- Unlimited entries allowed  

For each education entry:
- Institution name  
- Degree type  
  - High School  
  - Associate  
  - Bachelor’s  
  - Master’s  
  - PhD  
  - Certificate  
- Field of study  
- Start date  
- End date or **Currently studying**  
- Grade / GPA (optional)  
- Description / achievements  
- Order control  

---

### 4. Skills
- Add skills from master list (autocomplete)  
- Create custom skills if not listed  

#### Proficiency Levels
- Beginner (0–1 year)  
- Intermediate (1–3 years)  
- Advanced (3–5 years)  
- Expert (5+ years)  

- Primary skills (top 5 highlighted)  
- Endorsements (future feature)  

---

### 5. Certifications
- Certification name  
- Issuing organization  
- Issue date  
- Expiry date (if applicable)  
- Credential ID  
- Credential URL (for verification)  

---

### 6. Languages
- Language name  

#### Proficiency Levels
- Basic  
- Conversational  
- Professional  
- Native / Bilingual  

---

### 7. Job Preferences
- Desired job titles  
- Preferred industries  
- Job types  
  - Full-time  
  - Part-time  
  - Contract  
  - Remote  

#### Desired Salary Range
- Currency  
- Minimum salary  
- Maximum salary  
- Period (hourly / monthly / yearly)  

- Preferred locations or **Remote only**  
- Availability  
  - Immediate  
  - 2 weeks  
  - 1 month  
  - 3 months  
- Work authorization status  

---

### 8. Social Links
- LinkedIn profile  
- GitHub profile  
- Portfolio website  
- Twitter / X  
- Personal blog  
- Other professional links  

---

### Profile Completeness Indicator
Displays completion percentage (0–100%) with checklist:

- ✅ Basic info (20%)  
- ✅ Profile photo (5%)  
- ✅ At least one experience (20%)  
- ✅ At least one education (10%)  
- ✅ At least 5 skills (15%)  
- ✅ Job preferences set (10%)  
- ✅ Bio / summary written (10%)  
- ✅ CV uploaded (10%)  

---

### Profile Visibility Settings
- **Public:** Visible to all companies  
- **Limited:** Visible only to companies you apply to  
- **Private:** Not searchable, visible only in applications  

### C. CV / Resume Management

---

## Upload Features
- Upload multiple CVs (up to 10)  
- Supported formats: **PDF, DOCX, DOC**  
- Max file size: **5MB per file**  
- Drag & drop upload  
- Cloud storage (AWS S3)  

---

## CV Organization
- Assign custom name to each CV  
  - Examples: *Technical Resume*, *Creative Resume*, *General CV*  
- Set one CV as **Primary** (default for quick apply)  
- View upload date and file size  
- Preview CV in browser  
- Download CV  
- Delete CV (with confirmation)  

---

## CV Parsing (Automatic)
Triggered on upload. The system automatically:
- Extracts text from the document  
- Identifies sections (experience, education, skills)  
- Populates profile fields if empty  
- Detects contact information  
- Identifies keywords and skills  
- Stores parsed data for fast reuse  

---

## AI CV Analysis
- Automatically triggered on upload  
- Generated within **10–15 seconds**  

### Overall Score (0–100)
Based on:
- Formatting  
- Content quality  
- Keyword optimization  
- ATS compatibility  

---

## Detailed Breakdown

### Formatting Score (0–100)
- Clean layout  
- Consistent fonts  
- Proper spacing  
- Readable structure  

### Content Quality Score (0–100)
- Clear objective / summary  
- Quantified achievements  
- Action verb usage  
- Relevance to target roles  

### Keyword Optimization (0–100)
- Industry-relevant keywords  
- Skills aligned with job market demand  
- Role-specific terminology  

### ATS Compatibility (0–100)
- Simple formatting (no tables or columns)  
- Standard section headers  
- Machine-readable fonts  
- No images in content area  

---

## Strengths
```json
[
  "Strong professional summary that clearly states your value",
  "Quantified achievements (e.g., 'Increased sales by 30%')",
  "Consistent date formatting throughout",
  "Clear progression in career trajectory",
  "Relevant technical skills prominently displayed"
]

```

```
{
  "score": 72,
  "issues": [
    {
      "problem": "Two-column layout detected",
      "impact": "ATS may not parse correctly",
      "fix": "Use single-column format"
    },
    {
      "problem": "Text in header/footer",
      "impact": "Contact info may be missed",
      "fix": "Move contact details to main body"
    },
    {
      "problem": "Unconventional section headers",
      "impact": "ATS may not categorize correctly",
      "fix": "Use standard headers: 'Work Experience', 'Education', 'Skills'"
    }
  ]
}

```

**CV Version History:**
- Track all uploads
- Compare scores between versions
- See improvements over time
- Revert to previous version if needed

---

#### **D. Job Search & Discovery**

**Search Interface:**

**1. Basic Search:**
- Search bar with autocomplete
- Searches across:
  - Job titles
  - Company names
  - Job descriptions
  - Required skills
  - Locations

**2. Advanced Filters:**
```
Location:
├── City/Region selection
├── Country selection
├── Radius search (10, 25, 50, 100 miles/km)
└── Remote only option

Job Type:
├── Full-time
├── Part-time
├── Contract
├── Freelance
└── Internship

Experience Level:
├── Entry level (0-2 years)
├── Mid-level (2-5 years)
├── Senior (5-10 years)
└── Executive (10+ years)

Salary Range:
├── Currency selector
├── Minimum salary slider
├── Maximum salary slider
└── Period (hourly, monthly, yearly)

Date Posted:
├── Last 24 hours
├── Last 7 days
├── Last 30 days
└── Any time

Company:
├── Company size (1-10, 11-50, etc.)
├── Industry
└── Verified companies only

Remote Work:
├── Remote only
├── Hybrid
└── On-site
```

**3. Sort Options:**
- Relevance (default - based on profile match)
- Date posted (newest first)
- Salary (highest first)
- Company name (A-Z)

**Search Results Display:**

Each job card shows:
- Company logo
- Job title
- Company name (with verification badge if verified)
- Location (or "Remote")
- Salary range (if provided)
- Job type badge (Full-time, Remote, etc.)
- Posted date (e.g., "2 days ago")
- Match score (% based on profile)
- Quick apply button (if profile complete)
- Save/bookmark icon

**Match Score Algorithm:**
```
Match Score = 
  Skills Match (40%) +
  Experience Level Match (20%) +
  Location Match (15%) +
  Salary Match (10%) +
  Job Type Match (10%) +
  Industry Match (5%)
```

**Results Display:**
- List view (default)
- Grid view (toggle)
- 20 results per page
- Infinite scroll or pagination
- Total results count
- Active filters shown as removable chips

**4. Saved Searches:**
- Save current search with custom name
- Set up email alerts:
  - Immediate (as jobs posted)
  - Daily digest (9 AM local time)
  - Weekly digest (Monday 9 AM)
- Manage saved searches from dashboard
- Edit or delete saved searches
- View count of new jobs since last check

**5. Job Recommendations:**

**"Jobs For You" Section:**
Based on:
- Profile completeness
- Skills listed
- Work experience
- Job preferences
- Previous applications
- Jobs saved
- Search history

**Algorithm Components:**
```
Recommendation Score = 
  Skill Match (35%) +
  Experience Match (25%) +
  Preference Match (20%) +
  Similar Jobs Applied (10%) +
  Trending in Industry (10%)
```

**Recommendation Categories:**
- Best matches (90%+ match)
- Good fit (70-89% match)
- Worth considering (50-69% match)
- Similar to jobs you've saved
- From companies you've applied to
- Based on your searches

**6. Browse by Category:**
- All job categories displayed
- Click category to see all jobs
- Subcategories expandable
- Popular categories highlighted
- Recent jobs count per category

---

#### **E. Job Details & Application**

**Job Details Page:**

**Header Section:**
- Company logo
- Company name (clickable to company page)
- Job title
- Location
- Salary range (if provided)
- Job type badge
- Posted date
- Application deadline (if set)
- Quick actions:
  - Save job button
  - Share job (LinkedIn, Twitter, Email, Copy link)
  - Report job (inappropriate/spam)

**Match Indicator:**
- Match percentage with your profile
- Breakdown showing:
  - ✅ Matching skills (5 of 7)
  - ✅ Experience level match
  - ⚠️ Location (you prefer remote, this is on-site)
  - ✅ Salary range matches preference

**Job Description Tab:**
- Full job description (rich text)
- Responsibilities section
- Requirements section
- Nice-to-have qualifications
- Benefits section
- Company culture information

**Required Skills Section:**
- List of required skills
- Your matching skills highlighted in green
- Missing skills highlighted in orange
- Proficiency level required vs. yours

**Company Information Tab:**
- Company description
- Industry
- Company size
- Founded year
- Headquarters location
- Website link
- Social media links
- Company photos/culture gallery
- Employee testimonials (future)

**Similar Jobs Section:**
- 5-10 similar job recommendations
- From same company or similar roles
- Can quick-save or view

**Application Section:**

**One-Click Apply (if profile complete):**
- Single button: "Apply with Profile"
- Uses primary CV
- Auto-fills all information
- Instant submission
- Confirmation message

**Standard Application:**
1. **Personal Information (Auto-filled):**
   - Full name
   - Email
   - Phone
   - Current location
   - Editable before submission

2. **Resume Selection:**
   - Choose from uploaded CVs
   - Radio button selection
   - Preview CV option
   - Upload new CV option

3. **Cover Letter:**
   - Optional text area
   - Rich text editor
   - Character count (0/2000)
   - Templates available:
     - Generic cover letter
     - Career change template
     - Entry-level template
     - Executive template
   - AI-powered cover letter generator (future):
     - Analyzes job description
     - Incorporates your experience
     - Generates personalized letter
     - User can edit before using

4. **Screening Questions:**
   - Displayed if employer added them
   - Question types:
     - Text input
     - Yes/No
     - Multiple choice
     - Number input
   - Required questions marked with *
   - Character limits displayed
   - Validation before submission

5. **Additional Documents (Optional):**
   - Upload up to 3 additional files
   - Portfolio samples
   - Certificates
   - Letters of recommendation
   - 5MB per file limit

6. **Consent & Legal:**
   - Checkbox: "I confirm all information is accurate"
   - Checkbox: "I consent to background check if required"
   - Checkbox: "I agree to share my information with this employer"

**Application Preview:**
- See exactly what employer will see
- Review all information
- Edit button to go back
- Download application copy (PDF)

**Submit Application:**
- Final "Submit Application" button
- Confirmation modal
- Success message with:
  - Application ID
  - Confirmation email sent
  - Next steps information
  - Estimated response time

**Post-Application:**
- Application appears in "My Applications"
- Status: "Submitted"
- Timestamp recorded
- Notification to hiring manager triggered
- Application cannot be edited after submission
- Option to withdraw application

---

#### **F. Application Tracking**

**My Applications Dashboard:**

**Dashboard Overview:**
- Total applications submitted
- Applications this week
- Pending responses
- Interview invitations
- Offers received
- Rejected applications

**Filter Options:**
- All applications
- By status:
  - New/Submitted
  - Under review
  - Shortlisted
  - Interview scheduled
  - Offer received
  - Rejected
  - Withdrawn
- By date range
- By company
- By job title
- By salary range

**Application Cards:**

Each card displays:
- Company logo
- Job title
- Company name
- Applied date
- Current status badge (color-coded):
  - Blue: New/Submitted
  - Yellow: Under review
  - Green: Shortlisted/Interview
  - Red: Rejected
  - Gray: Withdrawn
- Days since application
- Status last updated
- View details button
- Quick actions (withdraw, message employer)

**Detailed Application View:**

**Application Information:**
- Full job details
- Your submitted resume (view/download)
- Cover letter
- Screening question answers
- Additional documents
- Submission timestamp

**Status Timeline:**
Visual timeline showing:
```
Applied (Jan 15, 2:30 PM)
    ↓
Reviewing (Jan 16, 10:00 AM)
    ↓
Shortlisted (Jan 18, 3:15 PM)
    ↓
Interview Scheduled (Jan 20, 11:00 AM)
    ↓
Awaiting Decision...
```

**Status Change Notifications:**
- Email notification
- In-app notification
- Push notification (if enabled)
- SMS notification (optional premium feature)

**Employer Messages:**
- Dedicated message thread per application
- Receive messages from hiring manager
- Reply to messages
- Attach files to messages
- Message read receipts
- Email notification for new messages

**Interview Information (if applicable):**
- Interview date and time
- Interview format (in-person, phone, video)
- Interview location or meeting link
- Interviewer name and title
- Preparation materials
- Add to calendar button (Google, Outlook, iCal)
- Directions/parking information

**Feedback Section:**
- Company feedback on application (if provided)
- Rejection reason (if shared)
- Tips for future applications
- Request feedback button

**Actions:**
- Withdraw application (with confirmation)
- Report issue
- Request update
- Download application PDF
- Share application status

---

#### **G. Saved Jobs**

**Saved Jobs Page:**

**Organization:**
- All saved jobs in one place
- Grid or list view
- Sort by:
  - Date saved
  - Application deadline
  - Match score
  - Salary

**Job Cards:**
- Same information as search results
- Date saved
- Application deadline warning (if approaching)
- Notes field (personal notes on each job)
- Quick apply button
- Remove from saved button

**Bulk Actions:**
- Select multiple jobs
- Apply to selected
- Remove selected
- Create folder/tag (e.g., "High Priority", "Apply Later")

**Reminders:**
- Automatic reminders for application deadlines
- Reminder if saved job but haven't applied in 7 days
- Job about to close notification

---

#### **H. Notifications & Alerts**

**Notification Types:**

**1. Application Updates:**
- Application received confirmation
- Status changed (reviewing, shortlisted, etc.)
- Interview invitation
- Offer received
- Application rejected
- Request for additional information

**2. Job Alerts:**
- New jobs matching saved searches
- New jobs from companies you've applied to
- Jobs about to close (from saved jobs)
- Similar jobs to ones you've applied to

**3. Profile & Account:**
- Profile viewed by employer
- CV analysis completed
- Profile completeness milestone
- Password change confirmation
- Login from new device

**4. Messages:**
- New message from employer
- Message reply received
- Important update from company

**5. Platform Updates:**
- New feature announcements
- Platform maintenance scheduled
- Tips for job search success

**Notification Preferences:**

**Per Notification Type:**
- Email: On/Off
- In-app: On/Off
- Push (mobile): On/Off
- SMS: On/Off (premium)

**Frequency Settings:**
- Immediate
- Daily digest (choose time)
- Weekly digest (choose day and time)
- None

**Quiet Hours:**
- Set hours to not receive push notifications
- Email not affected

**Notification Center (In-App):**
- Bell icon with unread count
- Dropdown showing recent notifications
- Mark as read/unread
- Delete notification
- Clear all notifications
- Link directly to relevant page

---

#### **I. Messages & Communication**

**Messaging Interface:**

**Message Inbox:**
- List of conversations grouped by application
- Unread messages highlighted
- Company logo and job title
- Last message preview
- Timestamp
- Unread count badge

**Conversation Thread:**
- All messages related to specific application
- Chronological order
- Sender name and role
- Message timestamp
- Read receipts
- File attachments displayed inline

**Compose Message:**
- Reply to employer messages
- Cannot initiate conversation (employers initiate)
- Rich text editor
- Attach files (up to 3 files, 5MB each)
- Save draft
- Send message

**Message Notifications:**
- Email with message preview
- Push notification
- In-app notification
- Badge on messages tab

**Response Time Indicator:**
- Shows average response time from company
- "Usually responds within 24 hours"

---

#### **J. Settings & Preferences**

**Account Settings:**

**1. Personal Information:**
- Email (with verification if changed)
- Phone number
- Change password
- Delete account (with confirmation and warning)

**2. Privacy Settings:**
- Profile visibility
  - Public (searchable by all companies)
  - Limited (only visible to companies you apply to)
  - Private (completely hidden)
- Who can contact you
  - All companies
  - Only companies I've applied to
  - None
- Show profile views
- Show application history to employers

**3. Email Preferences:**
- Job alerts frequency
- Application updates
- Marketing emails
- Newsletter
- Platform updates
- Tips and advice

**4. Notification Settings:**
- Detailed control per notification type
- Quiet hours setup
- Do not disturb mode

**5. Job Search Preferences:**
- Default search location
- Distance radius default
- Preferred job types
- Salary visibility (show/hide in searches)
- Language preference

**6. CV Settings:**
- Set primary CV
- Auto-apply with primary CV
- Allow CV parsing
- Enable AI analysis

**7. Accessibility:**
- Text size
- High contrast mode
- Screen reader optimization
- Keyboard navigation

**8. Data & Privacy:**
- Download my data (GDPR)
- Delete my data request
- Data sharing preferences
- Cookie preferences
- Privacy policy
- Terms of service

**9. Connected Accounts:**
- Linked social accounts
- Third-party integrations
- Disconnect accounts

**10. Session Management:**
- Active sessions list
- Logout from all devices
- Trust this device

---

### **1.3 User Journey Map**


**Complete Job Seeker Journey:**

```
AWARENESS STAGE
├── Hears about platform (ads, referral, search)
├── Visits landing page
├── Browses without account
└── Decides to sign up

REGISTRATION STAGE (Day 1)
├── Creates account (email or social)
├── Verifies email
├── Completes basic profile (10 min)
├── Uploads first CV (2 min)
├── Waits for AI analysis (15 seconds)
└── Reviews CV feedback

PROFILE BUILDING (Day 1-2)
├── Adds work experience (15 min)
├── Adds education (5 min)
├── Adds skills (5 min)
├── Sets job preferences (5 min)
├── Reaches 80% profile completion
└── Receives "Profile Complete" notification

JOB SEARCH PHASE (Day 2-ongoing)
├── First job search
├── Applies filters
├── Reviews job recommendations
├── Saves interesting jobs (5-10 jobs)
├── Reads job details carefully
└── Compares multiple opportunities

APPLICATION PHASE (Day 3-ongoing)
├── Applies to first job (one-click)
├── Receives confirmation
├── Continues searching
├── Applies to 3-5 more jobs in first week
├── Sets up job alerts
└── Saves search criteria

WAITING PHASE (Week 1-2)
├── Checks application status daily
├── Receives status update notifications
├── Gets first "under review" status
├── Continues applying to new jobs
├── Improves CV based on feedback
└── Optimizes profile

ENGAGEMENT PHASE (Week 2-4)
├── Receives interview invitation
├── Communicates with employer
├── Prepares for interview
├── Attends interview
├── Receives offer or rejection
├── Updates application status
└── Continues job search if needed

SUCCESS PHASE (Week 4-8)
├── Receives job offer
├── Accepts offer
├── Withdraws other applications
├── Updates profile status to "Not looking"
└── May return for future job search

POST-HIRE (Optional)
├── Leaves platform review
├── Refers friends
└── Keeps profile for future use

```
## 1.4 Pain Points & Solutions

### Pain Point 1: Repetitive Form Filling
- **Problem:** Filling the same information for every application  
- **Solution:** One-click apply with profile data auto-fill  
- **Impact:** Reduces application time from **20 minutes to 30 seconds**  

---

### Pain Point 2: Application Black Hole
- **Problem:** No feedback on application status  
- **Solution:** Real-time status tracking with visual timeline  
- **Impact:** Transparency increases user satisfaction by **45%**  

---

### Pain Point 3: Poor CV Quality
- **Problem:** Uncertainty whether the CV is strong enough  
- **Solution:** AI-powered CV analysis with clear, actionable feedback  
- **Impact:** Improves CV quality score by an average of **23 points**  

---

### Pain Point 4: Finding Relevant Jobs
- **Problem:** Time wasted on irrelevant job listings  
- **Solution:** Match score algorithm and smart job recommendations  
- **Impact:** **67%** of applications come from recommended jobs  

---

### Pain Point 5: Missed Opportunities
- **Problem:** Ideal jobs posted but not seen in time  
- **Solution:** Saved searches with automated email alerts  
- **Impact:** **40%** increase in application rate  

---

### Pain Point 6: ATS Rejection
- **Problem:** CV rejected by Applicant Tracking Systems  
- **Solution:** ATS compatibility checks and formatting recommendations  
- **Impact:** **30%** increase in passing initial screening  

## 1.5 Behavioral Patterns

### Usage Patterns

#### Active Job Seekers
- Visit platform **5–7 times per week**
- Apply to **5–15 jobs per week**
- Spend **30–60 minutes** per session
- Check application status **2–3 times per day**
- Respond to messages **within hours**
- Update profile every **2–3 weeks**

---

#### Passive Job Seekers
- Visit platform **1–2 times per week**
- Apply to **1–3 highly targeted jobs per month**
- Spend **15–30 minutes** per session
- Check application status **weekly**
- Respond to messages within **1–2 days**
- Rarely update profile

---

#### Fresh Graduates
- Visit platform **daily** during first month
- Apply to **20–30 jobs per week**
- Mass apply with minimal customization
- Very responsive to feedback
- Frequently update CV
- Highly engaged with platform features

---

#### Experienced Professionals
- Strategic and selective approach
- Extensive company research before applying
- Customize every application
- Higher application-to-interview ratio
- Value quality over quantity
- Heavy use of advanced filters

---

## 1.6 Success Metrics

### User Success Indicators
- Profile completion: **> 80%**
- Applications submitted: **> 5** in first 2 weeks
- Application response rate: **> 20%**
- Interview invitation rate: **> 5%**
- Time-to-hire: **< 45 days**
- User satisfaction (NPS): **> 40**

---

### Platform Success Indicators
- User retention: **60%** return after 30 days
- Application completion rate: **> 80%**
- One-click apply usage: **> 60%**
- CV analysis engagement: **> 70%**
- Job alert conversion: **> 25%**
- Message response rate: **> 80%**
