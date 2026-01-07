# Architecture

## System Overview

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

## Architectural Decisions

### 1. Decoupled Architecture

**Rationale**: Separate frontend and backend allows independent development, scaling, and deployment.

**Benefits**:
- Frontend and backend can be developed in parallel
- Easier to scale individual components
- API can be reused by multiple clients (future mobile apps)
- Clear separation of concerns

### 2. RESTful API

**Rationale**: REST is well-understood, stateless, and cacheable.

**Benefits**:
- Standardized approach
- Easy to test and debug
- Good performance with caching
- Stateless (no server session storage needed)

### 3. Laravel as Backend Framework

**Rationale**: Laravel provides robust, feature-rich PHP development.

**Benefits**:
- Built-in authentication and authorization
- Eloquent ORM for database operations
- Migration system for database versioning
- Security features out of the box
- Large community and ecosystem

### 4. React with Vite as Frontend

**Rationale**: Modern, fast, and excellent developer experience.

**Benefits**:
- Component-based architecture
- Fast development with hot module replacement
- Large ecosystem of libraries
- Excellent performance with Vite
- Easy to find React developers

### 5. Material UI M3

**Rationale**: Comprehensive, accessible, and consistent component library.

**Benefits**:
- Pre-built components following Material Design
- Built-in accessibility
- Customizable theming system
- Active maintenance
- Consistent look and feel

## Frontend Architecture

### Technology Stack
- React 18+
- Vite for building
- Material UI M3 (Material Design 3)
- React Router for routing
- Axios for API communication
- React Context API for state management

### Component Structure
```
src/
├── components/
│   ├── common/
│   │   ├── AppBar/
│   │   ├── Button/
│   │   ├── TextField/
│   │   ├── Snackbar/
│   │   └── LoadingSpinner/
│   ├── kin/
│   │   ├── CardKin/
│   │   ├── KinDetail/
│   │   └── KinRelations/
│   ├── onda/
│   │   ├── CardOnda/
│   │   ├── OndaGrid/
│   │   └── OndaDetail/
│   └── user/
│       ├── UserProfile/
│       ├── SavedDates/
│       └── Reminders/
├── pages/
│   ├── Home/
│   ├── KinDetail/
│   ├── OndaDetail/
│   ├── Login/
│   ├── Register/
│   ├── Profile/
│   ├── Favorites/
│   └── Reminders/
├── services/
│   ├── api.js
│   └── auth.js
├── context/
│   ├── AuthContext.jsx
│   └── ThemeContext.jsx
├── utils/
│   ├── helpers.js
│   └── constants.js
├── hooks/
│   └── useAuth.js
├── App.jsx
└── main.jsx
```

### State Management Strategy
- **Global State**: React Context API for authentication and theme
- **Local State**: Component-level state for UI interactions
- **Server State**: Axios with caching strategies for API data
- **Future**: Redux if state complexity increases

### Routing Strategy
- React Router for client-side routing
- Protected routes with AuthGuard component
- Lazy loading for code splitting
- SEO-friendly with meta tag management

## Backend Architecture

### Technology Stack
- Laravel 11
- PHP 8.2+
- MySQL 8.0+
- Laravel Sanctum for API authentication
- Laravel Socialite for OAuth

### API Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── AuthController.php
│   │       ├── KinController.php
│   │       ├── OndaController.php
│   │       └── UserController.php
│   ├── Middleware/
│   │   ├── ApiAuth.php
│   │   ├── AdminAuth.php
│   │   └── RateLimit.php
│   └── Requests/
│       ├── RegisterRequest.php
│       ├── LoginRequest.php
│       └── KinRequest.php
├── Models/
│   ├── User.php
│   ├── Kin.php
│   ├── Onda.php
│   ├── OndaKin.php
│   ├── FechaGuardada.php
│   └── Recordatorio.php
├── Services/
│   ├── KinService.php
│   ├── OndaService.php
│   ├── AuthService.php
│   └── EmailService.php
├── Jobs/
│   └── SendEmailJob.php
└── Exceptions/
    └── Handler.php
```

### API Endpoints

#### Authentication
- POST /api/register
- POST /api/login
- POST /api/logout
- POST /api/refresh
- POST /api/forgot-password
- POST /api/reset-password
- POST /api/verify-otp
- GET /api/google/redirect
- GET /api/google/callback

#### Kin
- GET /api/kin/today
- GET /api/kin/{date}
- GET /api/kin/{date}/relations

#### Onda Encantada
- GET /api/onda/{date}
- GET /api/onda/{date}/kins

#### User
- GET /api/user/profile
- PUT /api/user/profile
- GET /api/user/saved-dates
- POST /api/user/saved-dates
- DELETE /api/user/saved-dates/{id}
- GET /api/user/reminders
- POST /api/user/reminders
- PUT /api/user/reminders/{id}
- DELETE /api/user/reminders/{id}

### Service Layer Pattern

**Rationale**: Separate business logic from controllers for better testability and reusability.

**Structure**:
- Controllers handle HTTP requests/responses
- Services contain business logic
- Models handle database operations

**Benefits**:
- Single Responsibility Principle
- Easier to test
- Reusable logic across multiple controllers
- Cleaner controllers

## Database Architecture

### Database Design

#### users
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NULL,
    google_id VARCHAR(255) NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    email_verified_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_google_id (google_id)
);
```

#### kins
```sql
CREATE TABLE kins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kin_number INT UNIQUE NOT NULL,
    solar_seal VARCHAR(100) NOT NULL,
    galactic_tone INT NOT NULL,
    color VARCHAR(50) NOT NULL,
    guide_kin_id INT UNSIGNED NULL,
    analog_kin_id INT UNSIGNED NULL,
    antipode_kin_id INT UNSIGNED NULL,
    occult_kin_id INT UNSIGNED NULL,
    description TEXT NOT NULL,
    interpretation TEXT NOT NULL,
    personal_application TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_kin_number (kin_number),
    FOREIGN KEY (guide_kin_id) REFERENCES kins(id),
    FOREIGN KEY (analog_kin_id) REFERENCES kins(id),
    FOREIGN KEY (antipode_kin_id) REFERENCES kins(id),
    FOREIGN KEY (occult_kin_id) REFERENCES kins(id)
);
```

#### ondas
```sql
CREATE TABLE ondas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    onda_number INT NOT NULL,
    purpose_kin_id INT UNSIGNED NOT NULL,
    challenge_kin_id INT UNSIGNED NOT NULL,
    service_kin_id INT UNSIGNED NOT NULL,
    tone_count INT DEFAULT 13,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_onda_number (onda_number),
    FOREIGN KEY (purpose_kin_id) REFERENCES kins(id),
    FOREIGN KEY (challenge_kin_id) REFERENCES kins(id),
    FOREIGN KEY (service_kin_id) REFERENCES kins(id)
);
```

#### onda_kins
```sql
CREATE TABLE onda_kins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    onda_id INT UNSIGNED NOT NULL,
    position INT NOT NULL,
    kin_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_onda_id (onda_id),
    INDEX idx_position (position),
    FOREIGN KEY (onda_id) REFERENCES ondas(id) ON DELETE CASCADE,
    FOREIGN KEY (kin_id) REFERENCES kins(id)
);
```

#### fechas_guardadas
```sql
CREATE TABLE fechas_guardadas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    fecha DATE NOT NULL,
    nota TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_fecha (fecha),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

#### recordatorios
```sql
CREATE TABLE recordatorios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NULL,
    enviado BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_fecha (fecha),
    INDEX idx_enviado (enviado),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Database Optimization
- Indexes on frequently queried columns
- Foreign key constraints for referential integrity
- Proper data types for storage efficiency
- Query optimization with EXPLAIN analysis

## Security Architecture

### Authentication
- JWT tokens for stateless authentication
- Token expiration with refresh mechanism
- Secure password hashing (bcrypt)
- OTP for email verification

### Authorization
- Middleware-based route protection
- Role-based access control (future)
- Resource ownership validation

### Security Best Practices
- HTTPS only in production
- CORS configuration
- CSRF protection
- SQL injection prevention (parameterized queries)
- XSS prevention (input sanitization)
- Rate limiting on authentication endpoints
- Secure headers (CSP, HSTS, etc.)

## Deployment Architecture

### Server Configuration
- VPS with Ubuntu/Debian
- Nginx or Apache as web server
- PHP-FPM for Laravel
- MySQL database server

### Web Server Setup
- Laravel API served at /api
- React SPA served as static files at /
- Let's Encrypt for HTTPS
- Reverse proxy configuration

### Environment Management
- Separate environments: development, staging, production
- Environment variables for sensitive data
- Configuration management

### CI/CD Pipeline (Future)
- Automated testing
- Automated deployment
- Database migrations
- Rollback capabilities

## Scalability Considerations

### Horizontal Scaling
- Stateless API allows multiple instances
- Load balancer distribution
- Database read replicas

### Vertical Scaling
- Server upgrade path
- Database optimization
- Caching strategies

### Caching Strategy
- Redis for caching (future)
- HTTP caching headers
- Service worker for offline support

### Monitoring & Logging
- Application logging
- Error tracking (Sentry, etc.)
- Performance monitoring
- Uptime monitoring

## Technology Rationale Summary

| Technology | Why Chosen |
|------------|-------------|
| React + Vite | Fast, modern, excellent DX |
| Material UI M3 | Consistent, accessible, customizable |
| Laravel | Robust, feature-rich, secure |
| MySQL | Reliable, well-supported, performant |
| REST API | Standard, stateless, cacheable |
| JWT | Stateless, scalable authentication |
| VPS | Full control, cost-effective |
