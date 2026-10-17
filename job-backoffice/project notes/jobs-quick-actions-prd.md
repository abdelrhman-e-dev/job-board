# PRD: Jobs Page Quick Actions
> Feature-level requirements for the per-row quick actions in the company dashboard jobs table.
> Version 1.0 — October 2026
> Status: Planning complete, implementation not started.

---

## 1. Overview

The jobs table already lists jobs with status cards, pagination, title search and a status filter. Each row needs a set of quick actions so a company user can manage a job's lifecycle without leaving the page.

The core idea: **which actions a row offers depends on the job's status and on a few live conditions** (deadline, blocked state, application count). The rules live in one place, the service layer, and everything else (row buttons, action execution) asks it.

Out of scope for this document: the Post Job page itself (separate PRD), the admin side of blocking, and the notification delivery infrastructure.

---

## 2. Job Lifecycle

| Status | Meaning | Who or what sets it |
|---|---|---|
| Draft | Saved, never published | Company user |
| Active | Published, accepting applications | Company user (Publish, Reopen, Restore) |
| Closed | Active job closed manually | Company user |
| Expired | Deadline reached | System, automatically |
| Blocked | Blocked by the platform | Platform admin only |
| Archived | Hidden by the company | Company user |
| Trashed | Soft-deleted | Company user |

### Lifecycle rules

- **Automatic expiry applies only to Active and Closed jobs.** Draft, Archived, Trashed and Blocked jobs keep their status when the deadline passes.
- **Expired is final.** An expired job can never be reopened.
- **An archived job stays Archived past its deadline.** The table shows an "Expired" badge next to it. The badge is derived from the deadline; it is not a status.
- **Drafts have no active deadline.** The deadline is required and validated (must be in the future) at publish time. The create form shows helper text: the deadline only takes effect when the job is published.
- **The deadline is editable only while the job is a draft.** After publishing it is locked.
- **Trashed jobs** are hidden from the table. They can be restored if the deadline has not passed at the moment of the click, and return to their previous status. Previous status is preserved by using a soft delete.

---

## 3. Action Matrix

"View" (job details) is available on every status and is not listed below.

| Status | Actions |
|---|---|
| Draft | Edit, Publish, Duplicate, Delete |
| Active | View applications, Edit*, Close, Archive, Duplicate, Delete |
| Closed | View applications, Edit*, Reopen**, Duplicate, Delete |
| Expired | View applications, Duplicate, Delete |
| Archived | View applications, Edit*, Restore**, Duplicate, Delete |
| Blocked | View applications, Edit, Submit for review (no Duplicate, no Delete) |
| Blocked (final) | View only. No applications, no actions |

\* Only when the job has **zero applications** and the deadline has not passed.
\*\* Only when the deadline has not passed and the job is not blocked.

---

## 4. Business Rules

### 4.1 "Can this job go live?" (one shared rule)
Publish, Reopen, Restore (archived) and Restore (trashed) all ask the same question: **the deadline has not passed and the job is not blocked.** The rule is written once in the service layer.

### 4.2 Check at the moment of the click
The row decides which buttons to show, but the service re-checks the rule against fresh data when an action actually runs. If the job changed in the meantime (another user, the admin, the expiry task), the action is rejected with a clear message ("This job's status has changed") and the row refreshes.

### 4.3 Edit rules
- Draft: always editable.
- Active, Closed, Archived: editable only with zero applications and deadline not passed. An archived job past its deadline is not editable; the UI explains why.
- Blocked (not final): editable regardless of applications, because nothing goes live again until an admin approves it.
- Blocked (final): not editable.
- The application count is re-checked when the user saves, not only when the edit page opens, since someone may apply mid-edit.
- Deadline field: editable on drafts only. On other statuses it shows as disabled with a short note, not hidden.

### 4.4 Blocked flow
1. Admin blocks the job and must write a note; the company can read it.
2. Company edits the job and clicks **Submit for review**. The job stays blocked, flagged as "resubmitted".
3. Admin approves or sends it back with a new note.
4. On approval the deadline check runs again: past deadline becomes Expired, otherwise the job returns to its previous status.
5. Edits made while blocked are recorded so the admin can see what changed.

### 4.5 Final block
- The admin can mark a block as **final**, and can later downgrade it to a normal block.
- Blocked remains the status; "final" is a separate marker.
- The company cannot see applications of a final-blocked job. Enforced in the scope layer (not only by hiding buttons), so direct URLs, exports and analytics are covered. The applications count is shown as a dash.
- If the admin downgrades the block, access returns automatically because it is derived from the block state.

### 4.6 Delete
- Delete is a soft delete. The job leaves the table and public search; applications are kept.
- No applications: simple confirmation.
- Has applications: show the count, link to review them, require a deliberate confirmation.
- Delete is hidden on blocked jobs, so a company cannot remove a flagged job to avoid review.

### 4.7 Duplicate
Creates a new draft with the job's content. The user sets a new deadline and publishes. Not available on blocked jobs, since it would copy flagged content around the block.

---

## 5. UX Behavior

| Action | Feedback |
|---|---|
| Publish | Toast (see Open Questions) |
| Submit for review | Toast |
| Close | Confirmation |
| Reopen | Confirmation |
| Archive | Confirmation |
| Restore | Confirmation |
| Duplicate | Confirmation (see Open Questions) |
| Delete | Confirmation, stronger when applications exist |

- Buttons come from a service-provided list of available actions per row. The row contains no status or deadline logic; it only renders the list. Actions that fail a condition are removed (or shown disabled with a reason where the user would otherwise be confused, such as locked edit).
- After any action, a single "job status changed" event fires. The table re-runs its normal query (a job that no longer matches the filter disappears) and the stat cards recount.
- If the last row on a page disappears, go back to the last valid page.

---

## 6. Notifications

| Trigger | Who is notified | Content |
|---|---|---|
| Job deleted (with applications) | Candidates with in-progress applications (new, reviewing, shortlisted, interview, offer) | Neutral: the position is no longer available |
| Block becomes final | Same set of candidates | One fixed template for all final blocks; no admin note included; support contact; candidates see a "Job removed" label, their application status is not rewritten |

Rejected, hired and withdrawn candidates are not notified. A normal (non-final) block notifies nobody, since the job may return.

---

## 7. Permissions

**To decide.** The rules above describe job state. Which roles (company owner, hiring manager) can use each action is a separate layer, and the existing docs disagree: `design.md` limits hiring managers to view/applications, while the role docs let them create, edit and close their own jobs. Resolve this before implementation and add a role-by-action table here.

---

## 8. Build Order and Acceptance Criteria

1. **Available-actions service (read-only).**
   - A draft returns Edit, Publish, Duplicate, Delete.
   - A closed job past its deadline does not return Reopen.
   - An active job with applications does not return Edit.
   - A blocked job returns no Delete and no Duplicate.
   - A final-blocked job returns nothing.
2. **Navigation actions** (View, View applications, Edit): each opens the right page; locked states explain why.
3. **Simple state changes** (Close, Reopen, Archive, Restore): status changes only when the rule passes; stale rows are rejected with a message; table and cards refresh.
4. **Publish, Duplicate, Delete:** publish requires a valid future deadline; duplicate produces a draft; delete is soft, warns when applications exist, and notifies in-progress candidates.
5. **Blocked flow:** depends on admin features; build last.

---

## 9. Open Questions

- **Publish confirmation and Duplicate feedback.** Current choice is toast for Publish and confirmation for Duplicate. Recommended change: confirm Publish (it fixes the deadline permanently and makes the job public) and use a toast with a link for Duplicate (it is harmless).
- Do withdrawn applications count toward the "zero applications" edit rule? Simplest: any application counts.
- How long does a trashed job stay restorable before the platform purges it?
- Optional, low priority: reminder to the company when an active job is close to its deadline (the deadline cannot be extended, but they can plan a Duplicate).
- Role permissions per action (section 7).
