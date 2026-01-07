# Design Process

## Title: Del Viento al Código - Diseño Consciente de un Producto Digital Basado en el Calendario Maya

## Table of Contents

1. [Introduction](#introduction)
2. [Stage 1: Product Discovery](#stage-1-product-discovery)
3. [Stage 2: Requirements Definition](#stage-2-requirements-definition)
4. [Stage 3: System Architecture](#stage-3-system-architecture)
5. [Stage 4: Experience Design (UX/UI)](#stage-4-experience-design-uxui)
6. [Stage 5: Agile Planning](#stage-5-agile-planning)
7. [Stage 6: Product Construction](#stage-6-product-construction)
8. [Stage 7: Deployment and Evolution](#stage-7-deployment-and-evolution)
9. [Final Reflections](#final-reflections)

---

## Introduction

This project emerges from an uncommon place in web development: the integration between ancient wisdom (the Maya calendar) and modern technology (web applications).

What we are building is not just a digital product, but a platform for cultural, educational, and symbolic transmission. The code is the channel, and the purpose is the compass.

In this guide, I accompany you step by step, explaining not only what decisions we make, but why we make them, and how each part of the system fits into a larger vision.

---

## Stage 1: Product Discovery

### What It Is

Product discovery is the foundational stage where we understand what we want to build, for whom, and why. It's about diving deep into the problem space before jumping into the solution space.

### For Whom

- **Anonymous/Casual Users**: People who want to quickly consult today's Kin or a specific date without registering
- **Registered Users**: Users who want to save important dates, set reminders, and access extended content
- **Scholars**: People who study the Maya calendar in depth and need comprehensive, accurate information

### Why It Exists

This product exists to bridge the gap between ancient Maya wisdom and modern accessibility. It aims to:

- Provide accurate, professional quality information about the Maya synchronary calendar
- Make this knowledge accessible to both scholars and casual users
- Create a platform that can evolve and scale with future needs
- Maintain cultural integrity while leveraging modern technology

### Completed Deliverables

- ✅ Product vision defined
- ✅ User types identified
- ✅ Value proposition established
- ✅ Core features identified (Kin, Onda Encantada, dates, user management)
- ✅ Technology stack selected (React + Laravel + MySQL)

### Why This Stage Matters

Without proper discovery, we risk building the wrong thing or building it for the wrong people. This stage ensures we have a clear direction before investing time and resources.

---

## Stage 2: Requirements Definition

### What It Is

Requirements definition is the process of articulating what the system must do (functional requirements) and how it should behave (non-functional requirements).

### Functional Requirements

These define what the system must do:

- **FR-1**: Daily Kin consultation
- **FR-2**: Encanted Wave calculation
- **FR-3**: User management (registration, authentication)
- **FR-4**: Date management (save dates, reminders)

### Non-Functional Requirements

These define how the system should behave:

- **Security**: Secure authentication, data protection
- **Scalability**: Multi-language ready, modular architecture
- **Responsiveness**: Fully responsive design
- **Performance**: Fast loading, optimized for mobile
- **Quality**: Professional, validated content

### Completed Deliverables

- ✅ Functional requirements documented
- ✅ Non-functional requirements documented
- ✅ Out-of-scope items defined
- ✅ Acceptance criteria framework established

### Why This Stage Matters

Clear requirements prevent scope creep, set expectations, and provide a foundation for testing and validation. They are the contract between stakeholders and developers.

---

## Stage 3: System Architecture

### What It Is

System architecture defines how the components of the system interact and how data flows through the system. It's the blueprint for the technical implementation.

### Chosen Architecture

```
[ User ]
     ⬇
[ Frontend in React ]
     ⬇         ⬆
 REST API     Auth (JWT / OAuth / OTP)
     ⬇         ⬆
[ Backend in Laravel ]
     ⬇
[ MySQL Database ]
```

### Key Architectural Decisions

1. **Decoupled Frontend and Backend**
   - React SPA as frontend
   - Laravel API as backend
   - Communication via REST API
   - Allows independent scaling and development

2. **Technology Stack**
   - React + Vite for frontend (fast, modern)
   - Material UI M3 for UI components (consistent, accessible)
   - Laravel for backend (robust, feature-rich)
   - MySQL for database (reliable, well-supported)

3. **Authentication Strategy**
   - JWT or session-based authentication
   - OAuth for Google login
   - OTP for email verification
   - Laravel Sanctum for API authentication

### Completed Deliverables

- ✅ System architecture diagram
- ✅ Database schema defined
- ✅ API endpoints specified
- ✅ Component structure outlined
- ✅ Hosting strategy defined (VPS, Nginx/Apache, Let's Encrypt)

### Why This Stage Matters

Architecture determines maintainability, scalability, and performance. Good architecture reduces technical debt and enables future growth.

---

## Stage 4: Experience Design (UX/UI)

### What It Is

Experience design focuses on how users interact with the system and how the system looks and feels. It encompasses both User Experience (UX) and User Interface (UI).

### Design System

A design system is a collection of reusable components, guided by clear standards, that can be assembled to build any number of applications.

**Why Create a Design System?**

- Consistency: All components look and behave consistently
- Efficiency: Reusable components speed up development
- Scalability: Easy to add new features that match existing design
- Collaboration: Clear guidelines for designers and developers
- Maintainability: Centralized updates and fixes

### Material UI M3

We chose Material UI M3 because:

- Comprehensive component library
- Built-in accessibility
- Active community and support
- Customizable theme system
- Mobile-first responsive design

### UI Kit Components

Key components defined:

- AppBar, CardKin, CardOnda, DatePicker, ModalKinDetalle
- FormLogin, FormRegistro, Button, Snackbar, LoadingSpinner

### Completed Deliverables

- ✅ Design system specifications (colors, typography, spacing)
- ✅ Component library defined
- ✅ Responsive behavior specified
- ✅ Accessibility guidelines established
- ✅ All MVP routes documented

### Why This Stage Matters

Good UX/UI design directly impacts user satisfaction, engagement, and conversion. A well-designed system is intuitive, efficient, and enjoyable to use.

---

## Stage 5: Agile Planning

### What It Is

Agile planning breaks down the project into manageable pieces (epics, user stories) and organizes work into iterations (sprints).

### Epics and User Stories

**Epic 1: Kin Consultation**
- User Story: As an anonymous user, I want to see today's Kin
- User Story: As a user, I want to select any date to see its Kin

**Epic 2: Encanted Wave**
- User Story: As a user, I want to see the Encanted Wave for any date
- User Story: As a user, I want to understand the 13 Kins in the wave

**Epic 3: User Management**
- User Story: As a new user, I want to register via email
- User Story: As a user, I want to login with Google

**Epic 4: Date Management**
- User Story: As a registered user, I want to save important dates
- User Story: As a registered user, I want to set reminders for dates

### Fibonacci Estimation

User stories are estimated using Fibonacci points (1, 2, 3, 5, 8, 13, 21) to represent complexity and effort.

### Sprint Planning

Sprints are time-boxed periods (typically 2 weeks) where a set of user stories is completed.

### Why This Stage Matters

Agile planning provides visibility, enables prioritization, and allows for iterative improvement. It balances flexibility with predictability.

---

## Stage 6: Product Construction

### What It Is

Product construction is the implementation phase where we actually build the software based on the specifications and design.

### Parallel Development

- **Frontend**: React components, state management, API integration
- **Backend**: Laravel controllers, services, database migrations
- **Database**: Schema creation, data seeding, optimization

### Testing Strategy

- **Unit Tests**: Test individual functions and components
- **Integration Tests**: Test how components work together
- **End-to-End Tests**: Test complete user workflows
- **User Acceptance Testing**: Validate against requirements

### Quality Assurance

- Code reviews
- Linting and formatting
- Performance testing
- Security testing
- Accessibility testing

### Why This Stage Matters

This is where design becomes reality. Proper construction ensures the product is reliable, maintainable, and meets the defined requirements.

---

## Stage 7: Deployment and Evolution

### What It Is

Deployment is the process of making the software available to users. Evolution is the ongoing process of improving and expanding the product.

### Deployment Strategy

- **VPS Hosting**: Self-hosted, full control
- **Domain Assignment**: Custom domain with HTTPS
- **Continuous Integration**: Automated testing and deployment
- **Monitoring**: Track performance and errors

### Version Control

- Git for version control
- Semantic versioning (MAJOR.MINOR.PATCH)
- Release notes for each version
- Feature flags for gradual rollout

### Future Phases

- Multi-language support
- Email notifications
- Admin panel
- Mobile apps
- Advanced analytics
- Community features

### Why This Stage Matters

Deployment brings value to users. Evolution ensures the product continues to meet changing needs and stays competitive.

---

## Final Reflections

### Creating Software with Purpose

This project is not just about code. It's about:

- **Preserving Wisdom**: Making ancient Maya knowledge accessible
- **Cultural Bridge**: Connecting past and present
- **Educational Tool**: Providing accurate, professional information
- **Community Building**: Creating a space for people interested in the Maya calendar

### Technology and Ancestral Wisdom

The fusion of ancient wisdom and modern technology is powerful. Technology provides the means to scale and accessibility, while ancestral wisdom provides depth and purpose.

### The Holistic Approach

By following this comprehensive design process, we ensure:

- Clear vision and purpose
- Well-defined requirements
- Solid architecture
- Excellent user experience
- Efficient planning
- Quality implementation
- Successful deployment
- Continuous evolution

This is how we build not just software, but products that matter.

---

## Stages Summary

| Stage | Status | Key Deliverables |
|-------|--------|------------------|
| 1: Product Discovery | ✅ Complete | Vision, user types, value proposition |
| 2: Requirements Definition | ✅ Complete | Functional/non-functional requirements |
| 3: System Architecture | ✅ Complete | Architecture diagram, database schema, API endpoints |
| 4: Experience Design (UX/UI) | ✅ Complete | Design system, component library, routes |
| 5: Agile Planning | 🔄 Next | Epics, user stories, sprint planning |
| 6: Product Construction | ⏳ Pending | Frontend, backend, database implementation |
| 7: Deployment and Evolution | ⏳ Pending | Deployment strategy, monitoring, future phases |

---

## Next Steps

1. Create OpenSpec specifications
2. Define user stories with acceptance criteria
3. Create backlog and prioritize
4. Plan Sprint 1
5. Begin implementation
