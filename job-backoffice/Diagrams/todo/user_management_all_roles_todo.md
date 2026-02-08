# User Management - Implementation TODO List
## All Users in One Table (Role-Based System)

**Project**: Job Board Platform - Admin Panel  
**Technology Stack**: Laravel 11 + Filament 3  
**Architecture**: Single Users Table with Role Column  
**Your Level**: Beginner (Just finished Laravel course)  
**Estimated Timeline**: 2-3 weeks

---

## 🏗️ System Architecture Overview

### Understanding the Users Table Structure
You have ONE users table that contains:
- **Job Seekers** (role: 'job_seeker')
- **Company Admins** (role: 'company_admin')
- **Hiring Managers** (role: 'hiring_manager')
- **System Admins** (role: 'admin' or 'super_admin')

### Why This Approach?
- Shared authentication system
- Common fields (name, email, password)
- Role-specific fields (conditional based on role)
- Easier to manage permissions
- Single login system for all user types

---

## 📋 Before You Start - Day 0 (2-4 hours)

### Environment Setup Checklist

- [ ] Verify Laravel is installed (version 11.x)
- [ ] Verify Filament is installed (version 3.x)
- [ ] Verify PHP version (8.2 or higher)
- [ ] Verify Composer is working
- [ ] Check database is running (MySQL/PostgreSQL)
- [ ] Verify database connection in .env file
- [ ] Test database connection works
- [ ] Create admin user if not exists
- [ ] Start Laravel development server
- [ ] Access Filament admin panel at /admin
- [ ] Verify you can login to admin panel
- [ ] Check that dashboard loads successfully

### Planning Session

- [ ] Review the PRD to understand all user types
- [ ] List common fields ALL users need
- [ ] List job seeker specific fields
- [ ] List company user specific fields
- [ ] Plan which fields are nullable vs required
- [ ] Sketch out the database schema on paper
- [ ] Understand role-based filtering concept

### Review These Concepts First
- [ ] Read about Laravel Models
- [ ] Read about Eloquent ORM basics
- [ ] Read about database migrations
- [ ] Read about polymorphic relationships
- [ ] Read about validation rules
- [ ] Read about Filament forms and conditional fields
- [ ] Skim through Filament documentation

---

## Week 1: Core User Management System

### Day 1: Database Schema & Model (5-7 hours)

#### Morning Session: Plan the Schema

- [ ] Open a text editor or draw on paper
- [ ] List ALL fields from PRD for job seekers
- [ ] List ALL fields from PRD for company admins
- [ ] List ALL fields from PRD for hiring managers
- [ ] Identify COMMON fields (all users have these)
- [ ] Identify ROLE-SPECIFIC fields (only certain roles need)
- [ ] Decide which fields should be nullable
- [ ] Plan the role enum values
- [ ] Plan status enum values
- [ ] Plan how to handle role-specific data

**Common Fields for All Users:**
- [ ] Note: id, email, password, remember_token
- [ ] Note: first_name, last_name
- [ ] Note: phone, profile_photo
- [ ] Note: status (active, suspended, deactivated, deleted)
- [ ] Note: email_verified, email_verified_at
- [ ] Note: created_at, updated_at, deleted_at

**Job Seeker Specific Fields:**
- [ ] Note: bio, location, city, country
- [ ] Note: profile_completeness
- [ ] Note: registration_method (email, google, linkedin)

**Company User Specific Fields:**
- [ ] Note: company_id (foreign key)
- [ ] Note: job_posting_limit
- [ ] Note: can_manage_team (boolean)

**Common Tracking Fields:**
- [ ] Note: last_active_at, last_ip
- [ ] Note: suspension_reason, suspended_at

#### Afternoon Session: Create Migration

- [ ] Run artisan command to create users migration (may already exist)
- [ ] If migration exists, create new migration to modify users table
- [ ] Open the migration file
- [ ] Add role column as enum with all role types
- [ ] Add first_name and last_name columns
- [ ] Add phone column (nullable)
- [ ] Add profile_photo column (nullable)
- [ ] Add status enum column with default 'active'
- [ ] Add email_verified boolean with default false
- [ ] Add bio text column (nullable - for job seekers)
- [ ] Add location, city, country columns (nullable - for job seekers)
- [ ] Add profile_completeness integer (nullable - for job seekers)
- [ ] Add registration_method enum (nullable - for job seekers)
- [ ] Add company_id foreign key (nullable - for company users)
- [ ] Add job_posting_limit integer (nullable - for company users)
- [ ] Add can_manage_team boolean (nullable - for company users)
- [ ] Add last_active_at timestamp (nullable)
- [ ] Add last_ip string (nullable)
- [ ] Add suspension_reason text (nullable)
- [ ] Add suspended_at timestamp (nullable)
- [ ] Add soft deletes column
- [ ] Add indexes on email, role, status, company_id
- [ ] Save the migration file
- [ ] Run the migration command
- [ ] Check database to verify table structure
- [ ] Verify all columns exist
- [ ] Verify indexes were created

#### Evening Session: Setup User Model

- [ ] Open the User model (app/Models/User.php)
- [ ] Review existing code
- [ ] Add all new fields to fillable array
- [ ] Add casts array with proper type casting
- [ ] Keep password in hidden array
- [ ] Add SoftDeletes trait
- [ ] Create getFullNameAttribute accessor
- [ ] Create isJobSeeker() helper method
- [ ] Create isCompanyAdmin() helper method
- [ ] Create isHiringManager() helper method
- [ ] Create isAdmin() helper method
- [ ] Create scopeJobSeekers() query scope
- [ ] Create scopeCompanyUsers() query scope
- [ ] Create scopeActiveUsers() query scope
- [ ] Add company relationship (belongsTo)
- [ ] Save the model file
- [ ] Open Tinker to test the model
- [ ] Create a job seeker user manually
- [ ] Create a company admin user manually
- [ ] Test the helper methods
- [ ] Test the query scopes
- [ ] Verify relationships work

**End of Day 1 Checkpoint**: Users table and model ready for all user types

---

### Day 2: Create Filament Resource (6-8 hours)

#### Morning Session: Generate Resource

- [ ] Run artisan command to create User resource with generate flag
- [ ] Verify resource file was created
- [ ] Verify page files were created (List, Create, Edit)
- [ ] Visit admin panel in browser
- [ ] Navigate to Users menu item
- [ ] Observe the auto-generated table
- [ ] Note that it shows ALL users together
- [ ] Understand you'll add role filtering

#### Late Morning: Plan Resource Structure

- [ ] Decide if you want separate resources per role OR one resource with filters
- [ ] Recommended: One resource with role filters (simpler)
- [ ] Alternative: Separate resources (JobSeekerResource, CompanyUserResource)
- [ ] For this guide, we'll use ONE resource with filters
- [ ] Make note of your decision

#### Afternoon Session: Configure Basic Table

- [ ] Open UserResource.php file
- [ ] Find the table() method
- [ ] Remove all auto-generated columns
- [ ] Plan which columns show for all user types
- [ ] Add image column for profile photo (circular)
- [ ] Add text column for full name (searchable by first and last)
- [ ] Add text column for email (searchable, copyable)
- [ ] Add text column for phone (toggleable, hidden by default)
- [ ] Add badge column for role with different colors
- [ ] Add badge column for status with color coding
- [ ] Add icon column for email verified
- [ ] Add text column for company name (for company users, nullable)
- [ ] Add date column for created_at (registration date)
- [ ] Add date column for last_active_at (show as time ago)
- [ ] Make full name sortable
- [ ] Make email sortable
- [ ] Make created_at sortable
- [ ] Make last_active_at sortable
- [ ] Add toggleable to optional columns
- [ ] Save the file
- [ ] Refresh the admin page
- [ ] Test searching by name
- [ ] Test searching by email
- [ ] Test sorting columns
- [ ] Test toggling visibility

#### Evening Session: Add Role-Based Filters

- [ ] Find the filters section in table method
- [ ] Add select filter for role
- [ ] Add all role options (job_seeker, company_admin, hiring_manager, admin)
- [ ] Make role filter support multiple selections
- [ ] Add select filter for status
- [ ] Add all status options (active, suspended, deactivated, deleted)
- [ ] Make status filter support multiple selections
- [ ] Add ternary filter for email verification
- [ ] Add select filter for company (for company users)
- [ ] Query companies for the select options
- [ ] Make company filter searchable
- [ ] Add date range filter for registration date
- [ ] Create form with from and to date fields
- [ ] Write query logic for date filtering
- [ ] Add trashed filter for soft deletes
- [ ] Save the file
- [ ] Test each filter individually
- [ ] Test filtering by job_seeker role only
- [ ] Test filtering by company_admin role only
- [ ] Test combining role + status filters
- [ ] Test company filter (if you have test companies)
- [ ] Verify trashed filter shows deleted users

**End of Day 2 Checkpoint**: Table displays all users with role-based filtering

---

### Day 3: Role-Based Forms (7-9 hours)

#### Morning Session: Plan Conditional Form Logic

- [ ] Understand that form fields will show/hide based on role
- [ ] List common fields (show for ALL roles)
- [ ] List job seeker only fields
- [ ] List company user only fields
- [ ] Plan how to use Filament's conditional display
- [ ] Understand the Get and Set form helpers
- [ ] Read Filament docs on reactive forms

#### Late Morning: Build Common Fields Section

- [ ] Find the form() method in UserResource
- [ ] Remove auto-generated fields
- [ ] Create "Basic Information" section
- [ ] Add grid layout (2 columns)
- [ ] Add first name text input (required)
- [ ] Add last name text input (required)
- [ ] Add email text input (required, unique, email validation)
- [ ] Add phone text input (optional, tel format)
- [ ] Add password input (required on create, optional on edit)
- [ ] Add password confirmation input
- [ ] Make password fields visible on create always
- [ ] Make password fields collapsible on edit
- [ ] Add file upload for profile photo
- [ ] Configure image editor, circle cropper
- [ ] Set directory and file size limits
- [ ] Make section span full width

#### Afternoon Session: Add Role Selection & Status

- [ ] Create "Account Type & Status" section
- [ ] Add select dropdown for role (required)
- [ ] Add all role options with clear labels
- [ ] Make role reactive (form updates when changed)
- [ ] Add status select dropdown
- [ ] Add all status options
- [ ] Set default status to 'active'
- [ ] Add toggle for email verified
- [ ] Add date-time picker for email verified at (disabled, display only)
- [ ] Add textarea for suspension reason
- [ ] Make suspension reason conditional (only show when status is suspended)
- [ ] Make suspension reason required when suspended
- [ ] Add date-time picker for suspended at (display only)

#### Evening Session: Add Role-Specific Fields

**Job Seeker Specific Fields:**
- [ ] Create "Job Seeker Profile" section
- [ ] Make entire section conditional (visible only when role is job_seeker)
- [ ] Add textarea for bio with character limit
- [ ] Add text input for location
- [ ] Add text input for city
- [ ] Add text input for country
- [ ] Add number input for profile completeness (0-100)
- [ ] Add select for registration method
- [ ] Make section collapsible

**Company User Specific Fields:**
- [ ] Create "Company Association" section
- [ ] Make entire section conditional (visible only when role is company_admin or hiring_manager)
- [ ] Add searchable select for company_id
- [ ] Query companies for dropdown options
- [ ] Make company_id required for company users
- [ ] Add number input for job posting limit (for admins)
- [ ] Make job posting limit conditional (only for company_admin)
- [ ] Add toggle for can_manage_team (for hiring managers)
- [ ] Add helper text explaining permissions
- [ ] Make section collapsible

- [ ] Test form in create mode
- [ ] Select job_seeker role and verify job seeker fields appear
- [ ] Select company_admin role and verify company fields appear
- [ ] Select hiring_manager role and verify correct fields appear
- [ ] Test that conditional fields hide/show properly
- [ ] Test form validation for each role
- [ ] Try submitting with missing required fields
- [ ] Verify validation messages appear

**End of Day 3 Checkpoint**: Forms adapt based on selected role

---

### Day 4: Role-Based Actions & View (6-8 hours)

#### Morning Session: Add Table Actions

- [ ] Find the actions section in table method
- [ ] Keep default View and Edit actions
- [ ] Add custom "Verify Email" action
- [ ] Set icon and color
- [ ] Make visible only for unverified users
- [ ] Add confirmation requirement
- [ ] Write action logic to update verification fields
- [ ] Add success notification
- [ ] Add custom "Suspend User" action
- [ ] Set icon and warning color
- [ ] Make visible only for active users
- [ ] Create form with suspension reason textarea
- [ ] Add optional suspension duration date picker
- [ ] Write action logic to update status and reason
- [ ] Add warning notification
- [ ] Add custom "Activate User" action
- [ ] Set icon and success color
- [ ] Make visible only for suspended/deactivated users
- [ ] Add confirmation requirement
- [ ] Write action logic to restore active status
- [ ] Add success notification
- [ ] Add "Impersonate" action (for testing/support)
- [ ] Make visible only for non-admin users
- [ ] Add security logging for impersonation
- [ ] Keep delete action
- [ ] Add required use statements
- [ ] Save and test each action
- [ ] Test verify email action
- [ ] Test suspend action with reason
- [ ] Test activate action
- [ ] Test impersonate action (if implemented)

#### Afternoon Session: Create Role-Based View Layout

- [ ] Find or create infolist() method
- [ ] Create "Personal Information" section
- [ ] Add grid layout with image on left
- [ ] Add profile photo display (circular, large)
- [ ] Add full name entry (large, bold)
- [ ] Add email entry with icon and copyable
- [ ] Add phone entry with icon
- [ ] Add role badge with appropriate color
- [ ] Add status badge with color coding
- [ ] Create "Account Information" section
- [ ] Add email verified icon entry
- [ ] Add registration date entry
- [ ] Add last active date (time ago format)
- [ ] Add last login IP address entry
- [ ] Make section collapsible

**Job Seeker Specific View:**
- [ ] Create "Job Seeker Profile" section
- [ ] Make conditional (only show for job seekers)
- [ ] Add bio text entry (full width)
- [ ] Add location information grid
- [ ] Add city, country, full location entries
- [ ] Add profile completeness with percentage
- [ ] Add registration method badge
- [ ] Make section collapsible

**Company User Specific View:**
- [ ] Create "Company Information" section
- [ ] Make conditional (only show for company users)
- [ ] Add company name entry with link
- [ ] Add job posting limit entry (for admins)
- [ ] Add can manage team icon (for managers)
- [ ] Add team permissions description
- [ ] Make section collapsible

**Status Information:**
- [ ] Create "Account Status" section
- [ ] Add current status badge
- [ ] Add suspension reason entry (conditional)
- [ ] Add suspended at date (conditional)
- [ ] Add suspended by admin name (if tracked)
- [ ] Make section collapsible
- [ ] Make section highlighted if suspended

- [ ] Save the file
- [ ] View a job seeker user
- [ ] Verify job seeker sections show
- [ ] Verify company sections hidden
- [ ] View a company admin user
- [ ] Verify company sections show
- [ ] Verify job seeker sections hidden
- [ ] View a suspended user
- [ ] Verify suspension info displays

#### Evening Session: Add Statistics Widgets

- [ ] Open ListUsers page file
- [ ] Add getHeaderWidgets() method
- [ ] Create stats widget class
- [ ] Run artisan command to create widget
- [ ] Open widget file
- [ ] Add stat for total users
- [ ] Add stat for job seekers count
- [ ] Add stat for company admins count
- [ ] Add stat for hiring managers count
- [ ] Add stat for active users count
- [ ] Add stat for suspended users count
- [ ] Add stat for email verified percentage
- [ ] Add stat for users registered this month
- [ ] Add appropriate icons to each stat
- [ ] Add color coding to each stat
- [ ] Add descriptive labels
- [ ] Save files
- [ ] Refresh list page
- [ ] Verify all stats display
- [ ] Create a new user and watch stats update
- [ ] Delete a user and verify stats change

**End of Day 4 Checkpoint**: View page adapts to user role, stats display

---

### Day 5: Bulk Operations & Testing (6-8 hours)

#### Morning Session: Implement Bulk Actions

- [ ] Find bulkActions section in table method
- [ ] Keep existing delete bulk action
- [ ] Add bulk action for status update
- [ ] Create form with status select dropdown
- [ ] Add conditional suspension reason field
- [ ] Write action logic for bulk update
- [ ] Add notification showing count of updated users
- [ ] Configure deselect after completion
- [ ] Add bulk action for email verification
- [ ] Add confirmation requirement
- [ ] Write action logic to verify all selected
- [ ] Add success notification with count
- [ ] Add bulk action for role change (use carefully)
- [ ] Add warning confirmation
- [ ] Create form to select new role
- [ ] Write action logic with validation
- [ ] Add warning notification
- [ ] Add bulk export action
- [ ] Configure export columns
- [ ] Set filename with date
- [ ] Test selecting multiple users
- [ ] Test bulk status update
- [ ] Test bulk email verification
- [ ] Test bulk export

#### Afternoon Session: Comprehensive Testing

**Test User Creation for Each Role:**
- [ ] Create a job seeker with all fields
- [ ] Verify job seeker fields saved correctly
- [ ] Create a company admin with company association
- [ ] Verify company association saved
- [ ] Create a hiring manager
- [ ] Verify manager permissions saved
- [ ] Create a system admin
- [ ] Verify admin role assigned

**Test Form Conditionals:**
- [ ] Edit job seeker and change role to company_admin
- [ ] Verify form fields update appropriately
- [ ] Change back to job_seeker
- [ ] Verify job seeker fields reappear
- [ ] Test all role transitions
- [ ] Verify no data loss on role change

**Test Filtering:**
- [ ] Filter by job_seeker role only
- [ ] Count users, verify count matches
- [ ] Filter by company_admin role only
- [ ] Verify only company admins show
- [ ] Filter by active status
- [ ] Verify only active users show
- [ ] Combine role + status filters
- [ ] Verify combined filters work correctly
- [ ] Filter by company (if applicable)
- [ ] Clear all filters and verify all users return

**Test Actions:**
- [ ] Test verify email on job seeker
- [ ] Test verify email on company user
- [ ] Test suspend with reason
- [ ] Test activate suspended user
- [ ] Test delete user
- [ ] Test restore deleted user
- [ ] Test each action on different roles

**Test View Pages:**
- [ ] View job seeker profile
- [ ] Verify all job seeker info displays
- [ ] View company admin profile
- [ ] Verify company info displays
- [ ] View hiring manager profile
- [ ] Verify manager permissions show
- [ ] View suspended user
- [ ] Verify suspension details show

**Test Search & Sort:**
- [ ] Search by first name
- [ ] Search by last name
- [ ] Search by email
- [ ] Sort by name
- [ ] Sort by registration date
- [ ] Sort by last active date
- [ ] Verify results are correct

**Test Edge Cases:**
- [ ] Create user with minimal data
- [ ] Create user with all optional fields
- [ ] Test very long names or text
- [ ] Test special characters in fields
- [ ] Test duplicate email validation
- [ ] Test password confirmation mismatch
- [ ] Test file upload size limits
- [ ] Test invalid file types

#### Evening Session: Bug Fixes

- [ ] Review all errors encountered
- [ ] List all bugs found during testing
- [ ] Prioritize bugs by severity
- [ ] Fix critical bugs first
- [ ] Test each fix immediately
- [ ] Check migration ran correctly
- [ ] Verify all columns exist
- [ ] Verify indexes were created
- [ ] Check storage link for uploads
- [ ] Verify upload directories exist
- [ ] Check directory permissions
- [ ] Test password hashing works
- [ ] Clear application cache
- [ ] Clear Filament cache
- [ ] Check Laravel logs for errors
- [ ] Fix any validation issues
- [ ] Fix any display issues
- [ ] Re-test all fixed bugs
- [ ] Verify no regressions
- [ ] Document any workarounds

**End of Day 5 Checkpoint**: All user types working correctly

---

## Week 2: Advanced Features & Relationships

### Day 6: User Relationships - Job Seeker Data (7-9 hours)

#### Morning Session: Plan Job Seeker Relationships

- [ ] Review PRD for job seeker data requirements
- [ ] List relationship tables needed:
  - Work Experience
  - Education
  - Skills
  - Certifications
  - Portfolio Items
  - Saved Jobs
- [ ] Decide which to implement in MVP
- [ ] Recommended MVP: Work Experience, Education, Skills
- [ ] Plan to add others later

#### Late Morning: Create Work Experience

- [ ] Run artisan command for WorkExperience model and migration
- [ ] Open work experience migration
- [ ] Add foreign key to users table (not job_seekers)
- [ ] Add constraint to cascade delete
- [ ] Add job_title column (required)
- [ ] Add company_name column (required)
- [ ] Add location column (optional)
- [ ] Add description text column (optional)
- [ ] Add start_date column (required)
- [ ] Add end_date column (optional)
- [ ] Add is_current boolean column
- [ ] Add order column for sorting
- [ ] Add timestamps
- [ ] Run migration
- [ ] Verify table created

- [ ] Open WorkExperience model
- [ ] Add fillable array with all fields
- [ ] Add casts for dates and boolean
- [ ] Add belongsTo relationship to User
- [ ] Save model

- [ ] Open User model
- [ ] Add hasMany relationship for workExperiences
- [ ] Add orderBy to relationship
- [ ] Save model
- [ ] Test relationship in Tinker

#### Afternoon Session: Add Work Experience to Forms

- [ ] Open UserResource form method
- [ ] Add "Work Experience" section after job seeker fields
- [ ] Make section conditional (only for job_seekers)
- [ ] Add Repeater component
- [ ] Configure repeater to use relationship
- [ ] Add grid for job title and company name
- [ ] Add job title input (required)
- [ ] Add company name input (required)
- [ ] Add location input (optional)
- [ ] Add description textarea
- [ ] Add grid for dates and current toggle
- [ ] Add start date picker (required)
- [ ] Add end date picker (conditional, hide if current)
- [ ] Add is_current toggle
- [ ] Make dates reactive to toggle
- [ ] Configure repeater as orderable
- [ ] Configure repeater as collapsible
- [ ] Set item label to show job title
- [ ] Set add button label
- [ ] Default to 0 items
- [ ] Make section collapsible
- [ ] Hide section on create page
- [ ] Save file

- [ ] Edit a job seeker user
- [ ] Expand work experience section
- [ ] Add a work experience entry
- [ ] Fill all fields
- [ ] Add another entry
- [ ] Test drag-and-drop reordering
- [ ] Toggle current position checkbox
- [ ] Verify end date hides
- [ ] Save and check database
- [ ] Verify entries saved correctly

#### Evening Session: Display Work Experience in View

- [ ] Open infolist method
- [ ] Add "Work Experience" section
- [ ] Make conditional (only show for job seekers with experience)
- [ ] Add RepeatableEntry component
- [ ] Add grid for each entry
- [ ] Add job title entry (bold, large)
- [ ] Add company name entry with icon
- [ ] Add location entry with icon
- [ ] Add description entry (full width)
- [ ] Add date range entry
- [ ] Format dates nicely
- [ ] Show "Present" for current positions
- [ ] Make section collapsible
- [ ] Save file
- [ ] View job seeker with work experience
- [ ] Verify display is clear and organized
- [ ] Check ordering is correct

**End of Day 6 Checkpoint**: Work experience fully functional for job seekers

---

### Day 7: Education & Skills (6-8 hours)

#### Morning Session: Create Education

- [ ] Run artisan command for Education model and migration
- [ ] Open education migration
- [ ] Add foreign key to users table
- [ ] Add degree column (required)
- [ ] Add institution column (required)
- [ ] Add field_of_study column (optional)
- [ ] Add start_date column (required)
- [ ] Add end_date column (optional)
- [ ] Add grade/GPA column (optional)
- [ ] Add order column
- [ ] Add timestamps
- [ ] Run migration

- [ ] Setup Education model
- [ ] Add fillable array
- [ ] Add casts for dates
- [ ] Add belongsTo relationship to User
- [ ] Add hasMany relationship in User model
- [ ] Test relationship in Tinker

#### Afternoon Session: Add Education to Forms

- [ ] Add "Education" section to form
- [ ] Make conditional for job seekers only
- [ ] Add Repeater component with relationship
- [ ] Add degree input (required)
- [ ] Add institution input (required)
- [ ] Add field of study input (optional)
- [ ] Add date pickers for start and end
- [ ] Add grade/GPA input (optional)
- [ ] Configure repeater similar to work experience
- [ ] Make orderable and collapsible
- [ ] Test adding education entries
- [ ] Test reordering
- [ ] Verify saves correctly

- [ ] Add education to infolist view
- [ ] Create appropriate display layout
- [ ] Test viewing education on profile

#### Evening Session: Create Skills System

**Option A: Simple Tags (Recommended for MVP):**
- [ ] Add skills JSON column to users table migration
- [ ] Run migration to add column
- [ ] Add skills to User model casts as array
- [ ] Add TagsInput component to form
- [ ] Make conditional for job seekers
- [ ] Configure tags input with suggestions
- [ ] Test adding and removing skills
- [ ] Display skills as badges in view

**Option B: Skills Table (More Complex):**
- [ ] Create skills lookup table
- [ ] Create user_skill pivot table
- [ ] Setup many-to-many relationship
- [ ] Add select or repeater to form
- [ ] Configure relationship saving
- [ ] Display in view page

- [ ] Test complete job seeker profile with all data
- [ ] Verify work experience displays
- [ ] Verify education displays
- [ ] Verify skills display
- [ ] Test editing all sections

**End of Day 7 Checkpoint**: Job seeker profiles are complete

---

### Day 8: Company User Relationships (5-7 hours)

#### Morning Session: Review Company Structure

- [ ] Understand company users need company association
- [ ] Check if companies table exists
- [ ] If not, note to create it later
- [ ] For now, verify company_id foreign key in users table
- [ ] Plan how company admins relate to hiring managers
- [ ] Plan how users relate to job postings

#### Afternoon Session: Team Management Features

**For Company Admins:**
- [ ] Add ability to view their hiring managers
- [ ] Create scope to filter users by company_id
- [ ] Add company relationship to User model (if not done)
- [ ] Test querying users by company

**For Hiring Managers:**
- [ ] Verify can_manage_team field works
- [ ] Plan how managers get assigned to jobs (later)
- [ ] Document manager permissions clearly

#### Evening Session: Company User View Enhancements

- [ ] Add "Team Members" section to company admin view
- [ ] Show count of hiring managers
- [ ] Show count of job postings (if applicable)
- [ ] Add "Activity Summary" for company users
- [ ] Show last login information
- [ ] Show jobs managed (if applicable)
- [ ] Make sections conditional for company users
- [ ] Test viewing company admin profile
- [ ] Test viewing hiring manager profile

**End of Day 8 Checkpoint**: Company user features complete

---

### Day 9: Advanced Filtering & Search (4-6 hours)

#### Morning Session: Enhanced Filters

- [ ] Add filter for profile completeness (job seekers)
- [ ] Create range filter (from % to %)
- [ ] Add filter for has work experience (yes/no)
- [ ] Add filter for has education (yes/no)
- [ ] Add filter for registration date range
- [ ] Add filter for last active date range
- [ ] Add filter for verified vs unverified
- [ ] Test all new filters individually
- [ ] Test combining multiple filters
- [ ] Verify performance with many users

#### Afternoon Session: Global Search

- [ ] Add getGloballySearchableAttributes method
- [ ] Include first_name, last_name, email, phone
- [ ] Add getGlobalSearchResultTitle method
- [ ] Return full name and role
- [ ] Add getGlobalSearchResultDetails method
- [ ] Return email, role, and status
- [ ] Add getGlobalSearchResultUrl method
- [ ] Test global search from navigation
- [ ] Search for users by name
- [ ] Search for users by email
- [ ] Verify clicking result opens view page

#### Evening Session: Table Grouping

- [ ] Add table grouping by role
- [ ] Make groups collapsible
- [ ] Add grouping by status
- [ ] Add grouping by company (for company users)
- [ ] Test grouping functionality
- [ ] Verify counts are correct
- [ ] Test expanding and collapsing groups

**End of Day 9 Checkpoint**: Advanced search and filtering complete

---

### Day 10: Notifications & Automation (4-6 hours)

#### Morning Session: Email Notifications

- [ ] Plan which user actions should send emails
- [ ] Setup mail configuration in .env
- [ ] Test email sending works
- [ ] Create notification for new user registration
- [ ] Create notification for account verification
- [ ] Create notification for account suspension
- [ ] Create notification for account activation
- [ ] Create notification for password reset
- [ ] Add notification sending to appropriate actions

#### Afternoon Session: System Notifications

- [ ] Add in-app notifications for user actions
- [ ] Improve notification messages
- [ ] Add notification icons
- [ ] Add notification colors
- [ ] Add notification durations
- [ ] Test notifications display properly
- [ ] Add dismissible notifications

#### Evening Session: Automation Helpers

- [ ] Create command to calculate profile completeness
- [ ] Create command to update last_active_at
- [ ] Create command to auto-suspend inactive users (optional)
- [ ] Schedule commands in console kernel (if needed)
- [ ] Test running commands manually
- [ ] Document automation tasks

**End of Day 10 Checkpoint**: Notifications and automation ready

---

## Week 3: Polish, Testing & Documentation

### Day 11: User Experience Improvements (5-7 hours)

#### Morning Session: Form Improvements

- [ ] Review all form fields for clarity
- [ ] Add helpful placeholder text
- [ ] Add helper text explaining complex fields
- [ ] Improve validation error messages
- [ ] Make error messages user-friendly
- [ ] Add field hints and tooltips
- [ ] Group related fields better
- [ ] Improve section organization
- [ ] Test form usability

#### Afternoon Session: Table Improvements

- [ ] Add description column tooltips
- [ ] Improve column labels
- [ ] Add column searchable hints
- [ ] Optimize column widths
- [ ] Add empty state messages
- [ ] Add custom empty state actions
- [ ] Improve loading states
- [ ] Add skeleton loaders if needed
- [ ] Test table on mobile view
- [ ] Adjust responsive behavior

#### Evening Session: View Page Polish

- [ ] Review all view page sections
- [ ] Improve section headers
- [ ] Add section descriptions
- [ ] Improve data presentation
- [ ] Add appropriate icons everywhere
- [ ] Use consistent spacing
- [ ] Improve badge styling
- [ ] Add action buttons where helpful
- [ ] Test view page on different roles
- [ ] Verify everything looks professional

**End of Day 11 Checkpoint**: UI/UX is polished and professional

---

### Day 12: Comprehensive Testing (7-9 hours)

#### Morning Session: Create Test Data

- [ ] Create at least 5 job seekers with varying data
- [ ] Some with complete profiles
- [ ] Some with incomplete profiles
- [ ] Some with work experience
- [ ] Some with education
- [ ] Create at least 3 company admins
- [ ] Associate with different companies
- [ ] Create at least 3 hiring managers
- [ ] Associate with same companies as admins
- [ ] Create some suspended users
- [ ] Create some unverified users
- [ ] Create users with different registration methods

#### Late Morning: Role-Based Testing

**Test as Job Seeker:**
- [ ] Create job seeker account
- [ ] Fill complete profile
- [ ] Add work experience
- [ ] Add education
- [ ] Add skills
- [ ] Upload profile photo
- [ ] Save and view profile
- [ ] Edit profile information
- [ ] Verify all data saves correctly

**Test as Company Admin:**
- [ ] Create company admin account
- [ ] Associate with company
- [ ] Set job posting limit
- [ ] Fill profile information
- [ ] Upload profile photo
- [ ] Save and view profile
- [ ] Verify company association shows
- [ ] Verify limits are enforced

**Test as Hiring Manager:**
- [ ] Create hiring manager account
- [ ] Associate with company
- [ ] Enable can_manage_team
- [ ] Fill profile
- [ ] Save and view profile
- [ ] Verify permissions display correctly

#### Afternoon Session: Admin Operations Testing

**List and Filter Operations:**
- [ ] View all users list
- [ ] Verify stats are accurate
- [ ] Filter by job_seeker role
- [ ] Count results manually, verify matches
- [ ] Filter by company_admin role
- [ ] Filter by hiring_manager role
- [ ] Filter by active status
- [ ] Filter by suspended status
- [ ] Filter by email verified
- [ ] Combine multiple filters
- [ ] Verify filtered counts are correct
- [ ] Clear filters and verify all return
- [ ] Test grouping by role
- [ ] Test grouping by status
- [ ] Test grouping by company

**Search Operations:**
- [ ] Search by first name
- [ ] Search by last name
- [ ] Search by full name
- [ ] Search by email
- [ ] Search by phone
- [ ] Use global search
- [ ] Verify all searches return correct results

**Sort Operations:**
- [ ] Sort by name ascending
- [ ] Sort by name descending
- [ ] Sort by email
- [ ] Sort by registration date oldest
- [ ] Sort by registration date newest
- [ ] Sort by last active
- [ ] Verify sort order is correct

**CRUD Operations:**
- [ ] Create new job seeker
- [ ] Create new company admin
- [ ] Create new hiring manager
- [ ] Edit job seeker details
- [ ] Edit company user details
- [ ] Change user role (test carefully)
- [ ] Verify role change updates fields appropriately
- [ ] Delete user (soft delete)
- [ ] View trashed users
- [ ] Restore deleted user
- [ ] Force delete user permanently

**Custom Actions:**
- [ ] Verify email for unverified user
- [ ] Suspend active user with reason
- [ ] Activate suspended user
- [ ] Test impersonate if implemented
- [ ] Verify all actions log appropriately
- [ ] Verify notifications appear

**Bulk Operations:**
- [ ] Select 5 users
- [ ] Bulk update status
- [ ] Verify all selected updated
- [ ] Select 10 users
- [ ] Bulk verify emails
- [ ] Verify all verified
- [ ] Select users across roles
- [ ] Export selected users
- [ ] Verify export contains correct data
- [ ] Test bulk delete (carefully)

#### Evening Session: Edge Case Testing

**Data Validation:**
- [ ] Try creating user without required fields
- [ ] Try duplicate email
- [ ] Try invalid email format
- [ ] Try short password
- [ ] Try mismatched password confirmation
- [ ] Try uploading non-image file
- [ ] Try uploading oversized file
- [ ] Try SQL injection in text fields
- [ ] Try XSS in text fields
- [ ] Verify all validations catch errors

**Boundary Testing:**
- [ ] Create user with maximum length name
- [ ] Create user with special characters
- [ ] Create user with unicode characters
- [ ] Test with 0% profile completeness
- [ ] Test with 100% profile completeness
- [ ] Test user with 10+ work experiences
- [ ] Test user with no optional data
- [ ] Test user with all optional data

**Relationship Testing:**
- [ ] Delete user with work experience
- [ ] Verify cascade delete works
- [ ] Change user role with existing data
- [ ] Verify data integrity maintained
- [ ] Associate user with non-existent company
- [ ] Verify validation catches it

**Performance Testing:**
- [ ] Load page with 100+ users
- [ ] Measure load time
- [ ] Test filtering with large dataset
- [ ] Test searching with large dataset
- [ ] Test sorting with large dataset
- [ ] Test pagination works smoothly
- [ ] Check for N+1 query issues
- [ ] Monitor memory usage

**End of Day 12 Checkpoint**: All features thoroughly tested

---

### Day 13: Bug Fixes & Optimization (6-8 hours)

#### Morning Session: Fix All Bugs

- [ ] Review all bugs found during testing
- [ ] Create prioritized bug list
- [ ] Fix critical bugs first (data loss, crashes)
- [ ] Fix high priority bugs (broken features)
- [ ] Fix medium priority bugs (UX issues)
- [ ] Fix low priority bugs (cosmetic issues)
- [ ] Test each fix immediately
- [ ] Verify no regressions introduced
- [ ] Update bug list as you go

#### Afternoon Session: Performance Optimization

**Database Optimization:**
- [ ] Review all queries used
- [ ] Check for N+1 query problems
- [ ] Add eager loading where needed
- [ ] Add with() statements in ListUsers
- [ ] Load company relationship for company users
- [ ] Load workExperiences for job seekers
- [ ] Test queries in debug bar
- [ ] Verify query count reduced
- [ ] Add database indexes if missing
- [ ] Index email column
- [ ] Index role column
- [ ] Index status column
- [ ] Index company_id column
- [ ] Add composite indexes if beneficial
- [ ] Run index migrations
- [ ] Test query performance improved

**File Upload Optimization:**
- [ ] Review image upload settings
- [ ] Add image compression
- [ ] Set maximum dimensions
- [ ] Configure thumbnail generation
- [ ] Test upload performance
- [ ] Verify file sizes are reasonable

**Caching:**
- [ ] Identify cacheable data
- [ ] Add caching for company list
- [ ] Add caching for user counts
- [ ] Set appropriate cache durations
- [ ] Test cache invalidation
- [ ] Verify cache improves performance

#### Evening Session: Code Cleanup

- [ ] Run Laravel Pint for code formatting
- [ ] Review all formatted code
- [ ] Remove commented out code
- [ ] Remove unused imports
- [ ] Remove debug statements
- [ ] Check for console.log or dd() calls
- [ ] Review variable naming
- [ ] Improve unclear variable names
- [ ] Add comments to complex logic
- [ ] Add docblocks to methods
- [ ] Organize methods logically
- [ ] Group related functionality
- [ ] Verify consistent code style
- [ ] Run any linting tools

**End of Day 13 Checkpoint**: Code is clean and optimized

---

### Day 14: Documentation & Final Review (6-8 hours)

#### Morning Session: User Documentation

- [ ] Create README for User Management
- [ ] Write overview of feature
- [ ] Document system architecture (single table, roles)
- [ ] Explain role types and differences
- [ ] Document how to access user management
- [ ] Write guide for creating users
- [ ] Document each user role separately
- [ ] Explain job seeker specific features
- [ ] Explain company user specific features
- [ ] Document searching and filtering
- [ ] Document sorting and grouping
- [ ] Document all custom actions
- [ ] Document bulk operations
- [ ] Document export functionality
- [ ] Add screenshots for each major feature
- [ ] Label and caption screenshots
- [ ] Create troubleshooting section
- [ ] Document common issues
- [ ] Add solutions to known problems
- [ ] Document validation rules
- [ ] Document file upload requirements

#### Afternoon Session: Technical Documentation

**Database Documentation:**
- [ ] Document users table schema
- [ ] Explain each column purpose
- [ ] Document role column values
- [ ] Document status column values
- [ ] List all nullable vs required fields
- [ ] Document foreign keys
- [ ] Document indexes
- [ ] Document soft deletes

**Model Documentation:**
- [ ] Document User model methods
- [ ] Explain helper methods (isJobSeeker, etc.)
- [ ] Document query scopes
- [ ] Document relationships
- [ ] Document accessors and mutators
- [ ] Document validation rules

**Resource Documentation:**
- [ ] Document UserResource structure
- [ ] Explain table configuration
- [ ] Document filter logic
- [ ] Document form conditional logic
- [ ] Document custom actions
- [ ] Document bulk actions
- [ ] Document view page structure

**Relationship Documentation:**
- [ ] Document WorkExperience model
- [ ] Document Education model
- [ ] Document Skills implementation
- [ ] Explain cascade delete behavior
- [ ] Document relationship queries

#### Evening Session: Final Testing & Sign-off

**Complete System Test:**
- [ ] Test complete user lifecycle as job seeker
- [ ] Register, complete profile, add data, verify, suspend, activate
- [ ] Test complete lifecycle as company admin
- [ ] Create, associate, configure, modify
- [ ] Test complete lifecycle as hiring manager
- [ ] Create, associate, set permissions
- [ ] Test all admin operations
- [ ] Create, read, update, delete all role types
- [ ] Test all filters and search
- [ ] Test all actions
- [ ] Test all bulk operations
- [ ] Verify all relationships work
- [ ] Check all validations
- [ ] Verify all notifications
- [ ] Test responsive design
- [ ] Test on mobile device
- [ ] Check browser compatibility
- [ ] Test in Chrome
- [ ] Test in Firefox
- [ ] Test in Safari

**Code Review Checklist:**
- [ ] All migrations run successfully
- [ ] All models have proper relationships
- [ ] All forms have validation
- [ ] All actions have error handling
- [ ] All database queries are optimized
- [ ] All files are properly organized
- [ ] All code follows conventions
- [ ] All comments are clear
- [ ] All documentation is complete
- [ ] No security vulnerabilities
- [ ] No sensitive data exposed
- [ ] No hardcoded values
- [ ] All environment variables used properly

**Final Tasks:**
- [ ] Run final test suite
- [ ] Verify all tests pass
- [ ] Review Laravel logs for errors
- [ ] Clear all caches one final time
- [ ] Run database optimizer
- [ ] Create database backup
- [ ] Commit all final changes
- [ ] Write comprehensive commit message
- [ ] Tag version in git
- [ ] Create release notes
- [ ] Document any known limitations
- [ ] Plan future enhancements
- [ ] Celebrate completion! 🎉

**End of Day 14 Checkpoint**: User Management is production-ready!

---

## Post-Completion Checklist

### Verification Checklist

**Functionality:**
- [ ] All user roles can be created
- [ ] All user roles display correctly
- [ ] Role-specific fields show/hide properly
- [ ] All validations work correctly
- [ ] All relationships function properly
- [ ] All filters work accurately
- [ ] All searches return correct results
- [ ] All actions execute properly
- [ ] All bulk operations work
- [ ] All exports contain correct data

**Data Integrity:**
- [ ] Foreign keys are enforced
- [ ] Cascade deletes work properly
- [ ] Soft deletes function correctly
- [ ] No orphaned records exist
- [ ] Data types are correct
- [ ] Nullable fields handled properly
- [ ] Required fields enforced
- [ ] Unique constraints work

**Performance:**
- [ ] Page load times acceptable
- [ ] No N+1 query issues
- [ ] Eager loading implemented
- [ ] Indexes created appropriately
- [ ] Caching implemented where beneficial
- [ ] File uploads optimized
- [ ] Large datasets handled well

**Security:**
- [ ] Passwords are hashed
- [ ] SQL injection prevented
- [ ] XSS attacks prevented
- [ ] CSRF protection enabled
- [ ] File upload validation works
- [ ] User permissions enforced
- [ ] Sensitive data not exposed
- [ ] Audit logging in place

**User Experience:**
- [ ] Interface is intuitive
- [ ] Forms are user-friendly
- [ ] Error messages are clear
- [ ] Loading states are shown
- [ ] Empty states are helpful
- [ ] Notifications are informative
- [ ] Mobile experience is good
- [ ] Responsive design works

**Documentation:**
- [ ] User guide is complete
- [ ] Technical docs are accurate
- [ ] Code is well commented
- [ ] README is comprehensive
- [ ] Troubleshooting guide exists
- [ ] Screenshots are current
- [ ] Known issues documented

### Lessons Learned

**What Worked Well:**
- [ ] Document what was easy
- [ ] Note helpful resources
- [ ] Record good practices
- [ ] List useful tools

**What Was Challenging:**
- [ ] Document difficult areas
- [ ] Note what took longest
- [ ] Record confusing concepts
- [ ] List areas needing more study

**What Would You Do Differently:**
- [ ] Better planning
- [ ] Different approach
- [ ] More testing upfront
- [ ] Different tools or packages

**Skills Gained:**
- [ ] Laravel skills improved
- [ ] Filament mastery increased
- [ ] Database design understanding
- [ ] Problem solving abilities
- [ ] Debugging skills
- [ ] Documentation skills

### Next Steps

**Immediate Next Steps:**
- [ ] Schedule code review with mentor
- [ ] Prepare presentation of work
- [ ] Discuss challenges faced
- [ ] Get feedback on code quality
- [ ] Identify improvement areas

**Future Enhancements:**
- [ ] Add profile pictures gallery
- [ ] Add resume parsing
- [ ] Add bulk import from CSV
- [ ] Add advanced search
- [ ] Add user activity timeline
- [ ] Add role-based permissions system
- [ ] Add multi-factor authentication
- [ ] Add social media integration

**Apply to Next Entity:**
- [ ] Review lessons learned
- [ ] Plan Companies resource
- [ ] Apply same patterns
- [ ] Reuse successful approaches
- [ ] Avoid previous mistakes
- [ ] Estimate timeline
- [ ] Begin implementation

---

## Daily Routine

### Morning Start (10 minutes)
- [ ] Check git status
- [ ] Pull latest changes
- [ ] Start Laravel server
- [ ] Open admin panel
- [ ] Review yesterday's work
- [ ] Read today's tasks
- [ ] Check for any overnight errors

### Work Session (3-4 hours)
- [ ] Work on current task
- [ ] Test each change immediately
- [ ] Commit working code frequently
- [ ] Take 5 minute break every hour
- [ ] Stay hydrated
- [ ] Ask for help if stuck >30 minutes

### End of Day (15 minutes)
- [ ] Test all today's changes
- [ ] Run affected features
- [ ] Review code you wrote
- [ ] Check for TODO comments
- [ ] Commit final working state
- [ ] Write clear commit message
- [ ] Update progress checklist
- [ ] Note tomorrow's starting point
- [ ] Note any questions or blockers
- [ ] Close all terminal windows properly

---

## Getting Help Guide

### Before Asking for Help

**Try These First:**
- [ ] Read the error message completely
- [ ] Check the file and line number
- [ ] Review the documentation
- [ ] Search Google with error + "Laravel" or "Filament"
- [ ] Check Filament documentation
- [ ] Search Filament Discord
- [ ] Check Laravel documentation
- [ ] Review your recent changes
- [ ] Try reverting recent changes
- [ ] Check Laravel logs
- [ ] Clear all caches
- [ ] Restart server

### When You Need Help

**Prepare This Information:**
- [ ] What you're trying to accomplish
- [ ] What you expected to happen
- [ ] What actually happened
- [ ] Full error message (copy-paste, not screenshot)
- [ ] Relevant code snippet
- [ ] What you've already tried
- [ ] Laravel version
- [ ] Filament version
- [ ] PHP version

**Where to Ask:**
- [ ] Your mentor first (that's me!)
- [ ] Filament Discord
- [ ] Laravel Discord
- [ ] Stack Overflow
- [ ] Reddit r/laravel

### Common Issues Reference

**"Column not found":**
- Run: php artisan migrate
- Check migration ran
- Check column name spelling
- Clear cache

**"Storage link missing":**
- Run: php artisan storage:link
- Check directory exists
- Check permissions

**"Class not found":**
- Run: composer dump-autoload
- Check namespace
- Check file location
- Check class name

**"Changes not showing":**
- Clear cache: php artisan optimize:clear
- Clear Filament cache: php artisan filament:cache-components
- Restart server
- Hard refresh browser (Ctrl+Shift+R)

**"Relationship not working":**
- Check foreign key exists
- Check relationship method names
- Check relationship types (hasMany vs belongsTo)
- Test in Tinker

---

## Motivation & Mindset

### Remember Every Day:
- You're building something real and valuable
- Every error teaches you something important
- Senior developers Google things constantly
- It's normal to feel overwhelmed sometimes
- Progress matters more than perfection
- Asking questions shows you're engaged
- Taking breaks helps you think clearly
- You have all the resources you need

### When Feeling Stuck:
- Take a 10 minute walk
- Explain the problem out loud
- Draw a diagram on paper
- Sleep on it and try again tomorrow
- Ask for help - that's what mentors are for
- Review what you've already accomplished
- Remember: this is temporary, you will figure it out

### Celebrate Small Wins:
- Migration ran successfully ✓
- First user created ✓
- Filter working correctly ✓
- Form validation catching errors ✓
- All tests passing ✓
- Feature working end-to-end ✓
- Code review approved ✓
- Documentation complete ✓

---

## Quick Command Reference

**Essential Commands:**
```
# Start development server
php artisan serve

# Run migrations
php artisan migrate
php artisan migrate:fresh (deletes all data!)
php artisan migrate:rollback

# Create files
php artisan make:model ModelName
php artisan make:migration migration_name
php artisan make:filament-resource ResourceName

# Maintenance
php artisan optimize:clear
php artisan filament:cache-components
php artisan storage:link

# Testing
php artisan tinker
php artisan test

# Logs
tail -f storage/logs/laravel.log
```

---

## Success Criteria

**You'll know you've succeeded when:**
- You can create any user role without errors
- You can filter and find users easily
- You can edit and update users confidently
- Role-specific forms work perfectly
- All relationships display correctly
- You understand the code you wrote
- You can explain the system to someone else
- You can troubleshoot common issues
- You feel confident making changes
- Your mentor approves your code

---

## Final Encouragement

You're about to build something complex and important. This single table, multi-role system is more advanced than a basic CRUD app. You're learning real-world patterns that professional developers use.

**Take it one checkbox at a time.**

Don't look at the 350+ items and feel overwhelmed. Just focus on the next one. Then the next. Before you know it, you'll be checking off Day 14 items and wondering how you built something so comprehensive.

**Start here:**
- [ ] Run: `php artisan make:migration modify_users_table_add_roles`

Then open the migration file and start adding columns.

**You've got this!** 🚀

Your mentor is here every step of the way. Let's build something amazing together!
