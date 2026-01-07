# Critical Dependencies and Unblocking Plan

## ⚠️ CRITICAL BLOCKERS IDENTIFIED

Before starting development checklists, the following items MUST be resolved:

---

## 🔴 Priority 0: Algorithm Definition (BLOCKS EVERYTHING)

### BLOQUEANTE-1: Kin Calculation Algorithm
**Status**: ✅ COMPLETED
**Priority**: CRITICAL
**Impact**: Blocks ALL Kin functionality
**Blocks**: TODO-3 (Kin Content), TODO-5 (Illustrations), B19 (Kin Service), B24 (Kin API)
**Resolution**: `/resources/maya-calendar-rules.md` created with complete algorithm

**Completed Actions**:
- [x] Research authoritative Maya calendar sources (MayanKin, Law of Time, Wikipedia, etc.)
- [x] Define algorithm with clear rules and edge cases
- [x] Document complete algorithm in `/resources/maya-calendar-rules.md` including:
  - Reference date: July 26, 1987 = Kin 1 (Red Magnetic Dragon)
  - 260-day Tzolkin cycle mapping to Gregorian calendar
  - Leap day handling (February 29th = Day Out of Time, not counted)
  - Complete Python implementation with MayanCalculator class
  - Oracle calculation (5 energies: Destiny, Guide, Analog, Antipode, Occult)
  - Wavespell calculation
  - Castle calculation
  - GAP (Galactic Activation Portal) detection
  - Core Day (Mystic Column) detection
  - Practical examples and test cases
- [x] Validate algorithm with multiple sources and examples

**Key Algorithm Components**:
- `calculate_kin_number(date)`: Converts Gregorian date to Kin (1-260)
- `calculate_tone(kin_number)`: Gets Galactic Tone (1-13)
- `calculate_seal(kin_number)`: Gets Solar Seal (1-20)
- `calculate_oracle(kin_number)`: Gets all 5 Oracle energies
- `calculate_wavespell(kin_number)`: Gets Wavespell information
- `get_castle(kin_number)`: Gets Castle information

**Estimated Time**: COMPLETED (2-3 days)
**Owner**: Backend Team / Maya Calendar Expert

---

### BLOQUEANTE-2: Onda Encantada (Wavespell) Calculation Algorithm
**Status**: ✅ COMPLETED
**Priority**: CRITICAL
**Impact**: Blocks ALL Onda functionality
**Blocks**: TODO-4 (Onda Content), TODO-5 (Illustrations), B20 (Onda Service), B25 (Onda API)
**Resolution**: `/resources/maya-calendar-rules.md` created with complete algorithm

**Completed Actions**:
- [x] Research Onda calculation methods from authoritative sources (Law of Time, MayanKin, etc.)
- [x] Define algorithm with clear rules
- [x] Document complete algorithm in `/resources/maya-calendar-rules.md` including:
  - Onda definition: 13-day cycle representing complete creative process
  - How 13-tone wave relates to the Kin
  - Starting Kin determination: most recent Kin with Tone 1
  - Formula: `((kin_number - 1) // 13) * 13 + 1`
  - Complete Wavespell structure with all 13 positions
  - Meaning of each position (Tone 1-13) in the Wavespell
  - Birth Wavespell concept and interpretation
  - Python implementation with `calculate_wavespell()` method
  - Practical examples

**Key Algorithm Components**:
- `calculate_wavespell(kin_number)`: Gets Wavespell information
  - `start_kin`: First Kin of the Wavespell (always Tone 1)
  - `end_kin`: Last Kin of the Wavespell (always Tone 13)
  - `governing_seal`: The Solar Seal that governs this Wavespell
  - `position`: Where the given Kin falls in the Wavespell (1-13)
  - `kins`: List of all 13 Kins in the Wavespell
- **13 Ondas**: Each Wavespell is one of 20 possible Wavespells (one for each Solar Seal)
- **Onda sequence**: Dragon → Wind → Night → Seed → ... → Sun (then repeats)

**Estimated Time**: COMPLETED (2-3 days)
**Owner**: Backend Team / Maya Calendar Expert

---

## 🟡 Priority 1: Database and Content Setup

### BLOQUEANTE-3: Kin Content Creation
**Status**: ❌ NOT STARTED
**Priority**: HIGH
**Blocked By**: BLOQUEANTE-1 (Kin Algorithm)
**Impact**: Blocks database seeding and frontend testing
**Blocks**: B18 (Kin Seeders), all Kin-related frontend components

**Required Actions**:
- [ ] Create content template for Kin descriptions
- [ ] Write descriptions for all 260 Kins (min 100 words each)
- [ ] Write extended interpretations for all Kins (min 200 words each)
- [ ] Write personal applications for all Kins (min 100 words each)
- [ ] Identify and set all Kin relationships (guide, analog, antipode, occult)
- [ ] Validate content quality meets professional standards
- [ ] Create seed data files

**Estimated Time**: 2-3 weeks
**Owner**: Content Team / Maya Calendar Expert

---

### BLOQUEANTE-4: Onda Content Creation
**Status**: ❌ NOT STARTED
**Priority**: HIGH
**Blocked By**: BLOQUEANTE-2 (Onda Algorithm)
**Impact**: Blocks database seeding and frontend testing
**Blocks**: B18 (Onda Seeders), all Onda-related frontend components

**Required Actions**:
- [ ] Create content template for Onda descriptions
- [ ] Write descriptions for all Ondas
- [ ] Identify purpose, challenge, service Kins for each Onda
- [ ] Validate content quality meets professional standards
- [ ] Create seed data files

**Estimated Time**: 1-2 weeks
**Owner**: Content Team / Maya Calendar Expert

---

## 🟢 Priority 2: Infrastructure and Services

### BLOQUEANTE-5: Email Service Configuration
**Status**: ❌ NOT STARTED
**Priority**: HIGH
**Impact**: Blocks user registration and authentication
**Blocks**: FR-3.1 (Email Registration), FR-3.2 (OTP Verification)

**Required Actions**:
- [ ] Choose email service provider (SendGrid, Mailgun, SES, etc.)
- [ ] Create service account
- [ ] Obtain API credentials
- [ ] Design email templates (OTP, password reset, etc.)
- [ ] Document credentials in `.env.example` file (NEVER commit actual credentials)
- [ ] Test email delivery works correctly

**Estimated Time**: 1-2 days
**Owner**: DevOps / Backend Team

---

### BLOQUEANTE-6: Google OAuth Configuration
**Status**: ❌ NOT STARTED
**Priority**: MEDIUM
**Impact**: Blocks Google login functionality
**Blocks**: FR-3.5 (Google Login)

**Required Actions**:
- [ ] Create Google Cloud Console project
- [ ] Configure OAuth client credentials
- [ ] Set up authorized redirect URIs
- [ ] Configure OAuth consent screen
- [ ] Document credentials in `.env.example` file (NEVER commit actual credentials)
- [ ] Test OAuth flow end-to-end

**Estimated Time**: 1 day
**Owner**: DevOps / Backend Team

---

### BLOQUEANTE-7: Database Server Setup
**Status**: ✅ COMPLETED
**Priority**: HIGH
**Impact**: Blocks all backend development
**Blocks**: All database-dependent features
**Resolution**: MAMP PRO MySQL 5.7.39 configured and running, database `maya_calendar` created

**Completed Actions**:
- [x] Set up MySQL database server (MAMP PRO MySQL 5.7.39 on port 8889)
- [x] Create database named `maya_calendar` (utf8mb4, utf8mb4_unicode_ci)
- [x] Create database user with appropriate permissions (root/root for local development)
- [x] Document connection parameters in `.env.example` and `/LOGS/mamp-setup.md`
- [x] Test database connection from Laravel (verified via MySQL client)
- [x] Document all configuration in `/LOGS/mamp-setup.md`

**Configuration Details**:
- **MySQL Version**: 5.7.39
- **Host**: 127.0.0.1
- **Port**: 8889
- **Database**: maya_calendar
- **Username**: root
- **Password**: root
- **Character Set**: utf8mb4
- **Collation**: utf8mb4_unicode_ci
- **Socket**: /Applications/MAMP/tmp/mysql/mysql.sock

**Estimated Time**: COMPLETED (0.5 day)
**Owner**: DevOps / Backend Team

---

## 🟣 Priority 3: Development Preparation

### BLOQUEANTE-8: Testing Strategy Definition
**Status**: ❌ NOT STARTED
**Priority**: MEDIUM
**Impact**: Blocks proper testing implementation
**Blocks**: F31-F33 (Frontend Tests), B39-B41 (Backend Tests)

**Required Actions**:
- [ ] Choose testing frameworks (Vitest/Jest for frontend, PHPUnit for backend)
- [ ] Define code coverage requirements (minimum 70%)
- [ ] Choose E2E testing framework (Playwright or Cypress)
- [ ] Define testing standards and conventions
- [ ] Create testing setup documentation

**Estimated Time**: 2-3 days
**Owner**: QA Team / All Teams

---

## 📊 Dependency Graph Summary

```
[BLOQUEANTE-1] Kin Algorithm
    ↓
[BLOQUEANTE-3] Kin Content
    ↓
[BLOQUEANTE-5] Illustrations
    ↓
Database Seeding & Frontend Development

[BLOQUEANTE-2] Onda Algorithm
    ↓
[BLOQUEANTE-4] Onda Content
    ↓
[BLOQUEANTE-5] Illustrations
    ↓
Database Seeding & Frontend Development

[BLOQUEANTE-7] Database Server
    ↓
Backend Development (B12-B18)

[BLOQUEANTE-5] Email Service
    ↓
Auth Features (B06-B11, F08)

[BLOQUEANTE-6] Google OAuth
    ↓
Auth Features (B09)

[BLOQUEANTE-8] Testing Strategy
    ↓
Testing Implementation (F31-F33, B39-B41)
```

---

## 🎯 Recommended Unblocking Order

### Phase 0: Foundation (Week 1)
**Goal**: Unblock infrastructure and begin content creation

1. **COMPLETED**: BLOQUEANTE-7 - Database Server Setup ✅
   - MAMP PRO MySQL 5.7.39 configured and running
   - Database `maya_calendar` created (utf8mb4)
   - Connection documented in `/LOGS/mamp-setup.md`
   - Enables backend development to start immediately

2. **Day 1-3**: BLOQUEANTE-8 - Testing Strategy Definition (2-3 days)
   - Can be done in parallel with algorithm research
   - Establishes standards for all development

3. **COMPLETED**: BLOQUEANTE-1 - Kin Calculation Algorithm ✅
   - Documented in `/resources/maya-calendar-rules.md`
   - Ready for content creation

4. **COMPLETED**: BLOQUEANTE-2 - Onda Calculation Algorithm ✅
   - Documented in `/resources/maya-calendar-rules.md`
   - Ready for content creation

5. **Day 3-5**: BLOQUEANTE-5 - Email Service Configuration (1-2 days)
   - Enables auth development
   - Can be done in parallel

6. **Day 5-6**: BLOQUEANTE-6 - Google OAuth Configuration (1 day)
   - Enables Google login
   - Can be done in parallel

### Phase 1: Content Creation (Week 2-3)
**Goal**: Create all Kin and Onda content

7. **Week 2-3**: BLOQUEANTE-3 - Kin Content Creation (2-3 weeks)
   - CRITICAL - Massive content effort
   - Can start immediately after algorithm is defined

8. **Week 2-3**: BLOQUEANTE-4 - Onda Content Creation (1-2 weeks)
   - Can start immediately after Onda algorithm is defined
   - Can be done in parallel with Kin content

### Phase 2: Development (Week 4-6)
**Goal**: Start frontend and backend checklists

9. **Week 4**: Frontend Setup (F01-F13)
10. **Week 5**: Backend Setup (B01-B11)
11. **Week 6**: Core Feature Development (both F and B series)

---

## ✅ Acceptance Criteria for Starting Development

Before marking any checklist item as complete, ensure:

- [ ] **Algorithm Definitions**: Both Kin and Onda algorithms documented and validated
- [ ] **Content Ready**: Seed data files created and validated
- [ ] **Infrastructure Ready**: Database, email service, and OAuth configured
- [ ] **Testing Strategy**: Defined and documented
- [ ] **Expert Validation**: Algorithms and content reviewed by Maya calendar experts

---

## 🚨 Risk Mitigation

### Risk 1: Algorithm Complexity
**Risk**: Maya calendar algorithms may be more complex than anticipated
**Mitigation**:
- Allocate extra time (buffer: 50% more than estimated)
- Have multiple authoritative sources available
- Be prepared to iterate on algorithm

### Risk 2: Content Volume
**Risk**: 260 Kins with extensive content is a massive undertaking
**Mitigation**:
- Use content templates and reuse patterns
- Consider partial content for MVP (e.g., 50-100 most common Kins first)
- Use AI assistance with expert validation (careful with quality)

### Risk 3: Expert Availability
**Risk**: Maya calendar experts may not be available or may take time
**Mitigation**:
- Reach out to experts early
- Consider multiple expert sources
- Use authoritative books and articles as primary sources

---

## 📝 Notes

- All blockers must be resolved before starting F01 and B01
- Phase 0 (Foundation) is CRITICAL and cannot be skipped
- Parallel work is possible on non-dependent blockers
- Each completed blocker should be documented in `/LOGS/unblocking-progress.md`
- All decisions made during unblocking should be logged

---

## 🔄 Unblocking Checklist

Use this checklist to track progress on resolving blockers:

### Algorithm Research
- [x] Books and articles uploaded and processed
- [x] Multiple authoritative sources researched
- [x] Kin algorithm defined and documented
- [x] Onda algorithm defined and documented
- [ ] Algorithms validated with expert review

### Content Creation
- [ ] Content templates created
- [ ] Kin content creation started
- [ ] Kin content creation completed (all 260)
- [ ] Onda content creation started
- [ ] Onda content creation completed
- [ ] All content validated for quality

### Infrastructure
- [x] Database server set up and tested (MAMP PRO MySQL 5.7.39, port 8889)
- [ ] Email service configured and tested
- [ ] Google OAuth configured and tested
- [x] All credentials documented in .env.example and /LOGS/mamp-setup.md

### Testing
- [ ] Testing frameworks chosen and installed
- [ ] Testing strategy documented
- [ ] Code coverage requirements defined
- [ ] E2E testing framework chosen

---

## 🎯 Next Actions

1. ✅ **COMPLETED**: Upload and process books and articles about Maya calendar
2. ✅ **COMPLETED**: Set up local MySQL database for development (MAMP PRO MySQL 5.7.39, maya_calendar database created)
3. ✅ **COMPLETED**: Research and define Kin and Onda algorithms (documented in `/resources/maya-calendar-rules.md`)
4. **NEXT WEEK**: Start content creation once algorithms are defined
5. **PARALLEL**: Configure email service and Google OAuth (before B06 and B09)

Once all critical blockers are resolved, we can start the development checklists in plan-frontend.md and plan-backend.md.

**Current Status**: Infrastructure (BLOQUEANTE-7) ✅ COMPLETE - Ready to start B01 (Backend Setup) and F01 (Frontend Setup)
