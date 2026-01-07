# Requirements

## Functional Requirements

### FR-1: Daily Kin Consultation

#### FR-1.1
**Description**: The system must calculate and display the Kin corresponding to the current date

**Acceptance Criteria**:
- When user accesses homepage, today's Kin is displayed
- Date defaults to current date
- Kin information is accurate and complete

#### FR-1.2
**Description**: The user must be able to select any date from the interface to consult the Kin for that day

**Acceptance Criteria**:
- Date picker allows selection of any date
- Date picker is intuitive and easy to use
- Selected date triggers Kin calculation and display

#### FR-1.3
**Description**: The Kin information displayed must include solar seal, galactic tone, color, and relationships

**Acceptance Criteria**:
- Solar seal (Sello solar) is displayed
- Galactic tone (Tono galáctico) is displayed
- Color is displayed
- Guide (Guía) relationship is displayed
- Analog (Análogo) relationship is displayed
- Antipode (Antípoda) relationship is displayed
- Occult (Oculto) relationship is displayed

#### FR-1.4
**Description**: Extended Kin interpretation must be provided (minimum A4 page equivalent)

**Acceptance Criteria**:
- Interpretation text is comprehensive (minimum 500 words)
- Content is didactic and educational
- Personal application is included
- Professional quality writing
- No fake or placeholder content

#### FR-1.5
**Description**: Associated illustrations must be displayed

**Acceptance Criteria**:
- At least one illustration per Kin
- Illustrations are professional and respectful
- Images load efficiently
- Alt text provided for accessibility

#### FR-1.6
**Description**: The information must be visually attractive, professional, and accessible

**Acceptance Criteria**:
- Follows Material Design 3 guidelines
- WCAG AA compliant
- Clear visual hierarchy
- Consistent with design system

---

### FR-2: Encanted Wave Calculation

#### FR-2.1
**Description**: The system must calculate the Encanted Wave (Onda Encantada) for a given date

**Acceptance Criteria**:
- Onda calculation is accurate
- All 13 Kins in the wave are identified
- Each Kin has correct position (1-13)

#### FR-2.2
**Description**: The system must display the 13 associated Kins with their characteristics

**Acceptance Criteria**:
- All 13 Kins are displayed
- Each Kin shows its characteristics
- Position in wave is clear
- Grid or list layout is intuitive

#### FR-2.3
**Description**: The user must be able to select any date to show the corresponding Encanted Wave

**Acceptance Criteria**:
- Date picker allows selection of any date
- Selected date triggers Onda calculation
- Onda information updates immediately

#### FR-2.4
**Description**: Calculation must be based on defined logic from books and articles

**Acceptance Criteria**:
- Algorithm is documented
- Algorithm is testable
- Results are consistent
- Logic can be updated when new sources are added

---

### FR-3: User Management

#### FR-3.1
**Description**: Anonymous users can consult the daily Kin and access basic content

**Acceptance Criteria**:
- Homepage is accessible without login
- Kin detail page is accessible without login
- Onda Encantada page is accessible without login
- About and Help pages are accessible without login

#### FR-3.2
**Description**: Registered users can save important dates

**Acceptance Criteria**:
- Registered users see "Save" option on Kin and Onda pages
- Saved dates are stored in database
- Saved dates can be viewed in profile
- Saved dates can be deleted

#### FR-3.3
**Description**: Registered users can add reminders associated with specific dates

**Acceptance Criteria**:
- Registered users see "Add Reminder" option
- Reminders can have title, date, optional time, and description
- Reminders are stored in database
- Reminders can be viewed, edited, and deleted

#### FR-3.4
**Description**: Registration via email with OTP verification

**Acceptance Criteria**:
- Registration form collects email, password, and name
- OTP is sent to provided email
- OTP verification is required
- Email is marked as verified after successful OTP verification

#### FR-3.5
**Description**: Login with Google OAuth

**Acceptance Criteria**:
- "Sign in with Google" button is available
- OAuth flow works correctly
- User account is created or linked on successful OAuth
- User is logged in after OAuth completion

#### FR-3.6
**Description**: Authentication system based on JWT or sessions

**Acceptance Criteria**:
- User can login with email and password
- User can logout
- Authenticated state persists across page refreshes
- Protected routes redirect to login if not authenticated

---

### FR-4: Date Management

#### FR-4.1
**Description**: Registered users can mark dates as favorites or important

**Acceptance Criteria**:
- "Save to Favorites" button is available on Kin and Onda pages
- Saved dates appear in Favorites list
- Saved dates can be deleted

#### FR-4.2
**Description**: Reminders can be associated with marked dates

**Acceptance Criteria**:
- User can create reminder for any date
- Reminder is linked to specific date
- User can add notes to reminder

#### FR-4.3
**Description**: Possibility to receive email notifications in the future (later phase)

**Acceptance Criteria**:
- Placeholder for future email notification system
- Architecture supports future implementation
- Not implemented in MVP

---

## Non-Functional Requirements

### NFR-SEC: Security

#### NFR-SEC-1
**Description**: Secure authentication with OTP and OAuth (Google)

**Acceptance Criteria**:
- Passwords are hashed using bcrypt
- JWT tokens are properly signed and verified
- OTP codes are single-use and expire after reasonable time
- OAuth tokens are handled securely

#### NFR-SEC-2
**Description**: Data protection and privacy compliance

**Acceptance Criteria**:
- User data is stored securely
- User can delete their account and data
- GDPR-compliant data handling
- Privacy policy is available

#### NFR-SEC-3
**Description**: Secure API communication (HTTPS)

**Acceptance Criteria**:
- All API endpoints use HTTPS in production
- SSL/TLS certificates are valid
- HTTP to HTTPS redirect is configured

#### NFR-SEC-4
**Description**: Protection against common web vulnerabilities

**Acceptance Criteria**:
- CSRF protection is enabled
- XSS prevention is implemented
- SQL injection prevention through parameterized queries
- Rate limiting is implemented on authentication endpoints

---

### NFR-SCAL: Scalability

#### NFR-SCAL-1
**Description**: Structure prepared for future multi-language support

**Acceptance Criteria**:
- All text strings are externalized (no hardcoded strings)
- Date/time formats are locale-aware
- Architecture supports language switching
- No hardcoded assumptions about Spanish-only

#### NFR-SCAL-2
**Description**: Modular architecture for easy feature addition

**Acceptance Criteria**:
- Code is organized in modules
- Dependencies are injected
- New features can be added without major refactoring
- Clear separation of concerns

#### NFR-SCAL-3
**Description**: Database design optimized for growth

**Acceptance Criteria**:
- Proper indexing on frequently queried columns
- Efficient data types used
- Queries are optimized
- Database can handle growth to 100,000+ users

---

### NFR-RESP: Responsiveness

#### NFR-RESP-1
**Description**: Fully responsive design (mobile, tablet, desktop)

**Acceptance Criteria**:
- Design works on mobile devices (< 600px)
- Design works on tablet devices (600px - 900px)
- Design works on desktop devices (> 900px)
- Layout adapts appropriately to each breakpoint

#### NFR-RESP-2
**Description**: Optimized for mobile devices

**Acceptance Criteria**:
- Touch targets are minimum 44px
- No horizontal scrolling on mobile
- Images are optimized for mobile
- Load times are acceptable on mobile connections

#### NFR-RESP-3
**Description**: Touch-friendly interface

**Acceptance Criteria**:
- Buttons and interactive elements are large enough for touch
- Gestures are supported where appropriate
- No hover-dependent interactions on touch devices

---

### NFR-BACKEND: Backend

#### NFR-BACKEND-1
**Description**: PHP with Laravel framework

**Acceptance Criteria**:
- Laravel 11 or later is used
- Code follows Laravel best practices
- Laravel features are used appropriately (Eloquent, Migrations, etc.)

#### NFR-BACKEND-2
**Description**: MySQL database

**Acceptance Criteria**:
- MySQL 8.0 or later is used
- Database schema is normalized where appropriate
- Foreign key constraints are defined
- Indexes are used appropriately

#### NFR-BACKEND-3
**Description**: RESTful API architecture

**Acceptance Criteria**:
- API follows REST principles
- Proper HTTP methods are used (GET, POST, PUT, DELETE)
- Appropriate HTTP status codes are returned
- API is stateless

#### NFR-BACKEND-4
**Description**: API-only mode (no Blade views)

**Acceptance Criteria**:
- Laravel is configured for API-only mode
- No Blade templates are used for frontend
- All responses are JSON

---

### NFR-FRONTEND: Frontend

#### NFR-FRONTEND-1
**Description**: React framework

**Acceptance Criteria**:
- React 18 or later is used
- Functional components with Hooks are used
- Code follows React best practices

#### NFR-FRONTEND-2
**Description**: Material UI M3 (Material Design 3)

**Acceptance Criteria**:
- Material UI M3 is used for all UI components
- Custom components follow Material Design guidelines
- Theme is configurable

#### NFR-FRONTEND-3
**Description**: Single Page Application (SPA)

**Acceptance Criteria**:
- Client-side routing is used (React Router)
- Page transitions are smooth
- No full page reloads for navigation

#### NFR-FRONTEND-4
**Description**: No Tailwind CSS

**Acceptance Criteria**:
- Tailwind CSS is not used
- Material UI's built-in styling is used
- Custom CSS is minimal and follows design system

#### NFR-FRONTEND-5
**Description**: No TypeScript

**Acceptance Criteria**:
- JavaScript is used (not TypeScript)
- Prop types are not required
- Code quality is maintained through other means

---

### NFR-LANG: Language

#### NFR-LANG-1
**Description**: Initial language: Spanish

**Acceptance Criteria**:
- All user-facing text is in Spanish
- Content is in Spanish
- Date/time formats follow Spanish conventions

#### NFR-LANG-2
**Description**: Design prepared for internationalization (i18n)

**Acceptance Criteria**:
- Text strings are externalized
- Number/date formatting is locale-aware
- Architecture supports language switching

#### NFR-LANG-3
**Description**: Architecture ready for localization (l10n)

**Acceptance Criteria**:
- Text is separated from code
- Translations can be added without code changes
- RTL languages are supported (future)

---

### NFR-HOST: Hosting and Deployment

#### NFR-HOST-1
**Description**: VPS self-hosted environment

**Acceptance Criteria**:
- Application runs on VPS
- Server is properly configured
- Application is accessible via domain

#### NFR-HOST-2
**Description**: Custom domain assignment

**Acceptance Criteria**:
- Domain is purchased and configured
- DNS records point to server
- Application responds to domain

#### NFR-HOST-3
**Description**: HTTPS support (Let's Encrypt)

**Acceptance Criteria**:
- SSL/TLS certificate is installed
- HTTP redirects to HTTPS
- Certificate auto-renews

#### NFR-HOST-4
**Description**: Nginx or Apache as reverse proxy

**Acceptance Criteria**:
- Web server is configured as reverse proxy
- Static files are served efficiently
- API routes are proxied correctly

---

### NFR-PERF: Performance

#### NFR-PERF-1
**Description**: Fast loading times

**Acceptance Criteria**:
- First Contentful Paint < 2 seconds
- Time to Interactive < 3.5 seconds
- API response time < 500ms for 95% of requests

#### NFR-PERF-2
**Description**: Optimized for mobile devices

**Acceptance Criteria**:
- Page size is minimized (< 1MB)
- Images are optimized and lazy-loaded
- JavaScript is minified and split

#### NFR-PERF-3
**Description**: Efficient API response times

**Acceptance Criteria**:
- API responses are < 500ms for most endpoints
- Complex endpoints (< 1 second) are documented
- Caching is used where appropriate

#### NFR-PERF-4
**Description**: Image optimization

**Acceptance Criteria**:
- Images are compressed
- Responsive images with srcset
- WebP format with fallbacks
- Lazy loading for below-fold images

---

### NFR-QUAL: Quality

#### NFR-QUAL-1
**Description**: Professional content

**Acceptance Criteria**:
- Content is professionally written
- No typos or grammatical errors
- Content is accurate and well-researched

#### NFR-QUAL-2
**Description**: Rigorous and validated information

**Acceptance Criteria**:
- Kin calculations are verified
- Onda calculations are verified
- Content is validated against authoritative sources

#### NFR-QUAL-3
**Description**: Accurate Kin and Encanted Wave calculations

**Acceptance Criteria**:
- Calculations match authoritative sources
- Calculations are testable
- Algorithm is documented

#### NFR-QUAL-4
**Description**: Extensive and relevant information provided

**Acceptance Criteria**:
- Kin descriptions are comprehensive (minimum 500 words)
- Multiple perspectives are provided where applicable
- Content is relevant and useful to users
- No placeholder or fake content
