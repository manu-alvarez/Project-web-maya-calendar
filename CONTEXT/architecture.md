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

## Frontend (React)

### Technology Stack
- **Framework**: React
- **Build Tool**: Vite
- **UI Library**: Material UI M3 (Material Design 3)
- **State Management**: React Context API / Redux (if needed)
- **Routing**: React Router
- **HTTP Client**: Axios
- **Form Handling**: React Hook Form or Formik
- **Internationalization**: i18next (prepared for future use)

### Key Libraries
- React Router: Routing and navigation
- Axios: API communication
- React Hook Form: Form validation and handling
- i18next: Future i18n support
- Material UI M3: Component library

### Frontend Structure
```
src/
├── components/
│   ├── common/
│   ├── kin/
│   ├── onda/
│   └── user/
├── pages/
│   ├── Home.jsx
│   ├── KinDetail.jsx
│   ├── OndaDetail.jsx
│   ├── Login.jsx
│   ├── Register.jsx
│   ├── Profile.jsx
│   └── ...
├── services/
│   ├── api.js
│   └── auth.js
├── context/
│   ├── AuthContext.jsx
│   └── ThemeContext.jsx
├── utils/
│   ├── helpers.js
│   └── constants.js
├── App.jsx
└── main.jsx
```

## Backend (Laravel)

### Technology Stack
- **Framework**: Laravel 11
- **Language**: PHP
- **Database**: MySQL
- **API Type**: RESTful (API-only mode)
- **Authentication**: Laravel Sanctum / JWT
- **OAuth Integration**: Laravel Socialite

### Backend Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── AuthController.php
│   │   │   ├── KinController.php
│   │   │   ├── OndaController.php
│   │   │   └── UserController.php
│   │   └── ...
│   ├── Middleware/
│   └── Requests/
├── Models/
│   ├── User.php
│   ├── Kin.php
│   ├── Onda.php
│   └── FechaGuardada.php
├── Services/
│   ├── KinService.php
│   ├── OndaService.php
│   └── AuthService.php
└── ...
routes/
├── api.php
└── web.php
```

### API Endpoints

#### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout
- `POST /api/refresh` - Refresh token
- `POST /api/google/callback` - Google OAuth callback
- `POST /api/verify-otp` - OTP verification

#### Kin
- `GET /api/kin/{date}` - Get Kin for specific date
- `GET /api/kin/today` - Get today's Kin

#### Onda Encantada
- `GET /api/onda/{date}` - Get Encanted Wave for specific date

#### User
- `GET /api/user/profile` - Get user profile
- `PUT /api/user/profile` - Update user profile

#### Fechas Guardadas
- `GET /api/fechas/guardadas` - Get saved dates
- `POST /api/fechas/guardadas` - Save a date
- `DELETE /api/fechas/guardadas/{id}` - Remove saved date

#### Recordatorios
- `GET /api/recordatorios` - Get reminders
- `POST /api/recordatorios` - Create reminder
- `PUT /api/recordatorios/{id}` - Update reminder
- `DELETE /api/recordatorios/{id}` - Delete reminder

## Database Schema

### Tables

#### users
```sql
- id (BIGINT, PRIMARY KEY, AUTO_INCREMENT)
- email (VARCHAR, UNIQUE)
- password (VARCHAR, nullable - for Google users)
- google_id (VARCHAR, nullable)
- name (VARCHAR)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
- email_verified_at (TIMESTAMP, nullable)
```

#### kins
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- kin_number (INT, UNIQUE)
- solar_seal (VARCHAR)
- galactic_tone (INT)
- color (VARCHAR)
- guide_kin_id (INT, FOREIGN KEY)
- analog_kin_id (INT, FOREIGN KEY)
- antipode_kin_id (INT, FOREIGN KEY)
- occult_kin_id (INT, FOREIGN KEY)
- description (TEXT)
- interpretation (TEXT)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

#### ondas
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- onda_number (INT)
- purpose_kin_id (INT)
- challenge_kin_id (INT)
- service_kin_id (INT)
- tone_count (INT, DEFAULT 13)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

#### onda_kins
```sql
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- onda_id (INT, FOREIGN KEY)
- position (INT) - 1 to 13
- kin_id (INT, FOREIGN KEY)
- created_at (TIMESTAMP)
```

#### fechas_guardadas
```sql
- id (BIGINT, PRIMARY KEY, AUTO_INCREMENT)
- user_id (BIGINT, FOREIGN KEY)
- fecha (DATE)
- nota (TEXT, nullable)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

#### recordatorios
```sql
- id (BIGINT, PRIMARY KEY, AUTO_INCREMENT)
- user_id (BIGINT, FOREIGN KEY)
- fecha (DATE)
- hora (TIME, nullable)
- titulo (VARCHAR)
- descripcion (TEXT, nullable)
- enviado (BOOLEAN, DEFAULT FALSE)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

## Hosting Infrastructure

### Server Setup (VPS)

#### Web Server
- **Nginx** or **Apache** as reverse proxy
- SSL/TLS with Let's Encrypt (Certbot)

#### Service Separation
- Laravel API served at `/api`
- React SPA served as static content at `/`

#### Configuration
- Domain assignment
- HTTPS enforcement
- CORS configuration for API

### Deployment Strategy

#### Frontend Deployment
- Build React app with Vite
- Serve static files via Nginx/Apache
- Single page application routing handled by web server

#### Backend Deployment
- Laravel API deployed separately
- Environment-specific configuration
- Database migrations
- Queue workers (if needed)

### Security Considerations
- Firewall configuration
- Regular security updates
- SSL/TLS certificates
- API rate limiting
- Input validation and sanitization
- SQL injection prevention
- CSRF protection
- XSS protection

## Scalability Considerations

### Future Enhancements
- Redis for caching
- CDN for static assets
- Load balancing
- Database read replicas
- Queue system for background jobs
- Monitoring and logging (e.g., Sentry, New Relic)

### Performance Optimization
- Database indexing
- API response caching
- Image optimization and lazy loading
- Code splitting in React
- Service worker for PWA capabilities

## Data Flow

### Authentication Flow
1. User submits login/register form
2. Frontend sends request to Laravel API
3. Laravel validates credentials
4. Laravel generates JWT token
5. Frontend stores token (localStorage/cookies)
6. Frontend includes token in API requests
7. Laravel validates token on protected routes

### Kin Query Flow
1. User selects date
2. Frontend sends GET request to `/api/kin/{date}`
3. Laravel calculates/queries Kin data
4. Laravel returns JSON response
5. Frontend displays Kin information

### Onda Encantada Flow
1. User selects date
2. Frontend sends GET request to `/api/onda/{date}`
3. Laravel calculates/queries Onda data
4. Laravel returns JSON response with 13 Kins
5. Frontend displays Onda Encantada information
