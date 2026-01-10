# Software Requirements Specification (SRS)
## Job Board System - Laravel Project

### Document Version: 1.0
### Date: January 10, 2026

---

## 1. Introduction

### 1.1 Purpose
This document specifies the functional and non-functional requirements for a web-based Job Board System built using the Laravel framework. The system will connect job seekers with employers by providing a platform for posting, searching, and applying for job opportunities.

### 1.2 Scope
The Job Board System will provide:
- Job posting and management for employers
- Job search and application features for job seekers
- User authentication and profile management
- Administrative controls for platform oversight
- Email notifications for key events
- Resume/CV upload and management

### 1.3 Definitions, Acronyms, and Abbreviations
- **SRS**: Software Requirements Specification
- **UI**: User Interface
- **CV**: Curriculum Vitae
- **API**: Application Programming Interface
- **CRUD**: Create, Read, Update, Delete
- **RBAC**: Role-Based Access Control

### 1.4 References
- Laravel 11.x Documentation
- MySQL Database Documentation
- Bootstrap 5.x Framework

### 1.5 Overview
This document contains functional requirements, non-functional requirements, system features, external interface requirements, and other specifications necessary for developing the Job Board System.

---

## 2. Overall Description

### 2.1 Product Perspective
The Job Board System is a standalone web application that will serve as a marketplace connecting employers and job seekers. It will be accessible via web browsers on desktop and mobile devices.

### 2.2 Product Functions
The major functions include:
- User registration and authentication (Job Seekers, Employers, Admins)
- Job posting creation and management
- Advanced job search and filtering
- Online job applications
- User profile and resume management
- Email notifications
- Application tracking
- Admin dashboard for system management

### 2.3 User Classes and Characteristics

#### 2.3.1 Job Seekers
- Individuals searching for employment opportunities
- Need to create profiles, upload resumes, search jobs, and apply
- May have varying technical expertise

#### 2.3.2 Employers
- Companies or individuals posting job opportunities
- Need to create company profiles, post jobs, and manage applications
- Require tools to review and manage applicants

#### 2.3.3 Administrators
- System administrators managing the platform
- Have full access to manage users, jobs, and system settings
- Responsible for content moderation and platform integrity

### 2.4 Operating Environment
- **Web Server**: Apache/Nginx
- **Framework**: Laravel 11.x
- **Database**: MySQL 8.0+
- **PHP Version**: 8.2+
- **Frontend**: Blade Templates, Bootstrap 5, JavaScript
- **Email Service**: SMTP/Mail Service (e.g., Mailgun, SendGrid)

### 2.5 Design and Implementation Constraints
- Must use Laravel framework following MVC architecture
- Must be responsive for mobile and desktop browsers
- Must comply with GDPR for user data protection
- Must implement secure authentication and authorization
- Database must use migrations for version control

### 2.6 Assumptions and Dependencies
- Users have access to modern web browsers
- Email service is available for notifications
- Hosting environment supports Laravel requirements
- Users have valid email addresses for registration

---

## 3. Functional Requirements

### 3.1 User Management

#### 3.1.1 User Registration
**FR-1.1**: The system shall allow users to register as Job Seekers or Employers.

**FR-1.2**: Registration shall require: full name, email address, password, and user type selection.

**FR-1.3**: The system shall validate email uniqueness and format.

**FR-1.4**: The system shall send email verification upon registration.

**FR-1.5**: Passwords shall be hashed using bcrypt before storage.

#### 3.1.2 User Authentication
**FR-2.1**: The system shall provide login functionality using email and password.

**FR-2.2**: The system shall implement "Remember Me" functionality.

**FR-2.3**: The system shall provide password reset via email.

**FR-2.4**: The system shall lock accounts after 5 failed login attempts for 15 minutes.

**FR-2.5**: The system shall support social login (Google, LinkedIn) as optional.

#### 3.1.3 User Profile Management
**FR-3.1**: Job seekers shall be able to create and update their profiles including: personal information, education, work experience, skills, and contact details.

**FR-3.2**: Job seekers shall be able to upload and manage their resume/CV (PDF, DOC, DOCX formats, max 5MB).

**FR-3.3**: Employers shall be able to create company profiles including: company name, description, logo, website, location, and industry.

**FR-3.4**: Users shall be able to change their passwords.

**FR-3.5**: Users shall be able to upload and update profile pictures.

### 3.2 Job Management

#### 3.2.1 Job Posting (Employer)
**FR-4.1**: Employers shall be able to create job postings with: job title, description, requirements, location, job type (full-time, part-time, contract, remote), salary range (optional), application deadline, and required skills.

**FR-4.2**: Employers shall be able to save job postings as drafts.

**FR-4.3**: Employers shall be able to edit their active job postings.

**FR-4.4**: Employers shall be able to deactivate or delete their job postings.

**FR-4.5**: The system shall automatically mark jobs as expired after the application deadline.

**FR-4.6**: Job postings shall support rich text formatting for descriptions.

#### 3.2.2 Job Search and Browse (Job Seeker)
**FR-5.1**: The system shall display all active job postings on the homepage.

**FR-5.2**: Users shall be able to search jobs by keywords in title and description.

**FR-5.3**: Users shall be able to filter jobs by: location, job type, industry/category, salary range, posting date, and company.

**FR-5.4**: The system shall display job listings with pagination (20 jobs per page).

**FR-5.5**: Users shall be able to view detailed job information on a dedicated page.

**FR-5.6**: The system shall display the number of applicants for each job (visible to job poster only).

#### 3.2.3 Job Categories
**FR-6.1**: Administrators shall be able to create and manage job categories.

**FR-6.2**: Each job posting shall be assigned to one or more categories.

**FR-6.3**: Users shall be able to browse jobs by category.

### 3.3 Application Management

#### 3.3.1 Job Application (Job Seeker)
**FR-7.1**: Job seekers shall be able to apply for jobs with their profile and resume.

**FR-7.2**: Job seekers shall be able to attach a cover letter (optional, text or file).

**FR-7.3**: The system shall prevent duplicate applications to the same job.

**FR-7.4**: Job seekers shall be able to view their application history.

**FR-7.5**: Job seekers shall be able to withdraw applications before review.

**FR-7.6**: The system shall send email confirmation upon successful application.

#### 3.3.2 Application Review (Employer)
**FR-8.1**: Employers shall be able to view all applications for their job postings.

**FR-8.2**: Employers shall be able to filter applications by status (new, reviewed, shortlisted, rejected).

**FR-8.3**: Employers shall be able to change application status.

**FR-8.4**: Employers shall be able to view applicant profiles and download resumes.

**FR-8.5**: Employers shall be able to add notes to applications.

**FR-8.6**: The system shall send notifications to job seekers when application status changes.

#### 3.3.3 AI-Powered CV Screening (Employer/HR)
**FR-8.7**: The system shall provide AI-powered CV screening to automatically analyze and rank applicants based on job requirements.

**FR-8.8**: Employers shall be able to enable/disable AI screening for each job posting.

**FR-8.9**: The AI system shall extract key information from CVs including: skills, work experience duration, education level, certifications, and relevant keywords.

**FR-8.10**: The AI shall generate a match score (0-100%) for each applicant based on job requirements.

**FR-8.11**: The system shall automatically categorize applicants into: highly qualified (80-100%), qualified (60-79%), potentially qualified (40-59%), and not qualified (0-39%).

**FR-8.12**: Employers shall be able to customize AI screening criteria including: required skills weight, experience years weight, education level weight, and custom keywords importance.

**FR-8.13**: The AI shall identify missing qualifications and highlight strengths for each applicant.

**FR-8.14**: Employers shall be able to sort applications by AI match score.

**FR-8.15**: The system shall provide AI-generated summaries for each CV highlighting key qualifications.

**FR-8.16**: Employers shall be able to view detailed AI analysis reports showing why an applicant received their score.

**FR-8.17**: The system shall use natural language processing (NLP) to understand job requirements and CV content semantically.

**FR-8.18**: Employers shall be able to provide feedback on AI recommendations to improve accuracy over time.

**FR-8.19**: The AI system shall flag potential bias in screening and provide diversity insights.

### 3.4 Dashboard Features

#### 3.4.1 Job Seeker Dashboard
**FR-9.1**: Job seekers shall have a dashboard showing: applied jobs, application statuses, saved jobs, and profile completion percentage.

**FR-9.2**: Job seekers shall be able to save jobs for later application.

**FR-9.3**: Job seekers shall receive recommended jobs based on their profile and skills.

#### 3.4.2 Employer Dashboard
**FR-10.1**: Employers shall have a dashboard showing: active jobs, total applications, recent applications, and job performance metrics.

**FR-10.2**: Employers shall be able to view analytics for each job posting (views, applications).

**FR-10.3**: Employers shall have quick access to manage jobs and applications.

**FR-10.4**: Employers shall see AI screening summaries showing: total applicants screened, top-matched candidates, and average match score.

**FR-10.5**: The dashboard shall display AI-recommended candidates for review.

#### 3.4.3 Admin Dashboard
**FR-11.1**: Administrators shall have a dashboard showing: total users, total jobs, total applications, and recent activity.

**FR-11.2**: Administrators shall be able to view system statistics and reports.

**FR-11.3**: Administrators shall be able to manage all users, jobs, and applications.

**FR-11.4**: Administrators shall be able to moderate and delete inappropriate content.

**FR-11.5**: Administrators shall be able to manage site settings and configurations.

### 3.5 Notification System

**FR-12.1**: The system shall send email notifications for: successful registration, job application submission, application status changes, new applications (to employers), password reset requests, and account verification.

**FR-12.2**: Users shall be able to configure notification preferences.

**FR-12.3**: The system shall display in-app notifications for important events.

### 3.6 Search and Filter

**FR-13.1**: The system shall provide a global search functionality for jobs.

**FR-13.2**: Search results shall be ranked by relevance and recency.

**FR-13.3**: The system shall support autocomplete for job titles and locations.

**FR-13.4**: Users shall be able to save search criteria for future use.

---

## 4. Non-Functional Requirements

### 4.1 Performance Requirements

**NFR-1.1**: The system shall load pages within 3 seconds under normal load conditions.

**NFR-1.2**: The system shall support at least 1000 concurrent users.

**NFR-1.3**: Database queries shall be optimized using indexing and eager loading.

**NFR-1.4**: The system shall implement caching for frequently accessed data.

### 4.2 Security Requirements

**NFR-2.1**: All user passwords shall be hashed using bcrypt with a minimum cost of 10.

**NFR-2.2**: The system shall implement CSRF protection on all forms.

**NFR-2.3**: The system shall use prepared statements to prevent SQL injection.

**NFR-2.4**: The system shall implement XSS protection by sanitizing user inputs.

**NFR-2.5**: File uploads shall be validated for type and size.

**NFR-2.6**: The system shall use HTTPS for all communications in production.

**NFR-2.7**: The system shall implement role-based access control (RBAC).

**NFR-2.8**: Session timeout shall be set to 120 minutes of inactivity.

### 4.3 Usability Requirements

**NFR-3.1**: The user interface shall be intuitive and require minimal training.

**NFR-3.2**: The system shall be accessible on devices with screen sizes from 320px to 1920px.

**NFR-3.3**: Error messages shall be clear and actionable.

**NFR-3.4**: The system shall provide inline validation for form inputs.

**NFR-3.5**: The system shall follow WCAG 2.1 Level AA accessibility guidelines.

### 4.4 Reliability Requirements

**NFR-4.1**: The system shall have 99.5% uptime availability.

**NFR-4.2**: The system shall perform daily automated backups of the database.

**NFR-4.3**: The system shall log all errors and exceptions for debugging.

**NFR-4.4**: The system shall gracefully handle errors without exposing sensitive information.

### 4.5 Maintainability Requirements

**NFR-5.1**: Code shall follow PSR-12 coding standards.

**NFR-5.2**: The system shall use Laravel migrations for database schema management.

**NFR-5.3**: The system shall include comprehensive comments and documentation.

**NFR-5.4**: The system shall use Laravel's built-in testing framework for unit and feature tests.

### 4.6 Scalability Requirements

**NFR-6.1**: The database shall be designed to handle at least 100,000 job postings.

**NFR-6.2**: The system architecture shall support horizontal scaling.

**NFR-6.3**: The system shall use queue workers for background tasks (emails, notifications).

### 4.7 Compatibility Requirements

**NFR-7.1**: The system shall be compatible with: Chrome (latest 2 versions), Firefox (latest 2 versions), Safari (latest 2 versions), and Edge (latest 2 versions).

**NFR-7.2**: The system shall be responsive on iOS and Android mobile devices.

---

## 5. System Features

### 5.1 User Roles and Permissions

| Role | Permissions |
|------|-------------|
| Guest | Browse jobs, view job details, register/login |
| Job Seeker | All guest permissions + create profile, upload resume, apply for jobs, save jobs, view application history |
| Employer | All guest permissions + create company profile, post jobs, manage jobs, view applications, manage applicants |
| Administrator | Full system access + manage users, moderate content, manage categories, view analytics, system settings |

### 5.2 Database Schema Overview

#### Key Tables:
- **users**: id, name, email, password, user_type, email_verified_at, remember_token, timestamps
- **job_seekers**: id, user_id, phone, address, city, country, date_of_birth, resume_path, profile_picture, timestamps
- **employers**: id, user_id, company_name, company_description, company_logo, website, industry, company_size, timestamps
- **jobs**: id, employer_id, title, description, requirements, location, job_type, salary_min, salary_max, application_deadline, status, views_count, ai_screening_enabled, timestamps
- **job_categories**: id, name, slug, description, timestamps
- **job_category_pivot**: job_id, category_id
- **applications**: id, job_id, job_seeker_id, cover_letter, status, applied_at, reviewed_at, notes, ai_match_score, ai_analysis, timestamps
- **saved_jobs**: id, job_seeker_id, job_id, timestamps
- **skills**: id, job_seeker_id, name, proficiency_level, timestamps
- **experiences**: id, job_seeker_id, company, position, start_date, end_date, description, timestamps
- **educations**: id, job_seeker_id, institution, degree, field_of_study, start_date, end_date, timestamps
- **ai_screening_criteria**: id, job_id, required_skills, experience_years_weight, education_weight, skills_weight, custom_keywords, timestamps
- **ai_screening_feedback**: id, application_id, employer_id, was_accurate, feedback_notes, timestamps

### 5.3 Email Templates

The system shall include email templates for:
- Welcome email
- Email verification
- Password reset
- Application confirmation
- Application status update
- New application notification (to employer)
- Job posting approval (if moderation enabled)

---

## 6. External Interface Requirements

### 6.1 User Interfaces

**UI-1**: The system shall provide a responsive navigation menu with links to: Home, Jobs, Companies, Dashboard (authenticated users), Login/Register (guests).

**UI-2**: The homepage shall feature: search bar, featured jobs, recent jobs, job categories, and statistics.

**UI-3**: All forms shall include proper labels, placeholders, and validation messages.

**UI-4**: The system shall use a consistent color scheme and typography throughout.

### 6.2 Hardware Interfaces

Not applicable for this web-based application.

### 6.3 Software Interfaces

**SI-1**: The system shall interface with MySQL database server.

**SI-2**: The system shall integrate with SMTP email service for sending emails.

**SI-3**: The system shall optionally integrate with cloud storage (AWS S3) for file uploads.

**SI-4**: The system may interface with social media APIs for social login.

### 6.4 Communication Interfaces

**CI-1**: The system shall use HTTPS protocol for secure communication.

**CI-2**: The system shall use RESTful API design principles if an API is implemented.

---

## 7. Other Requirements

### 7.1 Legal Requirements

**LR-1**: The system shall comply with GDPR for user data protection.

**LR-2**: The system shall provide terms of service and privacy policy pages.

**LR-3**: Users shall agree to terms of service during registration.

**LR-4**: Users shall have the right to request data deletion.

### 7.2 Data Requirements

**DR-1**: All timestamps shall be stored in UTC format.

**DR-2**: Soft deletes shall be implemented for jobs and applications.

**DR-3**: File uploads shall be stored outside the public directory.

**DR-4**: User data shall be encrypted at rest and in transit.

### 7.3 Internationalization

**I18N-1**: The system shall be built with Laravel's localization features for future multi-language support.

**I18N-2**: All user-facing text shall be stored in language files.

---

## 8. Appendices

### 8.1 Technology Stack Summary

- **Backend Framework**: Laravel 11.x
- **Frontend**: Blade Templates, Bootstrap 5, JavaScript (vanilla or Alpine.js)
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Breeze/Jetstream or custom implementation
- **File Storage**: Local or AWS S3
- **Email**: Laravel Mail with SMTP
- **Queue**: Redis or Database driver
- **Cache**: Redis or File cache
- **Testing**: PHPUnit, Laravel Dusk (optional)
- **AI/ML Integration**:
    - OpenAI API (GPT-4) for CV analysis and NLP
    - Alternative: Anthropic Claude API
    - Alternative: Open-source models via HuggingFace
    - PDF parsing: Smalot/PdfParser or Apache Tika
    - Text extraction: spatie/pdf-to-text

### 8.2 Development Phases

**Phase 1**: User authentication and basic profile management
**Phase 2**: Job posting and management
**Phase 3**: Job search and filtering
**Phase 4**: Application system
**Phase 5**: AI-powered CV screening and analysis
**Phase 6**: Dashboards and analytics
**Phase 7**: Email notifications and advanced features
**Phase 8**: Testing, optimization, and deployment

### 8.3 Future Enhancements (Out of Scope for v1.0)

- Mobile applications (iOS/Android)
- Advanced AI-based job matching for job seekers
- Predictive analytics for hiring trends
- Video interview integration
- Payment system for premium job postings
- Messaging system between employers and job seekers
- Multiple language support
- API for third-party integrations
- Advanced analytics and reporting tools
- AI-powered interview question generation
- Candidate skill assessment tools

---

**Document End**

*This SRS document is subject to review and updates as the project evolves.*
