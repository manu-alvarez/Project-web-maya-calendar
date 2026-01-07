# Requirements

## Functional Requirements

### Feature 1: Daily Kin Consultation

**FR-1.1**: The system must calculate and display the Kin corresponding to the current date

**FR-1.2**: The user must be able to select any date from the interface to consult the Kin for that day

**FR-1.3**: The Kin information displayed must include:
- Solar seal (Sello solar)
- Galactic tone (Tono galáctico)
- Color
- Relationship with: guide, analog, antipode, occult

**FR-1.4**: Extended Kin interpretation must be provided:
- Didactic description (minimum equivalent to one A4 page)
- Personal application
- Professional quality content

**FR-1.5**: Associated illustrations must be displayed (images or icons according to future design)

**FR-1.6**: The information must be visually attractive, professional, and accessible

### Feature 2: Encanted Wave Calculation

**FR-2.1**: The system must calculate the Encanted Wave (Onda Encantada) for a given date

**FR-2.2**: The system must display:
- The 13 associated Kins
- Their characteristics
- Interpretations and context

**FR-2.3**: The user must be able to select any date to show the corresponding Encanted Wave

**FR-2.4**: This calculation must be based on logic defined from books and articles (to be uploaded later)

### Feature 3: User Management

**FR-3.1**: Anonymous users can:
- Consult the daily Kin
- Access basic content
- View general information

**FR-3.2**: Registered users can:
- Save important dates
- Add reminders associated with specific dates
- Access extended content if available

**FR-3.3**: Registration methods:
- Email + OTP (One Time Password) verification
- Google OAuth login

**FR-3.4**: Authentication system based on sessions or JWT

### Feature 4: Date Management

**FR-4.1**: Registered users can mark dates as favorites or important

**FR-4.2**: Reminders can be associated with marked dates

**FR-4.3**: Possibility to receive email notifications in the future (later phase)

## Non-Functional Requirements

### Security (NFR-SEC)

**NFR-SEC-1**: Secure authentication with OTP and OAuth (Google)

**NFR-SEC-2**: Data protection and privacy compliance

**NFR-SEC-3**: Secure API communication (HTTPS)

**NFR-SEC-4**: Protection against common web vulnerabilities (CSRF, XSS, SQL injection)

### Scalability (NFR-SCAL)

**NFR-SCAL-1**: Structure prepared for future multi-language support (i18n/l10n)

**NFR-SCAL-2**: Modular architecture for easy feature addition

**NFR-SCAL-3**: Database design optimized for growth

### Responsiveness (NFR-RESP)

**NFR-RESP-1**: Fully responsive design (mobile, tablet, desktop)

**NFR-RESP-2**: Optimized for mobile devices

**NFR-RESP-3**: Touch-friendly interface

### Backend (NFR-BACKEND)

**NFR-BACKEND-1**: PHP with Laravel framework

**NFR-BACKEND-2**: MySQL database

**NFR-BACKEND-3**: RESTful API architecture

**NFR-BACKEND-4**: API-only mode (no Blade views)

### Frontend (NFR-FRONTEND)

**NFR-FRONTEND-1**: React framework

**NFR-FRONTEND-2**: Material UI M3 (Material Design 3)

**NFR-FRONTEND-3**: Single Page Application (SPA)

**NFR-FRONTEND-4**: No Tailwind CSS

**NFR-FRONTEND-5**: No TypeScript

### Language (NFR-LANG)

**NFR-LANG-1**: Initial language: Spanish

**NFR-LANG-2**: Design prepared for internationalization (i18n)

**NFR-LANG-3**: Architecture ready for localization (l10n)

### Hosting and Deployment (NFR-HOST)

**NFR-HOST-1**: VPS self-hosted environment

**NFR-HOST-2**: Custom domain assignment

**NFR-HOST-3**: HTTPS support (Let's Encrypt)

**NFR-HOST-4**: Nginx or Apache as reverse proxy

### Performance (NFR-PERF)

**NFR-PERF-1**: Fast loading times

**NFR-PERF-2**: Optimized for mobile devices

**NFR-PERF-3**: Efficient API response times

**NFR-PERF-4**: Image optimization

### Quality (NFR-QUAL)

**NFR-QUAL-1**: Professional content

**NFR-QUAL-2**: Rigorous and validated information

**NFR-QUAL-3**: Accurate Kin and Encanted Wave calculations

**NFR-QUAL-4**: Extensive and relevant information provided

## Out of Scope (MVP)

The following features are explicitly out of scope for the MVP:

- Multi-language support (prepared but not implemented)
- Email notification system for reminders
- Administrative panel for content management
- Payment/subscription system
- Social sharing features
- Mobile native applications
- Real-time features
- Advanced analytics dashboard
- User forums or community features
