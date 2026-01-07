# Features

## Feature 1: Daily Kin Consultation

### Description
Users can consult the Kin (Maya calendar day sign) for any date, including today's date.

### User Stories
- As an anonymous user, I want to see today's Kin on the homepage
- As a user, I want to select any date to see its Kin
- As a user, I want to navigate between dates easily
- As a registered user, I want to save a Kin as a favorite
- As a registered user, I want to set a reminder for a specific date's Kin

### Functional Requirements
- System calculates Kin for any given date
- Display includes: solar seal, galactic tone, color, guide, analog, antipode, occult
- Extended interpretation provided (minimum A4 page equivalent)
- Professional illustrations included
- Date picker with calendar interface
- Navigation between consecutive dates

### Dependencies
- Kin calculation algorithm
- Kin data repository
- Date picker component

---

## Feature 2: Encanted Wave Calculation

### Description
Users can view the 13-Kin Encanted Wave (Onda Encantada) for any date.

### User Stories
- As a user, I want to see the Encanted Wave for today
- As a user, I want to see the Encanted Wave for any selected date
- As a user, I want to understand how the 13 Kins relate in the wave
- As a registered user, I want to save an Encanted Wave as a favorite
- As a registered user, I want to set a reminder for the start of an Encanted Wave

### Functional Requirements
- System calculates the 13 Kins in the Encanted Wave for any date
- Display shows all 13 Kins in sequence
- Each Kin shows its characteristics and position
- Context and interpretation provided for the wave
- Date selector interface
- Navigation between waves

### Dependencies
- Encanted Wave calculation algorithm
- Onda data repository
- Kin data repository
- Date picker component

---

## Feature 3: User Management

### Description
System supports both anonymous and registered users with different access levels.

### User Stories
- As a new user, I want to register with my email
- As a new user, I want to verify my email with OTP
- As a new user, I want to register with my Google account
- As a returning user, I want to login with email/password
- As a returning user, I want to login with my Google account
- As a registered user, I want to manage my profile
- As a registered user, I want to logout

### Functional Requirements
- Email registration with OTP verification
- Google OAuth integration
- Session management (JWT or session-based)
- User profile creation and editing
- Password reset functionality
- Logout functionality

### Dependencies
- Authentication service
- Email service (OTP)
- Google OAuth provider
- User database model

---

## Feature 4: Date Management

### Description
Registered users can save important dates and set reminders.

### User Stories
- As a registered user, I want to save a date as important/favorite
- As a registered user, I want to add notes to saved dates
- As a registered user, I want to view all my saved dates
- As a registered user, I want to delete saved dates
- As a registered user, I want to set a reminder for a specific date
- As a registered user, I want to manage my reminders (edit, delete)

### Functional Requirements
- Save date with optional notes
- List saved dates with filtering and sorting
- Delete saved dates
- Create reminders with title, date, optional time and description
- List reminders with filtering and sorting
- Edit and delete reminders
- Mark reminders as completed

### Dependencies
- Authentication
- Saved dates database model
- Reminders database model

---

## Feature 5: Content Display

### Description
Professional display of Kin and Encanted Wave information with didactic content.

### User Stories
- As a user, I want to see clear, professional presentation of Kin information
- As a user, I want to understand the meaning of each Kin characteristic
- As a user, I want to see visual representations of Kins
- As a user, I want to read extended interpretations that help me apply the knowledge

### Functional Requirements
- Professional visual design following Material Design 3
- Clear hierarchy of information
- Didactic explanations for each characteristic
- Multiple illustrations where appropriate
- Print-friendly layout
- Responsive design for all devices

### Dependencies
- Design system implementation
- Content database
- Image/media assets

---

## Feature 6: Authentication & Authorization

### Description
Secure authentication system with multiple login methods and appropriate authorization.

### User Stories
- As a developer, I want secure authentication flows
- As a developer, I want proper protection of API endpoints
- As a user, I want my data to be secure
- As a user, I want to stay logged in across sessions

### Functional Requirements
- Secure password hashing
- JWT or session-based authentication
- Protected routes for registered user features
- CSRF protection
- Rate limiting for login attempts
- Secure session management

### Dependencies
- Laravel Sanctum or similar
- Middleware implementation
- Security best practices

---

## MVP Feature Prioritization

### Must Have (P0)
- Daily Kin consultation
- Encanted Wave calculation
- User registration (email + OTP)
- User login (email + Google OAuth)
- Save dates (registered users)
- Basic reminders (registered users)

### Should Have (P1)
- User profile management
- Password reset
- Reminder management (edit, delete, mark complete)
- Extended Kin interpretations
- Saved date notes

### Could Have (P2)
- Advanced filtering for saved dates
- Reminder notifications (email - future phase)
- Export saved dates
- User preferences

### Won't Have (MVP)
- Email notifications for reminders (future phase)
- Social sharing features
- User-generated content
- Community features
- Payment/subscription system
- Multi-language support (future phase)
