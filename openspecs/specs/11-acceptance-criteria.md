# Acceptance Criteria

## Feature 1: Daily Kin Consultation

### AC-1.1: Homepage Displays Today's Kin
**Given** I am an anonymous or registered user
**When** I navigate to the homepage (`/`)
**Then** I should see today's Kin displayed prominently
**And** The Kin should include: solar seal, galactic tone, color, and relationships
**And** The information should be accurate and complete

**Acceptance Tests**:
- [ ] Homepage loads without errors
- [ ] Today's date is calculated correctly
- [ ] Kin data is fetched successfully
- [ ] Kin information is displayed correctly
- [ ] All Kin relationships are visible

---

### AC-1.2: User Can Select Any Date
**Given** I am viewing the Kin page
**When** I select a date using the date picker
**Then** The Kin for that date should be displayed
**And** The date should be updated in the URL
**And** The Kin information should refresh without page reload

**Acceptance Tests**:
- [ ] Date picker is visible and functional
- [ ] Date picker allows selection of any valid date
- [ ] Selecting a date updates the Kin display
- [ ] URL updates with selected date
- [ ] No full page reload occurs

---

### AC-1.3: Kin Information is Complete
**Given** I am viewing a Kin detail page
**When** The page has loaded
**Then** I should see: solar seal, galactic tone, color
**And** I should see: guide, analog, antipode, occult relationships
**And** I should see: description, interpretation, personal application
**And** I should see: at least one illustration

**Acceptance Tests**:
- [ ] All required fields are displayed
- [ ] Description is present and not empty
- [ ] Interpretation is present and not empty
- [ ] Personal application is present and not empty
- [ ] At least one illustration is visible
- [ ] No placeholder or fake content is present

---

## Feature 2: Encanted Wave Calculation

### AC-2.1: Onda Displays All 13 Kins
**Given** I am viewing an Encanted Wave page
**When** The page has loaded
**Then** I should see all 13 Kins in the wave
**And** Each Kin should show: position, solar seal, galactic tone, color
**And** The Kins should be displayed in correct order (1-13)

**Acceptance Tests**:
- [ ] Exactly 13 Kins are displayed
- [ ] Each Kin has a position number (1-13)
- [ ] Positions are in correct order
- [ ] Each Kin shows solar seal
- [ ] Each Kin shows galactic tone
- [ ] Each Kin shows color

---

### AC-2.2: User Can View Detailed Kin Information
**Given** I am viewing an Encanted Wave page
**When** I click on a Kin in the wave
**Then** A modal or expandable section should appear
**And** It should show detailed information about that Kin
**And** I should be able to close the modal/section

**Acceptance Tests**:
- [ ] Clicking a Kin opens detailed view
- [ ] Detailed view shows all Kin information
- [ ] Close button is visible and functional
- [ ] Multiple Kins can be viewed sequentially
- [ ] Detailed view is responsive

---

### AC-2.3: Onda Calculation is Accurate
**Given** I select a specific date
**When** The Encanted Wave is calculated
**Then** The wave should match the authoritative Maya calendar
**And** All 13 Kins should be correct for that date

**Acceptance Tests**:
- [ ] Wave number is calculated correctly
- [ ] Purpose Kin is correct
- [ ] Challenge Kin is correct
- [ ] Service Kin is correct
- [ ] All 13 Kins are in correct positions
- [ ] Calculation matches authoritative sources

---

## Feature 3: User Management

### AC-3.1: User Can Register with Email
**Given** I am a new user
**When** I navigate to the registration page
**And** I fill in: email, password, password confirmation, name
**And** I click "Register"
**Then** I should receive an email with OTP
**And** I should see a message asking me to verify my email
**And** My account should be created but unverified

**Acceptance Tests**:
- [ ] Registration form is accessible
- [ ] Form validation works in real-time
- [ ] Password strength requirements are enforced
- [ ] Registration creates user account
- [ ] OTP is sent to user's email
- [ ] Success message is displayed
- [ ] User is not logged in yet

---

### AC-3.2: User Can Verify Email with OTP
**Given** I have registered but not verified my email
**When** I enter the OTP code I received
**And** I click "Verify"
**Then** My email should be marked as verified
**And** I should be logged in
**And** I should receive a JWT token
**And** I should see a welcome message

**Acceptance Tests**:
- [ ] OTP verification page is accessible
- [ ] Valid OTP verifies email successfully
- [ ] User is logged in after verification
- [ ] JWT token is stored
- [ ] User is redirected appropriately
- [ ] Email is marked as verified in database

---

### AC-3.3: User Can Login with Google OAuth
**Given** I am a new or existing user
**When** I click "Sign in with Google"
**Then** I should be redirected to Google's consent page
**And** After authorizing, I should be redirected back to the app
**And** I should be logged in (new account created if needed)
**And** I should receive a JWT token

**Acceptance Tests**:
- [ ] Google login button is visible
- [ ] User is redirected to Google OAuth
- [ ] Google consent page displays correctly
- [ ] OAuth callback works correctly
- [ ] Existing users are logged in
- [ ] New users are created automatically
- [ ] User is logged in after OAuth
- [ ] JWT token is valid

---

### AC-3.4: User Can Login with Email/Password
**Given** I am a registered user with verified email
**When** I enter my email and password
**And** I click "Login"
**Then** I should be logged in
**And** I should receive a JWT token
**And** I should be redirected to the homepage

**Acceptance Tests**:
- [ ] Login form is accessible
- [ ] Valid credentials log user in
- [ ] Invalid credentials show error
- [ ] Unverified users cannot login
- [ ] JWT token is stored
- [ ] User is redirected appropriately
- [ ] "Remember me" works correctly

---

### AC-3.5: User Can Logout
**Given** I am logged in
**When** I click "Logout"
**Then** I should be logged out
**And** My JWT token should be removed
**And** I should see the anonymous user interface
**And** I should be redirected to the homepage

**Acceptance Tests**:
- [ ] Logout button is visible
- [ ] Logout removes JWT token
- [ ] User is redirected to homepage
- [ ] Anonymous interface is displayed
- [ ] Protected routes redirect to login

---

## Feature 4: Date Management

### AC-4.1: Registered User Can Save Date
**Given** I am a registered user viewing a Kin or Onda page
**When** I click "Save to Favorites"
**And** I optionally add a note
**And** I submit the form
**Then** The date should be saved to my favorites
**And** I should see a confirmation message
**And** The button should change to indicate it's saved

**Acceptance Tests**:
- [ ] "Save to Favorites" button is visible to registered users
- [ ] Form accepts optional note
- [ ] Date is saved to database
- [ ] Confirmation message appears
- [ ] Button state updates to show saved
- [ ] Date appears in Favorites list

---

### AC-4.2: Registered User Can Create Reminder
**Given** I am a registered user viewing a Kin or Onda page
**When** I click "Add Reminder"
**And** I fill in: titulo (required), fecha (pre-filled), optional hora, optional descripcion
**And** I submit the form
**Then** The reminder should be created
**And** I should see a confirmation message
**And** The reminder should appear in my Reminders list

**Acceptance Tests**:
- [ ] "Add Reminder" button is visible to registered users
- [ ] Form validates required fields
- [ ] Date is pre-filled with current date
- [ ] Time field is optional
- [ ] Description field is optional
- [ ] Reminder is created in database
- [ ] Confirmation message appears
- [ ] Reminder appears in Reminders list

---

### AC-4.3: User Can View Saved Dates
**Given** I am a registered user
**When** I navigate to my profile
**Then** I should see a list of my saved dates
**And** I should be able to filter by month
**And** I should be able to sort by date or creation time
**And** I should be able to click on a date to view its Kin/Onda
**And** I should be able to delete saved dates

**Acceptance Tests**:
- [ ] Saved dates list is accessible
- [ ] All saved dates are displayed
- [ ] Filter by month works correctly
- [ ] Sort options work correctly
- [ ] Clicking date navigates to Kin/Onda page
- [ ] Delete option is available
- [ ] Delete removes date from list and database

---

### AC-4.4: User Can View Reminders
**Given** I am a registered user
**When** I navigate to my profile
**Then** I should see a list of my reminders
**And** I should be able to filter by status (upcoming, completed)
**And** I should be able to sort by date or creation time
**And** I should be able to edit reminders
**And** I should be able to delete reminders

**Acceptance Tests**:
- [ ] Reminders list is accessible
- [ ] All reminders are displayed
- [ ] Filter by status works correctly
- [ ] Sort options work correctly
- [ ] Edit option is available
- [ ] Edit updates reminder correctly
- [ ] Delete option is available
- [ ] Delete removes reminder from list and database

---

## Non-Functional Acceptance Criteria

### AC-NFR-SEC-1: Secure Authentication
**Given** The system is in production
**When** A user logs in
**Then** Passwords should be hashed with bcrypt
**And** JWT tokens should be properly signed and verified
**And** OTP codes should be single-use and expire after reasonable time

**Acceptance Tests**:
- [ ] Passwords are hashed (not stored in plain text)
- [ ] JWT tokens verify correctly
- [ ] JWT tokens expire after configured time
- [ ] OTP codes can be used only once
- [ ] OTP codes expire after configured time

---

### AC-NFR-RESP-1: Fully Responsive Design
**Given** The application is running
**When** I view the application on mobile (< 600px)
**Then** The layout should adapt to mobile screen
**And** All features should be accessible
**And** Touch targets should be at least 44px

**Acceptance Tests**:
- [ ] Layout works on mobile devices
- [ ] Layout works on tablet devices
- [ ] Layout works on desktop devices
- [ ] No horizontal scrolling on mobile
- [ ] Touch targets are minimum 44px
- [ ] All features are accessible on all devices

---

### AC-NFR-PERF-1: Fast Loading Times
**Given** The application is running
**When** A user loads the homepage
**Then** The First Contentful Paint should be under 2 seconds
**And** The Time to Interactive should be under 3.5 seconds
**And** API responses should be under 500ms for 95% of requests

**Acceptance Tests**:
- [ ] FCP < 2 seconds
- [ ] TTI < 3.5 seconds
- [ ] API responses < 500ms (95th percentile)
- [ ] Page size is optimized (< 1MB)
- [ ] Images are optimized

---

### AC-NFR-QUAL-1: Professional Content
**Given** I am viewing a Kin detail page
**When** The page has loaded
**Then** The content should be professionally written
**And** There should be no typos or grammatical errors
**And** The content should be accurate and well-researched
**And** No placeholder or fake content should be present

**Acceptance Tests**:
- [ ] Content is professionally written
- [ ] No typos are present
- [ ] No grammatical errors are present
- [ ] Content is accurate
- [ ] No placeholder content is present
- [ ] No fake content is present
- [ ] Content meets minimum length requirements

---

## General Acceptance Criteria

### AC-GEN-1: Error Handling
**Given** An error occurs in the system
**When** The error happens
**Then** A user-friendly error message should be displayed
**And** The system should not crash
**And** User should be able to retry the operation

**Acceptance Tests**:
- [ ] API errors show user-friendly messages
- [ ] Network errors show user-friendly messages
- [ ] Validation errors show inline messages
- [ ] System does not crash on errors
- [ ] Retry options are available
- [ ] Contact support option is available

---

### AC-GEN-2: Accessibility
**Given** The application is running
**When** A user interacts with the application
**Then** The application should be WCAG AA compliant
**And** All interactive elements should be keyboard accessible
**And** Screen readers should be able to read the content

**Acceptance Tests**:
- [ ] Color contrast meets WCAG AA standards
- [ ] All interactive elements are keyboard accessible
- [ ] Focus states are clearly visible
- [ ] ARIA labels are present where needed
- [ ] Alt text is present for images
- [ ] Screen reader can navigate the application

---

### AC-GEN-3: Browser Compatibility
**Given** The application is running
**When** I access the application in different browsers
**Then** The application should work correctly in all modern browsers
**And** The layout should be consistent across browsers

**Acceptance Tests**:
- [ ] Application works in Chrome
- [ ] Application works in Firefox
- [ ] Application works in Safari
- [ ] Application works in Edge
- [ ] Layout is consistent across browsers
- [ ] Functionality is consistent across browsers

---

## Definition of Done

A feature is considered "Done" when:

1. **All acceptance criteria are met** - Every AC has corresponding tests that pass
2. **Code is reviewed** - Code has been reviewed and approved
3. **Tests are written and passing** - Unit tests, integration tests, and E2E tests
4. **Documentation is updated** - API documentation, code comments, and user documentation
5. **No critical bugs** - No P0 or P1 bugs remain
6. **Performance requirements met** - All performance ACs are met
7. **Accessibility requirements met** - All accessibility ACs are met
8. **Security requirements met** - All security ACs are met
9. **Deployed to staging** - Feature is deployed and tested in staging
10. **Stakeholder approval** - Product owner has reviewed and approved

---

## Test Cases

### Test Case 1: Anonymous User Views Today's Kin
1. Open browser and navigate to homepage
2. Verify today's Kin is displayed
3. Verify all Kin information is present
4. Verify Kin relationships are displayed
5. Verify illustrations are present
6. Verify no authentication required

**Expected Result**: User sees today's complete Kin information

---

### Test Case 2: User Registers and Verifies Email
1. Navigate to registration page
2. Fill in valid email, password, password confirmation, and name
3. Submit registration form
4. Verify success message is displayed
5. Check email inbox for OTP
6. Navigate to verification page
7. Enter OTP code
8. Verify email is verified and user is logged in

**Expected Result**: User is registered, verified, and logged in

---

### Test Case 3: User Saves Date as Favorite
1. Login with registered user
2. Navigate to Kin detail page for a specific date
3. Click "Save to Favorites"
4. Optionally add a note
5. Submit form
6. Verify confirmation message is displayed
7. Navigate to profile
8. Verify date appears in Saved Dates list

**Expected Result**: Date is saved and appears in favorites list

---

### Test Case 4: User Views Encanted Wave
1. Navigate to Onda page for a specific date
2. Verify 13 Kins are displayed
3. Verify each Kin has correct position (1-13)
4. Click on a Kin in the wave
5. Verify detailed view appears
6. Close detailed view
7. Select a different date
8. Verify wave updates correctly

**Expected Result**: User can view and interact with Encanted Wave

---

## Metrics and KPIs

### User Experience Metrics
- **Task Completion Rate**: Percentage of users who successfully complete key tasks
- **Time on Task**: Average time to complete key tasks
- **Error Rate**: Percentage of actions that result in errors
- **User Satisfaction**: NPS score from user surveys

### Performance Metrics
- **Page Load Time**: Average time to load key pages
- **API Response Time**: Average API response time
- **Uptime**: Percentage of time the system is available
- **Error Rate**: Percentage of API calls that fail

### Business Metrics
- **Registration Rate**: Percentage of anonymous users who register
- **Active Users**: Number of active registered users
- **Feature Adoption**: Percentage of registered users using features
- **Retention Rate**: Percentage of users who return after first visit
