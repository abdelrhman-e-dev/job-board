# User Management
## System Administrator — Job Board Platform

**Document Version**: 1.0
**Date**: February 7, 2026
**Last Updated**: February 7, 2026

---

## Overview

The User Management section consolidates all platform user types under a single administration hub. Admins can view, create, edit, suspend, and delete accounts for **Job Seekers**, **Company Owners**, **Hiring Managers**, and **Recruiters** from one unified interface.

**Common capabilities shared across all user types:**
- Advanced search & filter (by name, email, status, registration date, last active)
- Bulk export of user data to CSV/Excel
- Send individual or bulk communications (email, platform notification)
- Audit trail for all admin actions (impersonation, deletion, suspension)
- GDPR-compliant soft/hard delete with data anonymisation

---

## Permission Matrix

| User Type | View | Create | Edit | Delete / Suspend | Special Actions |
|---|---|---|---|---|---|
| **Job Seeker** | Full profile, activity, device info | Manual account creation | Profile, contact, preferences | Soft/Hard delete, Suspend, Deactivate | Impersonate, Verify email, Bulk email |
| **Company Owner** | Account, billing, team, job stats | Company admin accounts | Roles, permissions, company assign | Suspend, remove, delete, transfer jobs | Transfer ownership, reassign apps |
| **Hiring Manager** | Team structure, job assignments, rates | Assign manager accounts | Permissions, job scope, access | Suspend, reassign jobs, delete | Reassign managed jobs, archive activity |
| **Recruiter** | Profile, activity, assigned jobs | Recruiter accounts | Profile, permissions, assignments | Suspend, remove access, delete | Transfer jobs, reassign candidates |

---

## 1.1 Job Seeker Management

### View Permissions

#### View All Users
- Access complete list of all registered job seekers
- View user profile details (personal info, contact, demographics)
- View profile completeness percentage
- View registration date and method (email, Google, LinkedIn)
- View account status (active, suspended, deactivated, deleted)
- View login history and last active timestamp
- View device information and IP addresses
- View email verification status
- View profile photos and portfolio links

#### Advanced User Search
- Search by name, email, phone number
- Filter by registration date range, account status, profile completion %
- Filter by registration method, location, skills, experience level, last active date
- Export search results to CSV/Excel

#### User Profile Details
- View complete work experience history, education and certifications
- View skills and proficiencies
- View uploaded resumes/CVs (with download capability)
- View portfolio items and links, saved jobs, job alerts
- View application history and user preferences/settings

---

### Create Permissions

#### Manual User Creation
- Create job seeker accounts on behalf of users
- Set temporary passwords with forced reset on first login
- Send account activation emails and pre-populate profile information
- Assign user tags or categories and set initial account status

---

### Edit Permissions

#### Profile Editing
- Edit personal information, contact details, work experience entries
- Update education, certifications, skills list
- Replace profile photo, update portfolio links, modify user preferences

#### Account Management
- Reset user passwords; force password change on next login
- Update email address (with verification) and phone number
- Modify notification preferences and privacy settings

---

### Delete / Suspend Permissions

#### Account Suspension
- Suspend with reason documentation; set suspension duration (temporary / indefinite)
- Block access immediately, send suspension notification, maintain suspension history
- Unsuspend accounts and restore access

#### Account Deactivation
- Deactivate temporarily; hide profile from search results
- Prevent new applications while maintaining existing ones
- Allow user to self-reactivate

#### Account Deletion
- Soft delete — mark as deleted, retain data
- Hard delete — permanent removal (GDPR compliance)
- Anonymize user data while preserving analytics records
- Export user data before deletion; log deletion with admin user and reason

---

### Special Actions
- **Verification Management** — manually verify emails, override requirements, resend emails, mark profiles as verified/premium
- **Impersonation (Support)** — login as user with full audit trail; sensitive actions blocked during session
- **Communication** — send individual/bulk emails, platform notifications, and targeted announcements

---

## 1.2 Company Owner Management

### View Permissions
- List all company owner/admin accounts
- View associated company, account status, and permissions
- View user activity logs, job postings created, and applications reviewed
- View subscription plan, billing status, and company verification status

---

### Create Permissions
- Create company admin (owner) accounts
- Assign to specific companies and set role / permission level
- Define job posting limits and send invitation emails

---

### Edit Permissions
- Change user role (Admin ↔ Manager)
- Modify permissions, access levels, and company assignment
- Change job posting limits and enable/disable features per user

---

### Delete / Suspend Permissions
- Suspend company owner accounts (with reason and duration)
- Remove users from companies; delete company user accounts
- Transfer ownership of job postings; reassign applications

---

### Special Actions
- **Transfer Ownership** — transfer company ownership to another user
- **Reassign Applications** — reassign all open applications on account closure
- **Audit Trail** — full log for all ownership transfer actions

---

## 1.3 Hiring Manager Management

### View Permissions
- View all hiring managers across all companies
- View manager assignments to jobs and team collaboration patterns
- View manager activity, engagement, and hiring success rates
- View jobs managed per manager and applications reviewed

---

### Create Permissions
- Create hiring manager accounts
- Assign to specific companies and set permissions / access levels
- Define scope (departments, job types) and send invitation emails
- Set up manager profiles

---

### Edit Permissions
- Modify manager permissions and change job assignment scope
- Update access to applications; enable/disable collaboration features
- Adjust notification settings and manager profile information
- Assign managers to specific jobs; create manager groups/teams
- Set manager hierarchy, define approval workflows, configure collaboration settings

---

### Delete / Suspend Permissions
- Suspend manager accounts
- Remove from teams and reassign managed jobs
- Transfer application ownership and delete manager accounts
- Archive manager activity logs

---

### Special Actions
- **Bulk Reassignment** — reassign all managed jobs on suspension/deletion
- **Hierarchy Management** — set manager hierarchy and define approval workflows
- **Impersonation (Support)** — view platform from manager perspective (with audit trail)

---

## 1.4 Recruiter Management

### View Permissions
- View all recruiter accounts across all companies
- View assigned jobs and candidate pipelines
- View recruiter activity, performance metrics, and engagement logs
- View applications managed and sourcing channels used

---

### Create Permissions
- Create recruiter accounts
- Assign to specific companies and job postings
- Set permissions and access levels; send invitation emails

---

### Edit Permissions
- Modify recruiter profile information and permissions
- Change job assignments and candidate access scope
- Enable/disable sourcing tools and collaboration features
- Adjust notification settings

---

### Delete / Suspend Permissions
- Suspend recruiter accounts (with reason)
- Remove access from specific jobs or companies
- Transfer candidate ownership and delete recruiter accounts
- Archive recruiter activity and sourcing history

---

### Special Actions
- **Candidate Reassignment** — reassign all candidates in pipeline on suspension/deletion
- **Impersonation (Support)** — view platform from recruiter perspective (with audit trail)
- **Communication** — send individual or broadcast messages to recruiters

---

*System Administrator Features & Permissions — Job Board Platform — v1.0*
