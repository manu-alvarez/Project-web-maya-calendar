# TODOs

## Open Questions and Decisions

### TODO-1: Kin Calculation Algorithm
**Status**: Needs Research
**Priority**: HIGH
**Description**: Determine the exact algorithm for calculating Kin numbers from dates.
**Questions**:
- What is the reference date when Kin 1 occurs?
- How does the 260-day Tzolkin cycle map to Gregorian calendar?
- Are there any special cases or exceptions?

**Next Steps**:
- Research authoritative Maya calendar sources
- Upload and process provided books and articles
- Define algorithm with clear rules
- Implement and validate algorithm

**Owner**: Backend Team
**Due**: Before implementation start

---

### TODO-2: Encanted Wave Calculation Algorithm
**Status**: Needs Research
**Priority**: HIGH
**Description**: Define algorithm for calculating Encanted Wave from date and Kin.
**Questions**:
- How does the 13-tone wave relate to the Kin?
- What determines the starting Kin of the wave?
- Are there variations or different wave systems?

**Next Steps**:
- Research Onda Encantada calculation methods
- Upload and process provided books and articles
- Define algorithm with clear rules
- Implement and validate algorithm

**Owner**: Backend Team
**Due**: Before implementation start

---

### TODO-3: Content Creation - Kins
**Status**: Not Started
**Priority**: HIGH
**Description**: Create comprehensive content for all 260 Kins.
**Requirements**:
- Description (minimum 100 words)
- Extended interpretation (minimum 200 words)
- Personal application (minimum 100 words)
- At least one illustration per Kin
- Relationships: guide, analog, antipode, occult
- Professional quality, no placeholders
- Culturally respectful and accurate

**Progress**:
- [ ] Research authoritative sources
- [ ] Create content template
- [ ] Write descriptions for all 260 Kins
- [ ] Create illustrations
- [ ] Validate content with experts
- [ ] Seed database

**Owner**: Content Team
**Due**: Before MVP launch

---

### TODO-4: Content Creation - Ondas
**Status**: Not Started
**Priority**: HIGH
**Description**: Create content for Encanted Waves.
**Requirements**:
- Onda description and interpretation
- Purpose, challenge, service Kin identification
- Context and meaning
- Professional quality

**Progress**:
- [ ] Research authoritative sources
- [ ] Create content template
- [ ] Write descriptions for all Ondas
- [ ] Validate content with experts
- [ ] Seed database

**Owner**: Content Team
**Due**: Before MVP launch

---

### TODO-5: Illustration Design
**Status**: Not Started
**Priority**: MEDIUM
**Description**: Design illustrations for Kins and Ondas.
**Requirements**:
- Professional and respectful design
- Culturally appropriate
- Consistent with design system
- Web-optimized (SVG or optimized raster)
- At least one illustration per Kin

**Next Steps**:
- [ ] Define illustration style guidelines
- [ ] Create illustration templates
- [ ] Design all 260 Kin illustrations
- [ ] Design Onda illustrations
- [ ] Optimize for web
- [ ] Integrate into system

**Owner**: Design Team
**Due**: Before MVP launch

---

### TODO-6: Domain Name and Configuration
**Status**: Pending
**Priority**: MEDIUM
**Description**: Purchase domain name and configure DNS.
**Questions**:
- What domain name to use?
- DNS provider choice?
- SSL certificate setup (Let's Encrypt)?

**Next Steps**:
- [ ] Choose domain name
- [ ] Purchase domain
- [ ] Configure DNS records
- [ ] Set up SSL certificate
- [ ] Configure web server

**Owner**: DevOps
**Due**: Before production deployment

---

### TODO-7: VPS Setup and Configuration
**Status**: Not Started
**Priority**: HIGH
**Description**: Set up VPS for production deployment.
**Requirements**:
- Ubuntu/Debian server
- Nginx or Apache web server
- PHP-FPM for Laravel
- MySQL database server
- SSL/TLS configuration
- Firewall configuration

**Next Steps**:
- [ ] Provision VPS
- [ ] Install and configure web server
- [ ] Install and configure PHP-FPM
- [ ] Install and configure MySQL
- [ ] Set up SSL certificates
- [ ] Configure firewall
- [ ] Set up monitoring

**Owner**: DevOps
**Due**: Before production deployment

---

### TODO-8: Email Service Integration
**Status**: Not Started
**Priority**: HIGH
**Description**: Integrate email service for OTP and notifications.
**Questions**:
- Which email service provider? (SendGrid, Mailgun, SES, etc.)
- Email template design?
- Rate limiting and bounces?

**Next Steps**:
- [ ] Choose email service provider
- [ ] Create email templates
- [ ] Integrate email service with Laravel
- [ ] Implement OTP sending
- [ ] Test email delivery
- [ ] Set up monitoring

**Owner**: Backend Team
**Due**: Before MVP launch

---

### TODO-9: Google OAuth Configuration
**Status**: Not Started
**Priority**: MEDIUM
**Description**: Configure Google OAuth for user authentication.
**Requirements**:
- Google Cloud Console project
- OAuth client credentials
- Redirect URI configuration
- Consent screen setup

**Next Steps**:
- [ ] Create Google Cloud Console project
- [ ] Configure OAuth client
- [ ] Set up redirect URIs
- [ ] Configure consent screen
- [ ] Test OAuth flow
- [ ] Integrate with Laravel Socialite

**Owner**: Backend Team
**Due**: Before MVP launch

---

### TODO-10: Testing Strategy Definition
**Status**: Not Started
**Priority**: MEDIUM
**Description**: Define comprehensive testing strategy.
**Questions**:
- What testing frameworks to use?
- What percentage of code coverage?
- How to handle E2E testing?
- Performance testing requirements?

**Next Steps**:
- [ ] Choose testing frameworks
- [ ] Define unit testing strategy
- [ ] Define integration testing strategy
- [ ] Define E2E testing strategy
- [ ] Set up CI/CD with automated tests
- [ ] Define performance testing approach

**Owner**: QA Team
**Due**: Before implementation start

---

### TODO-11: Performance Monitoring Setup
**Status**: Not Started
**Priority**: LOW
**Description**: Set up application performance monitoring.
**Questions**:
- Which monitoring service? (Sentry, New Relic, Datadog, etc.)
- What metrics to track?
- Alert thresholds?

**Next Steps**:
- [ ] Choose monitoring service
- [ ] Configure error tracking
- [ ] Configure performance monitoring
- [ ] Set up alerts
- [ ] Create dashboards

**Owner**: DevOps
**Due**: After MVP launch

---

### TODO-12: Analytics Integration
**Status**: Not Started
**Priority**: LOW
**Description**: Integrate analytics for user behavior tracking.
**Questions**:
- Which analytics service? (Google Analytics, etc.)
- What events to track?
- Privacy considerations?

**Next Steps**:
- [ ] Choose analytics service
- [ ] Configure tracking
- [ ] Define key events to track
- [ ] Ensure privacy compliance
- [ ] Test tracking

**Owner**: Frontend Team
**Due**: Before MVP launch

---

### TODO-13: Legal Documents Creation
**Status**: Not Started
**Priority**: MEDIUM
**Description**: Create legal documents for the application.
**Requirements**:
- Terms of Service
- Privacy Policy
- Cookie Policy
- GDPR compliance (if applicable)

**Next Steps**:
- [ ] Draft Terms of Service
- [ ] Draft Privacy Policy
- [ ] Draft Cookie Policy
- [ ] Legal review
- [ ] Implement in application

**Owner**: Legal / Product
**Due**: Before MVP launch

---

### TODO-14: Content Validation with Experts
**Status**: Not Started
**Priority**: HIGH
**Description**: Validate all content with Maya calendar experts.
**Requirements**:
- Find and engage subject matter experts
- Review all Kin content
- Review all Onda content
- Validate calculations
- Get approval/sign-off

**Next Steps**:
- [ ] Identify potential experts
- [ ] Reach out to experts
- [ ] Schedule review sessions
- [ ] Implement feedback
- [ ] Get final approval

**Owner**: Product / Content
**Due**: Before MVP launch

---

### TODO-15: Accessibility Audit
**Status**: Not Started
**Priority**: MEDIUM
**Description**: Conduct accessibility audit of the application.
**Requirements**:
- WCAG AA compliance
- Keyboard navigation
- Screen reader compatibility
- Color contrast validation

**Next Steps**:
- [ ] Choose accessibility testing tools
- [ ] Conduct automated accessibility audit
- [ ] Conduct manual accessibility testing
- [ ] Fix identified issues
- [ ] Validate with screen readers

**Owner**: QA Team
**Due**: Before MVP launch

---

### TODO-16: Security Audit
**Status**: Not Started
**Priority**: HIGH
**Description**: Conduct security audit of the application.
**Requirements**:
- Penetration testing
- Vulnerability scanning
- Code review for security issues
- Dependency vulnerability check

**Next Steps**:
- [ ] Choose security audit tools
- [ ] Conduct automated vulnerability scan
- [ ] Conduct manual penetration testing
- [ ] Review code for security issues
- [ ] Check dependencies for vulnerabilities
- [ ] Fix identified issues

**Owner**: Security / DevOps
**Due**: Before MVP launch

---

## Blocked Items

### BLOCKED-1: Content Creation - Waiting for Research
**Blocked By**: TODO-1, TODO-2 (Algorithm Definition)
**Description**: Cannot create full content until Kin and Onda calculation algorithms are finalized.
**Unblock Plan**: Complete algorithm research and definition first.

---

### BLOCKED-2: Illustration Design - Waiting for Content
**Blocked By**: TODO-3, TODO-4 (Content Creation)
**Description**: Cannot design illustrations until content is finalized.
**Unblock Plan**: Complete content creation drafts first.

---

## Dependencies

### Dependency Graph
```
TODO-1 (Kin Algorithm)
    ↓
TODO-3 (Kin Content)
    ↓
TODO-5 (Illustrations)

TODO-2 (Onda Algorithm)
    ↓
TODO-4 (Onda Content)
    ↓
TODO-5 (Illustrations)

TODO-7 (VPS Setup)
    ↓
TODO-6 (Domain Setup)
    ↓
Production Deployment

TODO-8 (Email Service)
    ↓
FR-3.1 (Registration)
FR-3.2 (Email Verification)

TODO-9 (Google OAuth)
    ↓
FR-3.5 (Google Login)
```

---

## Completed Items

### COMPLETED-1: Project Setup
**Status**: ✅ Completed
**Description**: Initial project folder structure and documentation created.
**Date**: 2024-01-07

### COMPLETED-2: Technology Stack Selection
**Status**: ✅ Completed
**Description**: Technology stack selected (React + Vite, Material UI M3, Laravel, MySQL).
**Date**: 2024-01-07

### COMPLETED-3: Design System Definition
**Status**: ✅ Completed
**Description**: Design system and UI Kit specifications created.
**Date**: 2024-01-07

### COMPLETED-4: OpenSpec Specifications
**Status**: ✅ Completed
**Description**: Complete OpenSpec specifications created following protocol.
**Date**: 2024-01-07

---

## Future Considerations

### Consideration 1: Content Updates
**Question**: How will content be updated in the future?
**Options**:
- Admin panel (Phase 2)
- Direct database access (MVP)
- External CMS (future)
**Decision**: Direct database access for MVP, Admin panel in Phase 2

### Consideration 2: User Feedback Collection
**Question**: How to collect user feedback?
**Options**:
- Email contact form
- In-app feedback mechanism
- External survey tools
**Decision**: Email contact form for MVP, in-app feedback in Phase 2

### Consideration 3: Data Backup Strategy
**Question**: How to backup production data?
**Options**:
- Manual backups
- Automated backup scripts
- Managed database service
**Decision**: Automated backup scripts with retention policy

---

## Risk Mitigation

### Risk 1: Algorithm Accuracy
**Risk**: Kin or Onda calculation algorithms may be incorrect.
**Mitigation**:
- Research multiple authoritative sources
- Validate with Maya calendar experts
- Implement comprehensive testing
- Allow for algorithm updates

### Risk 2: Content Quality
**Risk**: Content may not meet quality standards.
**Mitigation**:
- Work with subject matter experts
- Professional writers and editors
- Multiple review rounds
- Quality checklist before publishing

### Risk 3: Security Vulnerabilities
**Risk**: Security issues in production.
**Mitigation**:
- Security audit before launch
- Regular dependency updates
- Monitoring and alerting
- Incident response plan

### Risk 4: Performance Issues
**Risk**: Application may not meet performance requirements.
**Mitigation**:
- Performance testing before launch
- Optimization strategies implemented
- Caching where appropriate
- Monitoring and alerting

### Risk 5: Accessibility Issues
**Risk**: Application may not be accessible.
**Mitigation**:
- Accessibility audit before launch
- Follow WCAG guidelines
- Test with screen readers
- Continuous accessibility improvements

---

## Decision Log

### Decision 1: Technology Stack
**Date**: 2024-01-07
**Decision**: React + Vite, Material UI M3, Laravel, MySQL
**Rationale**: Modern, well-supported, appropriate for team skills
**Alternatives Considered**: Vue.js, Django, PostgreSQL

### Decision 2: Authentication Method
**Date**: 2024-01-07
**Decision**: JWT with Laravel Sanctum
**Rationale**: Stateless, scalable, well-supported in Laravel
**Alternatives Considered**: Session-based, OAuth-only

### Decision 3: Email Verification
**Date**: 2024-01-07
**Decision**: OTP for email verification
**Rationale**: Industry standard, secure, user-friendly
**Alternatives Considered**: Magic links, no verification

---

## Notes

- All content must be 100% real, no placeholders or fake data
- Code and comments must be in English
- Communication and documentation in Spanish
- Production environment from day 1
- Responsive design is mandatory
- Accessibility (WCAG AA) is required
