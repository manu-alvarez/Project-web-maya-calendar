# Workflows

## User Workflow Overview

This document describes the key user workflows and their interactions with the system.

---

## Workflow 1: Anonymous User - Consult Today's Kin

### Description
User visits the site and wants to see today's Kin without logging in.

### Steps

1. **User Access**
   - User navigates to homepage (`/`)
   - System loads today's date
   - System fetches today's Kin from API

2. **API Call**
   - Frontend: `GET /api/kin/today`
   - Backend: Calculates today's Kin
   - Backend: Fetches Kin data from database
   - Backend: Returns Kin information

3. **Display**
   - Frontend receives Kin data
   - Frontend displays Kin information
   - User sees: solar seal, tone, color, relationships
   - User can read: description, interpretation, personal application

4. **Actions Available**
   - User can navigate to other dates
   - User can view Encanted Wave for today
   - User sees call-to-action to register (subtle)

### Success Criteria
- Today's Kin is displayed correctly
- All Kin information is complete and accurate
- User can navigate to other dates
- No authentication required

### Error Handling
- If API fails: Show error message, retry option
- If no Kin data found: Show friendly message, contact support

---

## Workflow 2: User - Consult Kin for Specific Date

### Description
User wants to consult the Kin for a specific date (e.g., birthday, anniversary).

### Steps

1. **User Selects Date**
   - User navigates to Kin detail page (`/kin/:date`) or uses date picker on homepage
   - User selects desired date using date picker
   - Date format: YYYY-MM-DD

2. **API Call**
   - Frontend: `GET /api/kin/{date}`
   - Backend: Validates date format
   - Backend: Calculates Kin for selected date
   - Backend: Fetches Kin data from database
   - Backend: Returns Kin information

3. **Display**
   - Frontend receives Kin data
   - Frontend displays Kin information
   - User sees all Kin details

4. **Actions Available (Anonymous)**
   - View Kin details
   - Navigate to Encanted Wave for this date
   - Select different date
   - See call-to-action to register

5. **Actions Available (Registered)**
   - All anonymous actions
   - Save date as favorite
   - Set reminder for this date

### Success Criteria
- Kin for selected date is displayed correctly
- Date picker is intuitive
- User can navigate between dates easily

### Error Handling
- Invalid date format: Show error, suggest correct format
- Date out of range: Show friendly message
- API failure: Show error message, retry option

---

## Workflow 3: User - View Encanted Wave

### Description
User wants to see the 13-Kin Encanted Wave for a specific date.

### Steps

1. **User Selects Date**
   - User navigates to Onda page (`/onda/:date`) or selects from homepage
   - User selects desired date

2. **API Call**
   - Frontend: `GET /api/onda/{date}`
   - Backend: Validates date format
   - Backend: Calculates Encanted Wave for date
   - Backend: Fetches all 13 Kins in the wave
   - Backend: Returns Onda and Kins data

3. **Display**
   - Frontend receives Onda data
   - Frontend displays 13-Kin grid
   - Each Kin shows: position, seal, tone, color
   - User can click each Kin for details

4. **Expand Details**
   - User clicks on a Kin in the wave
   - Modal or expandable section shows detailed Kin information
   - User can see: description, interpretation, relationships

5. **Actions Available (Anonymous)**
   - View Onda overview
   - View details for each Kin
   - Select different date
   - Navigate to specific Kin page

6. **Actions Available (Registered)**
   - All anonymous actions
   - Save Onda as favorite
   - Set reminder for Onda start date

### Success Criteria
- All 13 Kins are displayed in correct order
- Each Kin shows correct position (1-13)
- User can view details for each Kin
- Wave calculation is accurate

### Error Handling
- Invalid date format: Show error, suggest correct format
- API failure: Show error message, retry option
- Missing Kin data: Show partial data with warning

---

## Workflow 4: New User - Register with Email

### Description
New user wants to create an account using email and password.

### Steps

1. **User Accesses Registration**
   - User navigates to `/registro`
   - System displays registration form

2. **User Fills Form**
   - User enters: email, password, password confirmation, name
   - System validates form in real-time
   - System shows validation errors (if any)

3. **User Submits Form**
   - User clicks "Register" button
   - Frontend: `POST /api/register`
   - Backend: Validates input
   - Backend: Hashes password with bcrypt
   - Backend: Creates user account
   - Backend: Generates OTP
   - Backend: Sends OTP to user's email
   - Backend: Returns success message

4. **User Verifies Email**
   - User receives OTP in email
   - User navigates to verification page (or sees it after registration)
   - User enters OTP code
   - Frontend: `POST /api/verify-otp`
   - Backend: Validates OTP
   - Backend: Marks email as verified
   - Backend: Returns JWT token
   - Frontend stores token
   - User is logged in

5. **Post-Registration**
   - User is redirected to homepage or onboarding
   - User sees welcome message
   - User can now access registered features

### Success Criteria
- User account is created
- OTP is sent to user's email
- User can verify email with OTP
- User is logged in after verification
- JWT token is valid and stored

### Error Handling
- Invalid email format: Show inline error
- Password too weak: Show inline error with requirements
- Email already exists: Show error, offer login option
- OTP incorrect: Show error, allow retry
- OTP expired: Resend option

---

## Workflow 5: User - Login with Google OAuth

### Description
User wants to login or register using their Google account.

### Steps

1. **User Clicks Google Login**
   - User clicks "Sign in with Google" button on login page
   - Frontend: `GET /api/google/redirect?redirect_uri=...`
   - Backend: Redirects to Google OAuth consent page

2. **User Authorizes**
   - User sees Google consent screen
   - User reviews permissions requested
   - User clicks "Authorize"

3. **Google Redirects Back**
   - Google redirects back to callback URL with authorization code
   - Frontend: `GET /api/google/callback?code=...&state=...`
   - Backend: Validates state token
   - Backend: Exchanges authorization code for access token
   - Backend: Fetches user information from Google
   - Backend: Checks if user exists by Google ID
   - Backend: If user exists, logs them in
   - Backend: If user doesn't exist, creates new account
   - Backend: Generates JWT token
   - Backend: Returns token and user data

4. **User Logged In**
   - Frontend receives token
   - Frontend stores token
   - User is logged in
   - User is redirected to homepage

### Success Criteria
- Google OAuth flow works correctly
- Existing users are logged in
- New users are created automatically
- JWT token is valid and stored
- User is redirected appropriately

### Error Handling
- OAuth error: Show error message, offer alternative login
- User denies permission: Show message, offer alternative login
- Google API error: Show error message, offer alternative login

---

## Workflow 6: User - Login with Email/Password

### Description
Registered user wants to login with their email and password.

### Steps

1. **User Accesses Login**
   - User navigates to `/login`
   - System displays login form

2. **User Fills Form**
   - User enters: email, password
   - User optionally checks "Remember me"

3. **User Submits Form**
   - User clicks "Login" button
   - Frontend: `POST /api/login`
   - Backend: Validates input
   - Backend: Finds user by email
   - Backend: Verifies password hash
   - Backend: Checks if email is verified
   - Backend: Generates JWT token
   - Backend: Returns token and user data

4. **User Logged In**
   - Frontend receives token
   - Frontend stores token (localStorage or cookies)
   - If "Remember me" checked, token persists longer
   - User is redirected to homepage or previous page

### Success Criteria
- User can login with correct credentials
- Password verification works
- JWT token is valid and stored
- "Remember me" functionality works
- Unverified users cannot login

### Error Handling
- Invalid email: Show error
- Invalid password: Show error
- Email not verified: Show error, offer resend verification
- Account not found: Show error, offer registration

---

## Workflow 7: Registered User - Save Date as Favorite

### Description
Registered user wants to save a date as a favorite.

### Steps

1. **User Views Kin or Onda**
   - User is viewing Kin detail or Onda page
   - User sees "Save to Favorites" button

2. **User Clicks Save**
   - User clicks "Save to Favorites" button
   - If already saved, button shows "Remove from Favorites"
   - Frontend: `POST /api/user/saved-dates`
   - Frontend sends: `fecha`, optional `nota`
   - Backend: Authenticates user via JWT
   - Backend: Creates FechaGuardada record
   - Backend: Returns success message

3. **Confirmation**
   - Button changes to "Saved ✓"
   - Success message appears (snackbar)
   - User can now view saved dates in profile

### Success Criteria
- Date is saved to database
- User sees confirmation
- Saved date appears in Favorites list
- Duplicate dates are prevented or handled gracefully

### Error Handling
- Not authenticated: Redirect to login
- Invalid date: Show error
- API failure: Show error, offer retry

---

## Workflow 8: Registered User - Create Reminder

### Description
Registered user wants to set a reminder for a specific date.

### Steps

1. **User Opens Reminder Form**
   - User is viewing Kin or Onda page
   - User clicks "Add Reminder" button
   - Modal or form opens

2. **User Fills Form**
   - User enters: titulo (required)
   - User enters: fecha (pre-filled with current date)
   - User optionally enters: hora
   - User optionally enters: descripcion

3. **User Submits Form**
   - User clicks "Save Reminder" button
   - Frontend: `POST /api/user/reminders`
   - Frontend sends: titulo, fecha, optional hora, descripcion
   - Backend: Authenticates user via JWT
   - Backend: Creates Recordatorio record
   - Backend: Returns success message

4. **Confirmation**
   - Form closes
   - Success message appears (snackbar)
   - User can now view reminder in profile

### Success Criteria
- Reminder is saved to database
- User sees confirmation
- Reminder appears in Reminders list
- User can edit or delete reminder later

### Error Handling
- Not authenticated: Redirect to login
- Invalid input: Show inline errors
- API failure: Show error, offer retry

---

## Workflow 9: Registered User - View Profile

### Description
Registered user wants to view their profile, saved dates, and reminders.

### Steps

1. **User Accesses Profile**
   - User clicks "Profile" in navigation
   - User navigates to `/perfil`

2. **Profile Sections**
   - User sees: User information (name, email)
   - User sees: Saved dates list
   - User sees: Reminders list
   - User sees: Edit profile option

3. **View Saved Dates**
   - User sees list of saved dates
   - User can filter by month
   - User can sort by date or creation
   - User can click on date to view Kin/Onda
   - User can delete saved dates

4. **View Reminders**
   - User sees list of reminders
   - User can filter by status (upcoming, completed)
   - User can sort by date or creation
   - User can edit reminders
   - User can delete reminders

5. **Edit Profile**
   - User clicks "Edit Profile"
   - User sees form to update: name, email
   - User submits form
   - Profile is updated

### Success Criteria
- All user data is displayed correctly
- Saved dates are listed with filters
- Reminders are listed with filters
- User can edit profile
- User can delete saved dates and reminders

### Error Handling
- Not authenticated: Redirect to login
- API failure: Show error, offer retry

---

## Workflow 10: User - Logout

### Description
User wants to logout from their account.

### Steps

1. **User Clicks Logout**
   - User clicks "Logout" in navigation

2. **Frontend Logout**
   - Frontend: `POST /api/logout`
   - Frontend: Removes JWT token from storage
   - Frontend: Clears user state from context

3. **Backend Logout**
   - Backend: Invalidates token (if using token blacklist)
   - Backend: Returns success message

4. **Redirect**
   - User is redirected to homepage
   - User sees anonymous user interface
   - Navigation shows "Login" instead of "Logout"

### Success Criteria
- User is logged out
- Token is removed
- User sees anonymous interface
- Protected routes redirect to login

### Error Handling
- API failure: Still clear local token, show warning

---

## System Workflows

### Workflow 11: Kin Calculation

### Description
Backend calculates Kin for any given date.

### Steps

1. **Receive Date**
   - API receives date parameter
   - Validates date format (YYYY-MM-DD)

2. **Calculate Kin Number**
   - Calculate days from reference date (e.g., 2024-01-01 = Kin 1)
   - Apply modulo 260 (number of Kins in Tzolkin)
   - Get Kin number

3. **Fetch Kin Data**
   - Query database for Kin by kin_number
   - Eager load: guide, analog, antipode, occult relationships

4. **Return Data**
   - Return JSON with Kin information
   - Include: kin_number, solar_seal, galactic_tone, color, relationships

### Success Criteria
- Kin number is calculated correctly
- All Kin data is returned
- Relationships are included

### Error Handling
- Invalid date format: Return 400 error
- Kin not found: Return 404 error

---

### Workflow 12: Encanted Wave Calculation

### Description
Backend calculates Encanted Wave for any given date.

### Steps

1. **Receive Date**
   - API receives date parameter
   - Validates date format (YYYY-MM-DD)

2. **Calculate Onda Number**
   - Calculate Kin for date
   - Determine Onda based on Kin number and tone

3. **Fetch Onda Data**
   - Query database for Onda by onda_number
   - Eager load: purpose, challenge, service Kins
   - Eager load: All 13 OndaKins with their Kins

4. **Return Data**
   - Return JSON with Onda information
   - Include: onda_number, purpose, challenge, service, all 13 Kins

### Success Criteria
- Onda is calculated correctly
- All 13 Kins are returned in correct order
- Onda relationships are included

### Error Handling
- Invalid date format: Return 400 error
- Onda not found: Return 404 error

---

## Error Recovery Workflows

### Workflow 13: API Failure Recovery

### Description
System recovers from API failures gracefully.

### Steps

1. **API Call Fails**
   - Frontend detects API error (network, 500, etc.)
   - Frontend shows user-friendly error message
   - Frontend offers retry option

2. **User Retries**
   - User clicks "Retry"
   - Frontend retries API call
   - If successful, proceed normally
   - If fails again, show contact support option

3. **Offline Handling (Future)**
   - Frontend detects offline status
   - Shows offline indicator
   - Caches responses where possible
   - Syncs when back online

### Success Criteria
- User sees clear error messages
- User can retry failed operations
- System doesn't crash on API failures

---

## Admin Workflows (Future)

### Workflow 14: Admin - Manage Content
### Workflow 15: Admin - Manage Users
### Workflow 16: Admin - View Analytics

These workflows are not part of MVP but are planned for future phases.
