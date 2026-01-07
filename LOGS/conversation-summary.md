# Conversation Summary

## Project Overview

**Project Name**: Maya Calendar Web Application

**Purpose**: Create a web platform that integrates ancient Maya calendar wisdom with modern web technology, providing users with access to information about the Maya synchronary calendar.

**Date**: 2024-01-07

---

## Key Decisions Made

### 1. Technology Stack
- **Frontend**: React with Vite (No TypeScript, No Tailwind)
- **UI Framework**: Material UI M3 (Material Design 3)
- **Backend**: Laravel 11 (PHP)
- **Database**: MySQL
- **Hosting**: VPS self-hosted

### 2. Project Structure
- **RULES/**: Global rules and guidelines
- **CONTEXT/**: Project context, requirements, architecture, design system, routes
- **DOCS/**: Documentation (design process, OpenSpec)
- **LOGS/**: Logs and summaries
- **openspecs/**: OpenSpec specifications (specs/ and changes/)

### 3. Content Standards
- **100% Production Environment**: No fake data, demo data, mockups, or false information
- **Professional Quality**: Rigorous, validated content
- **Extensive Content**: Kin descriptions equivalent to full A4 page with detailed explanations
- **Real Data**: All content must be completely real and validated

### 4. Communication Language
- **User Communication**: Always in Spanish
- **Code & Comments**: In English
- **Commit Messages**: In English

### 5. OpenSpec Integration
- Complete OpenSpec specifications created following protocol
- All 13 spec modules completed:
  - 01-meta.md
  - 02-summary.md
  - 03-goals.md
  - 04-features.md
  - 05-design.md
  - 06-architecture.md
  - 07-requirements.md
  - 08-endpoints.md
  - 09-data-models.md
  - 10-workflows.md
  - 11-acceptance-criteria.md
  - 12-out-of-scope.md
  - 13-todos.md

---

## Features Defined

### Core Features (MVP)
1. **Daily Kin Consultation**: View today's Kin or any specific date
2. **Encanted Wave Calculation**: View 13-Kin Encanted Wave for any date
3. **User Management**: Anonymous and registered users with different privilege levels
4. **Date Management**: Save important dates and set reminders (registered users)
5. **Authentication**: Email with OTP verification and Google OAuth

### User Types
- **Anonymous/Casual Users**: Access basic Kin and Onda information
- **Registered Users**: Save dates, set reminders, access extended content
- **Scholarly Users**: In-depth study of Maya calendar with comprehensive data

---

## Design System

### Material UI M3
- Primary color: #6750A4
- Secondary color: #625B71
- Background: #FFFBFE
- Text: #1C1B1F

### Typography
- Primary: Roboto
- Headings: Roboto Slab
- Scale: Display Large (57px) to Label Small (11px)

### Components
- AppBar, CardKin, CardOnda, DatePicker, ModalKinDetalle
- FormLogin, FormRegistro, Button, TextField, Snackbar, LoadingSpinner

### Responsive Breakpoints
- Mobile: < 600px
- Tablet: 600px - 900px
- Desktop: > 900px

---

## Architecture

### Frontend
- React with Vite
- Material UI M3
- React Router for routing
- Axios for API communication
- Context API for state management

### Backend
- Laravel 11 (API-only mode)
- MySQL database
- Laravel Sanctum for authentication
- Laravel Socialite for Google OAuth

### Database Schema
- users, kins, ondas, onda_kins, fechas_guardadas, recordatorios
- Foreign key constraints and proper indexing
- Migration-based version control

---

## API Endpoints

### Authentication
- POST /api/register
- POST /api/verify-otp
- POST /api/login
- POST /api/logout
- POST /api/refresh
- GET /api/google/redirect
- GET /api/google/callback

### Kin
- GET /api/kin/today
- GET /api/kin/{date}

### Onda Encantada
- GET /api/onda/{date}
- GET /api/onda/{date}/kins

### User
- GET /api/user/profile
- PUT /api/user/profile
- GET /api/user/saved-dates
- POST /api/user/saved-dates
- DELETE /api/user/saved-dates/{id}
- GET /api/user/reminders
- POST /api/user/reminders
- PUT /api/user/reminders/{id}
- DELETE /api/user/reminders/{id}

---

## Frontend Routes

### Public Routes
- `/` - Home (today's Kin)
- `/kin/:date` - Kin detail
- `/onda/:date` - Onda Encantada
- `/registro` - Registration
- `/login` - Login
- `/sobre` - About
- `/ayuda` - Help

### Protected Routes
- `/perfil` - Profile
- `/favoritos` - Saved dates
- `/recordatorios` - Reminders

---

## Outstanding Questions & TODOs

### High Priority
1. **Kin Calculation Algorithm**: Determine exact algorithm for calculating Kin numbers from dates
2. **Encanted Wave Algorithm**: Define algorithm for calculating Encanted Wave
3. **Content Creation**: Create comprehensive content for all 260 Kins
4. **Content Creation**: Create content for Encanted Waves
5. **Illustration Design**: Design illustrations for Kins and Ondas

### Medium Priority
6. **Domain Name**: Choose and purchase domain name
7. **VPS Setup**: Set up and configure VPS for production
8. **Email Service**: Integrate email service for OTP and notifications
9. **Google OAuth**: Configure Google OAuth for authentication
10. **Testing Strategy**: Define comprehensive testing strategy

### Low Priority
11. **Performance Monitoring**: Set up application performance monitoring
12. **Analytics**: Integrate analytics for user behavior tracking
13. **Legal Documents**: Create legal documents (Terms, Privacy, Cookie Policy)
14. **Accessibility Audit**: Conduct accessibility audit
15. **Security Audit**: Conduct security audit

---

## Out of Scope (MVP)

- Multi-language support (architecture ready but not implemented)
- Email notifications for reminders (future phase)
- Social sharing features
- Mobile native applications
- User-generated content
- Payment/subscription system
- Administrative panel
- Real-time features
- Advanced analytics dashboard
- Community features
- Advanced search and filtering
- Content versioning and history
- Export and import features
- Offline support
- Advanced user preferences
- Integration with external services beyond Google OAuth
- Gamification features
- Advanced rate limiting and API keys
- Content management system (CMS)
- Multi-tenancy

---

## Next Steps

1. **Review and Validate**: Review all specifications and OpenSpec documents
2. **Git Initialization**: Initialize Git repository in project root
3. **Planning Phase**: Create detailed plans for frontend and backend setup
4. **Implementation**: Begin implementation of frontend and backend
5. **Content Creation**: Start creating content for Kins and Ondas
6. **Testing**: Implement testing strategy
7. **Deployment**: Deploy to production VPS

---

## Reference Websites

- https://www.13lunas.net/
- https://mayankin.com/es/tzolkin-diario/
- https://tzolkin1320.com/calculadora-kin-maya/

---

## OpenSpec Reference

OpenSpec Protocol: https://github.com/Fission-AI/OpenSpec

All OpenSpec specifications are located in `/openspecs/specs/` directory.
