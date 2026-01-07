# Backend Implementation Plan

## Overview
Detailed step-by-step plan for implementing Laravel + MySQL backend for **Maya Calendar web application.

---

## Setup Phase

### B01: Initialize Laravel Project
- [ ] Create new Laravel project
- [ ] Verify project structure is correct
- [ ] Test development server runs on http://localhost:8000
- [ ] Configure API-only mode

### B02: Install Dependencies
- [ ] Install Laravel Sanctum for API authentication
- [ ] Install Laravel Socialite for Google OAuth
- [ ] Install email service integration (e.g., SendGrid, Mailgun)
- [ ] Install Laravel Debugbar (development only)
- [ ] Verify all dependencies installed correctly

### B03: Configure Environment
- [ ] Create .env file with environment variables
- [ ] Configure database connection (MySQL)
- [ ] Configure APP_URL and API URL
- [ ] Configure email service credentials
- [ ] Configure Google OAuth credentials
- [ ] Generate application key
- [ ] Verify environment configuration is correct

### B04: Configure Database
- [ ] Create MySQL database
- [ ] Configure database user and permissions
- [ ] Test database connection
- [ ] Verify Laravel can connect to database

### B05: Configure CORS
- [ ] Install Laravel CORS package
- [ ] Configure CORS settings
- [ ] Allow frontend origin
- [ ] Allow necessary methods and headers
- [ ] Test CORS configuration works correctly

---

## Authentication Phase

### B06: Configure Laravel Sanctum
- [ ] Install and configure Laravel Sanctum
- [ ] Create authentication guard for API
- [ ] Configure token expiration
- [ ] Configure token refresh
- [ ] Test authentication works correctly

### B07: Create User Model and Migration
- [ ] Create users migration with all fields
- [ ] Add foreign key constraints
- [ ] Add indexes for performance
- [ ] Run migration
- [ ] Test user model works correctly

### B08: Create Auth Controller
- [ ] Create AuthController
- [ ] Implement register method
- [ ] Implement login method
- [ ] Implement logout method
- [ ] Implement refresh method
- [ ] Implement verify OTP method
- [ ] Implement forgot password method
- [ ] Implement reset password method
- [ ] Add validation rules
- [ ] Test all auth methods work correctly

### B09: Configure Google OAuth
- [ ] Install and configure Laravel Socialite
- [ ] Create Google OAuth redirect route
- [ ] Create Google OAuth callback route
- [ ] Implement OAuth flow
- [ ] Test Google OAuth works correctly

### B10: Create Auth Middleware
- [ ] Create ApiAuth middleware
- [ ] Implement JWT token validation
- [ ] Implement user authentication
- [ ] Add middleware to routes
- [ ] Test middleware works correctly

### B11: Create Form Request Classes
- [ ] Create RegisterRequest with validation rules
- [ ] Create LoginRequest with validation rules
- [ ] Create ResetPasswordRequest with validation rules
- [ ] Test all form requests work correctly

---

## Database Phase

### B12: Create Kin Model and Migration
- [ ] Create kins migration with all fields
- [ ] Add self-referencing foreign keys (guide, analog, antipode, occult)
- [ ] Add indexes for performance
- [ ] Run migration
- [ ] Test Kin model works correctly

### B13: Create Onda Model and Migration
- [ ] Create ondas migration with all fields
- [ ] Add foreign keys to Kins
- [ ] Add indexes for performance
- [ ] Run migration
- [ ] Test Onda model works correctly

### B14: Create OndaKin Model and Migration
- [ ] Create onda_kins migration with all fields
- [ ] Add foreign keys to Onda and Kin
- [ ] Add unique constraints
- [ ] Add indexes for performance
- [ ] Run migration
- [ ] Test OndaKin model works correctly

### B15: Create FechaGuardada Model and Migration
- [ ] Create fechas_guardadas migration with all fields
- [ ] Add foreign key to User
- [ ] Add indexes for performance
- [ ] Add cascade delete rule
- [ ] Run migration
- [ ] Test FechaGuardada model works correctly

### B16: Create Recordatorio Model and Migration
- [ ] Create recordatorios migration with all fields
- [ ] Add foreign key to User
- [ ] Add indexes for performance
- [ ] Add cascade delete rule
- [ ] Run migration
- [ ] Test Recordatorio model works correctly

### B17: Create Model Relationships
- [ ] Define User model relationships (hasMany: fechas_guardadas, recordatorios)
- [ ] Define Kin model relationships (belongsTo: guide, analog, antipode, occult; hasMany: onda_kins)
- [ ] Define Onda model relationships (belongsTo: purpose_kin, challenge_kin, service_kin; hasMany: onda_kins)
- [ ] Define OndaKin model relationships (belongsTo: onda, kin)
- [ ] Define FechaGuardada model relationships (belongsTo: user)
- [ ] Define Recordatorio model relationships (belongsTo: user)
- [ ] Test all relationships work correctly

### B18: Create Database Seeders
- [ ] Create Kin seeder with initial data
- [ ] Create Onda seeder with initial data
- [ ] Create OndaKin seeder with initial data
- [ ] Run seeders
- [ ] Test seeders work correctly

---

## Services Phase

### B19: Create Kin Service
- [ ] Create KinService class
- [ ] Implement calculateKinFromDate method
- [ ] Implement getTodayKin method
- [ ] Implement getKinByDate method
- [ ] Implement getKinWithRelations method
- [ ] Test all Kin service methods work correctly

### B20: Create Onda Service
- [ ] Create OndaService class
- [ ] Implement calculateOndaFromDate method
- [ ] Implement getOndaByDate method
- [ ] Implement getOndaWithKins method
- [ ] Test all Onda service methods work correctly

### B21: Create Auth Service
- [ ] Create AuthService class
- [ ] Implement register method
- [ ] Implement login method
- [ ] Implement logout method
- [ ] Implement verifyOTP method
- [ ] Implement generateOTP method
- [ ] Implement forgotPassword method
- [ ] Implement resetPassword method
- [ ] Implement handleGoogleOAuth method
- [ ] Test all Auth service methods work correctly

### B22: Create Email Service
- [ ] Create EmailService class
- [ ] Implement sendOTP method
- [ ] Implement sendPasswordReset method
- [ ] Create email templates
- [ ] Test all email service methods work correctly

---

## API Endpoints Phase

### B23: Create Authentication API Routes
- [ ] Create POST /api/register endpoint
- [ ] Create POST /api/verify-otp endpoint
- [ ] Create POST /api/login endpoint
- [ ] Create POST /api/logout endpoint
- [ ] Create POST /api/refresh endpoint
- [ ] Create POST /api/forgot-password endpoint
- [ ] Create POST /api/reset-password endpoint
- [ ] Create GET /api/google/redirect endpoint
- [ ] Create GET /api/google/callback endpoint
- [ ] Add middleware to routes
- [ ] Test all authentication endpoints work correctly

### B24: Create Kin API Routes
- [ ] Create GET /api/kin/today endpoint
- [ ] Create GET /api/kin/{date} endpoint
- [ ] Create GET /api/kin/{date}/relations endpoint
- [ ] Add middleware to routes
- [ ] Test all Kin endpoints work correctly

### B25: Create Onda API Routes
- [ ] Create GET /api/onda/{date} endpoint
- [ ] Create GET /api/onda/{date}/kins endpoint
- [ ] Add middleware to routes
- [ ] Test all Onda endpoints work correctly

### B26: Create User API Routes
- [ ] Create GET /api/user/profile endpoint
- [ ] Create PUT /api/user/profile endpoint
- [ ] Create GET /api/user/saved-dates endpoint
- [ ] Create POST /api/user/saved-dates endpoint
- [ ] Create DELETE /api/user/saved-dates/{id} endpoint
- [ ] Create GET /api/user/reminders endpoint
- [ ] Create POST /api/user/reminders endpoint
- [ ] Create PUT /api/user/reminders/{id} endpoint
- [ ] Create DELETE /api/user/reminders/{id} endpoint
- [ ] Add middleware to routes
- [ ] Test all user endpoints work correctly

---

## Validation Phase

### B27: Add Input Validation
- [ ] Add validation rules to all form requests
- [ ] Add custom validation messages
- [ ] Add validation error formatting
- [ ] Test all validation works correctly

### B28: Add Output Validation
- [ ] Create API resource classes for consistent responses
- [ ] Add data transformation rules
- [ ] Add pagination handling
- [ ] Test all output validation works correctly

---

## Security Phase

### B29: Implement Rate Limiting
- [ ] Configure rate limiting for authentication endpoints
- [ ] Configure rate limiting for API endpoints
- [ ] Configure rate limiting for unauthenticated requests
- [ ] Test rate limiting works correctly

### B30: Implement CSRF Protection
- [ ] Configure CSRF protection
- [ ] Exclude API endpoints from CSRF
- [ ] Test CSRF protection works correctly

### B31: Implement Password Hashing
- [ ] Configure password hashing with bcrypt
- [ ] Verify passwords are hashed correctly
- [ ] Test password hashing works correctly

### B32: Implement SQL Injection Prevention
- [ ] Verify all queries use parameterized queries
- [ ] Verify Eloquent ORM is used correctly
- [ ] Test SQL injection prevention works correctly

### B33: Implement XSS Prevention
- [ ] Configure XSS prevention
- [ ] Sanitize all input data
- [ ] Test XSS prevention works correctly

---

## Error Handling Phase

### B34: Create Exception Handler
- [ ] Create global exception handler
- [ ] Handle validation exceptions
- [ ] Handle authentication exceptions
- [ ] Handle not found exceptions
- [ ] Handle general exceptions
- [ ] Format error responses consistently
- [ ] Test exception handling works correctly

### B35: Add Logging
- [ ] Configure Laravel logging
- [ ] Add logging to key methods
- [ ] Configure log levels
- [ ] Test logging works correctly

---

## Performance Phase

### B36: Add Database Indexes
- [ ] Verify all foreign keys have indexes
- [ ] Add indexes to frequently queried columns
- [ ] Add composite indexes where needed
- [ ] Test indexes improve performance

### B37: Implement Query Optimization
- [ ] Review all queries for optimization opportunities
- [ ] Implement eager loading for relationships
- [ ] Implement query caching where appropriate
- [ ] Test query optimization works correctly

### B38: Implement API Response Caching
- [ ] Configure caching for Kin endpoints
- [ ] Configure caching for Onda endpoints
- [ ] Implement cache invalidation
- [ ] Test caching works correctly

---

## Testing Phase

### B39: Unit Tests
- [ ] Set up testing framework (PHPUnit)
- [ ] Write unit tests for all services
- [ ] Write unit tests for all models
- [ ] Write unit tests for all controllers
- [ ] Ensure all tests pass

### B40: Integration Tests
- [ ] Write integration tests for API endpoints
- [ ] Write integration tests for database operations
- [ ] Write integration tests for authentication flow
- [ ] Ensure all tests pass

### B41: API Tests
- [ ] Create API test suite
- [ ] Write tests for all endpoints
- [ ] Test all request/response formats
- [ ] Test all error scenarios
- [ ] Ensure all tests pass

---

## Documentation Phase

### B42: Create API Documentation
- [ ] Document all endpoints
- [ ] Document request/response formats
- [ ] Document authentication requirements
- [ ] Document error responses
- [ ] Create API usage examples

### B43: Create Database Documentation
- [ ] Document database schema
- [ ] Document all tables and fields
- [ ] Document relationships
- [ ] Create ER diagram

### B44: Create Deployment Documentation
- [ ] Document environment setup
- [ ] Document deployment process
- [ ] Document environment variables
- [ ] Create troubleshooting guide

---

## Build and Deployment Phase

### B45: Prepare for Production
- [ ] Set production environment
- [ ] Configure production database
- [ ] Configure production email service
- [ ] Configure production Google OAuth
- [ ] Optimize composer autoload
- [ ] Clear all caches

### B46: Deploy to VPS
- [ ] Deploy Laravel application to VPS
- [ ] Configure web server (Nginx/Apache)
- [ ] Configure SSL certificate
- [ ] Configure virtual host
- [ ] Test deployment works correctly

### B47: Run Database Migrations
- [ ] Run migrations on production database
- [ ] Run seeders on production database
- [ ] Verify database is correct
- [ ] Test database operations work correctly

### B48: Configure Queue Workers (Future)
- [ ] Configure queue workers
- [ ] Configure supervisor to manage workers
- [ ] Test queue workers work correctly

---

## Final Phase

### B49: Final Testing and Bug Fixes
- [ ] Conduct full testing of all endpoints
- [ ] Fix any bugs found
- [ ] Re-test all endpoints
- [ ] Verify all acceptance criteria are met

### B50: Performance Optimization
- [ ] Run performance audits
- [ ] Fix any performance issues
- [ ] Verify performance requirements are met
- [ ] Document performance metrics

### B51: Security Review
- [ ] Conduct security review
- [ ] Fix any security issues
- [ ] Verify security requirements are met
- [ ] Document security measures

### B52: Monitoring Setup
- [ ] Set up application monitoring
- [ ] Set up error tracking
- [ ] Set up performance monitoring
- [ ] Test monitoring works correctly

### B53: Final Sign-Off
- [ ] All acceptance criteria met
- [ ] All tests passing
- [ ] Documentation complete
- [ ] Ready for production use

---

## Summary

- **Total Steps**: 53
- **Status**: Not Started
- **Estimated Time**: 5-7 weeks
- **Dependencies**: MySQL database, Email service, Google OAuth credentials

## Notes

- All code must be in English
- All comments must be in English
- Follow Laravel best practices
- Ensure API follows RESTful principles
- Implement proper error handling
- Implement comprehensive validation
- Ensure security best practices
- Optimize database queries
- Implement proper logging
