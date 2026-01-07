# Endpoints

## Base URL

- Development: `http://localhost:8000/api`
- Staging: `https://staging.example.com/api`
- Production: `https://example.com/api`

## Authentication Endpoints

### POST /api/register
Register a new user with email and password.

**Request**:
```json
{
  "email": "user@example.com",
  "password": "SecurePassword123!",
  "password_confirmation": "SecurePassword123!",
  "name": "John Doe"
}
```

**Response (201 Created)**:
```json
{
  "message": "Registration successful. Please check your email for OTP verification.",
  "user": {
    "id": 1,
    "email": "user@example.com",
    "name": "John Doe",
    "email_verified": false
  }
}
```

**Errors**:
- 400: Invalid input
- 409: Email already exists

---

### POST /api/verify-otp
Verify email with OTP code.

**Request**:
```json
{
  "email": "user@example.com",
  "otp": "123456"
}
```

**Response (200 OK)**:
```json
{
  "message": "Email verified successfully.",
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "user": {
    "id": 1,
    "email": "user@example.com",
    "name": "John Doe",
    "email_verified": true
  }
}
```

**Errors**:
- 400: Invalid OTP or expired
- 404: User not found

---

### POST /api/login
Login with email and password.

**Request**:
```json
{
  "email": "user@example.com",
  "password": "SecurePassword123!",
  "remember": false
}
```

**Response (200 OK)**:
```json
{
  "message": "Login successful.",
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "user": {
    "id": 1,
    "email": "user@example.com",
    "name": "John Doe",
    "email_verified": true
  }
}
```

**Errors**:
- 401: Invalid credentials
- 403: Email not verified

---

### POST /api/logout
Logout current user.

**Headers**:
```
Authorization: Bearer {token}
```

**Response (200 OK)**:
```json
{
  "message": "Logout successful."
}
```

**Errors**:
- 401: Not authenticated

---

### POST /api/refresh
Refresh authentication token.

**Headers**:
```
Authorization: Bearer {token}
```

**Response (200 OK)**:
```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
}
```

**Errors**:
- 401: Invalid or expired token

---

### GET /api/google/redirect
Redirect to Google OAuth authorization page.

**Query Parameters**:
- `redirect_uri`: URL to redirect after OAuth

**Response (302 Redirect)**:
Redirects to Google OAuth page.

---

### GET /api/google/callback
Handle Google OAuth callback.

**Query Parameters**:
- `code`: OAuth authorization code
- `state`: CSRF token

**Response (200 OK)**:
```json
{
  "message": "Google login successful.",
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "user": {
    "id": 1,
    "email": "user@example.com",
    "name": "John Doe",
    "google_id": "123456789",
    "email_verified": true
  }
}
```

**Errors**:
- 400: OAuth error
- 401: Invalid OAuth code

---

### POST /api/forgot-password
Request password reset email.

**Request**:
```json
{
  "email": "user@example.com"
}
```

**Response (200 OK)**:
```json
{
  "message": "Password reset email sent."
}
```

**Errors**:
- 404: User not found

---

### POST /api/reset-password
Reset password with token.

**Request**:
```json
{
  "token": "reset_token_here",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

**Response (200 OK)**:
```json
{
  "message": "Password reset successful."
}
```

**Errors**:
- 400: Invalid token or passwords don't match
- 404: User not found

---

## Kin Endpoints

### GET /api/kin/today
Get today's Kin.

**Response (200 OK)**:
```json
{
  "date": "2024-01-07",
  "kin": {
    "id": 1,
    "kin_number": 1,
    "solar_seal": "Dragón Rojo",
    "galactic_tone": 1,
    "tone_name": "Magnético",
    "color": "Rojo",
    "description": "Descripción del Kin...",
    "interpretation": "Interpretación extensa...",
    "personal_application": "Aplicación personal...",
    "guide": {
      "kin_number": 13,
      "solar_seal": "Semilla Amarilla"
    },
    "analog": {
      "kin_number": 1,
      "solar_seal": "Dragón Rojo"
    },
    "antipode": {
      "kin_number": 7,
      "solar_seal": "Mono Azul"
    },
    "occult": {
      "kin_number": 13,
      "solar_seal": "Semilla Amarilla"
    }
  }
}
```

---

### GET /api/kin/{date}
Get Kin for a specific date.

**Path Parameters**:
- `date`: Date in YYYY-MM-DD format

**Response (200 OK)**:
```json
{
  "date": "2024-01-07",
  "kin": {
    "id": 1,
    "kin_number": 1,
    "solar_seal": "Dragón Rojo",
    "galactic_tone": 1,
    "tone_name": "Magnético",
    "color": "Rojo",
    "description": "Descripción del Kin...",
    "interpretation": "Interpretación extensa...",
    "personal_application": "Aplicación personal...",
    "guide": {
      "kin_number": 13,
      "solar_seal": "Semilla Amarilla"
    },
    "analog": {
      "kin_number": 1,
      "solar_seal": "Dragón Rojo"
    },
    "antipode": {
      "kin_number": 7,
      "solar_seal": "Mono Azul"
    },
    "occult": {
      "kin_number": 13,
      "solar_seal": "Semilla Amarilla"
    }
  }
}
```

**Errors**:
- 400: Invalid date format

---

## Onda Encantada Endpoints

### GET /api/onda/{date}
Get Encanted Wave for a specific date.

**Path Parameters**:
- `date`: Date in YYYY-MM-DD format

**Response (200 OK)**:
```json
{
  "date": "2024-01-07",
  "onda": {
    "id": 1,
    "onda_number": 1,
    "purpose_kin": {
      "kin_number": 1,
      "solar_seal": "Dragón Rojo",
      "galactic_tone": 1,
      "tone_name": "Magnético"
    },
    "challenge_kin": {
      "kin_number": 1,
      "solar_seal": "Dragón Rojo",
      "galactic_tone": 1,
      "tone_name": "Magnético"
    },
    "service_kin": {
      "kin_number": 1,
      "solar_seal": "Dragón Rojo",
      "galactic_tone": 1,
      "tone_name": "Magnético"
    },
    "kins": [
      {
        "position": 1,
        "kin_number": 1,
        "solar_seal": "Dragón Rojo",
        "galactic_tone": 1,
        "tone_name": "Magnético",
        "color": "Rojo"
      },
      {
        "position": 2,
        "kin_number": 2,
        "solar_seal": "Viento Blanco",
        "galactic_tone": 2,
        "tone_name": "Lunar",
        "color": "Blanco"
      }
      // ... remaining 11 Kins
    ],
    "interpretation": "Interpretación de la onda encantada..."
  }
}
```

**Errors**:
- 400: Invalid date format

---

### GET /api/onda/{date}/kins
Get all Kins in Encanted Wave with detailed information.

**Path Parameters**:
- `date`: Date in YYYY-MM-DD format

**Response (200 OK)**:
```json
{
  "date": "2024-01-07",
  "kins": [
    {
      "position": 1,
      "kin": {
        "kin_number": 1,
        "solar_seal": "Dragón Rojo",
        "galactic_tone": 1,
        "tone_name": "Magnético",
        "color": "Rojo",
        "description": "Descripción del Kin...",
        "interpretation": "Interpretación...",
        "personal_application": "Aplicación personal..."
      }
    },
    {
      "position": 2,
      "kin": {
        "kin_number": 2,
        "solar_seal": "Viento Blanco",
        "galactic_tone": 2,
        "tone_name": "Lunar",
        "color": "Blanco",
        "description": "Descripción del Kin...",
        "interpretation": "Interpretación...",
        "personal_application": "Aplicación personal..."
      }
    }
    // ... remaining 11 Kins
  ]
}
```

**Errors**:
- 400: Invalid date format

---

## User Endpoints

### GET /api/user/profile
Get current user profile.

**Headers**:
```
Authorization: Bearer {token}
```

**Response (200 OK)**:
```json
{
  "user": {
    "id": 1,
    "email": "user@example.com",
    "name": "John Doe",
    "google_id": null,
    "email_verified": true,
    "created_at": "2024-01-07T10:00:00Z"
  }
}
```

**Errors**:
- 401: Not authenticated

---

### PUT /api/user/profile
Update current user profile.

**Headers**:
```
Authorization: Bearer {token}
```

**Request**:
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com"
}
```

**Response (200 OK)**:
```json
{
  "message": "Profile updated successfully.",
  "user": {
    "id": 1,
    "email": "jane@example.com",
    "name": "Jane Doe",
    "google_id": null,
    "email_verified": true,
    "created_at": "2024-01-07T10:00:00Z"
  }
}
```

**Errors**:
- 401: Not authenticated
- 400: Invalid input

---

### GET /api/user/saved-dates
Get all saved dates for current user.

**Headers**:
```
Authorization: Bearer {token}
```

**Query Parameters**:
- `month`: Filter by month (YYYY-MM) (optional)
- `sort`: Sort order (date, created_at) (optional, default: date)

**Response (200 OK)**:
```json
{
  "saved_dates": [
    {
      "id": 1,
      "fecha": "2024-01-07",
      "nota": "My birthday",
      "created_at": "2024-01-07T10:00:00Z"
    },
    {
      "id": 2,
      "fecha": "2024-02-14",
      "nota": "Anniversary",
      "created_at": "2024-01-07T11:00:00Z"
    }
  ]
}
```

**Errors**:
- 401: Not authenticated

---

### POST /api/user/saved-dates
Save a date for current user.

**Headers**:
```
Authorization: Bearer {token}
```

**Request**:
```json
{
  "fecha": "2024-01-07",
  "nota": "Special day"
}
```

**Response (201 Created)**:
```json
{
  "message": "Date saved successfully.",
  "saved_date": {
    "id": 1,
    "fecha": "2024-01-07",
    "nota": "Special day",
    "created_at": "2024-01-07T10:00:00Z"
  }
}
```

**Errors**:
- 401: Not authenticated
- 400: Invalid input

---

### DELETE /api/user/saved-dates/{id}
Delete a saved date.

**Headers**:
```
Authorization: Bearer {token}
```

**Path Parameters**:
- `id`: Saved date ID

**Response (200 OK)**:
```json
{
  "message": "Date deleted successfully."
}
```

**Errors**:
- 401: Not authenticated
- 403: Not owner of saved date
- 404: Saved date not found

---

### GET /api/user/reminders
Get all reminders for current user.

**Headers**:
```
Authorization: Bearer {token}
```

**Query Parameters**:
- `status`: Filter by status (upcoming, completed, all) (optional, default: upcoming)
- `sort`: Sort order (date, created_at) (optional, default: date)

**Response (200 OK)**:
```json
{
  "reminders": [
    {
      "id": 1,
      "fecha": "2024-01-07",
      "hora": "09:00:00",
      "titulo": "Check Kin",
      "descripcion": "Remember to check today's Kin",
      "enviado": false,
      "created_at": "2024-01-07T10:00:00Z"
    },
    {
      "id": 2,
      "fecha": "2024-01-15",
      "hora": null,
      "titulo": "Anniversary",
      "descripcion": "Our anniversary",
      "enviado": false,
      "created_at": "2024-01-07T11:00:00Z"
    }
  ]
}
```

**Errors**:
- 401: Not authenticated

---

### POST /api/user/reminders
Create a new reminder.

**Headers**:
```
Authorization: Bearer {token}
```

**Request**:
```json
{
  "fecha": "2024-01-07",
  "hora": "09:00:00",
  "titulo": "Check Kin",
  "descripcion": "Remember to check today's Kin"
}
```

**Response (201 Created)**:
```json
{
  "message": "Reminder created successfully.",
  "reminder": {
    "id": 1,
    "fecha": "2024-01-07",
    "hora": "09:00:00",
    "titulo": "Check Kin",
    "descripcion": "Remember to check today's Kin",
    "enviado": false,
    "created_at": "2024-01-07T10:00:00Z"
  }
}
```

**Errors**:
- 401: Not authenticated
- 400: Invalid input

---

### PUT /api/user/reminders/{id}
Update an existing reminder.

**Headers**:
```
Authorization: Bearer {token}
```

**Path Parameters**:
- `id`: Reminder ID

**Request**:
```json
{
  "fecha": "2024-01-08",
  "hora": "10:00:00",
  "titulo": "Check Kin - Updated",
  "descripcion": "Updated reminder description",
  "enviado": false
}
```

**Response (200 OK)**:
```json
{
  "message": "Reminder updated successfully.",
  "reminder": {
    "id": 1,
    "fecha": "2024-01-08",
    "hora": "10:00:00",
    "titulo": "Check Kin - Updated",
    "descripcion": "Updated reminder description",
    "enviado": false,
    "created_at": "2024-01-07T10:00:00Z"
  }
}
```

**Errors**:
- 401: Not authenticated
- 403: Not owner of reminder
- 404: Reminder not found
- 400: Invalid input

---

### DELETE /api/user/reminders/{id}
Delete a reminder.

**Headers**:
```
Authorization: Bearer {token}
```

**Path Parameters**:
- `id`: Reminder ID

**Response (200 OK)**:
```json
{
  "message": "Reminder deleted successfully."
}
```

**Errors**:
- 401: Not authenticated
- 403: Not owner of reminder
- 404: Reminder not found

---

## Error Response Format

All error responses follow this format:

```json
{
  "message": "Error description",
  "errors": {
    "field": ["Error message for field"]
  }
}
```

**HTTP Status Codes**:
- 200: Success
- 201: Created
- 204: No Content
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 409: Conflict
- 422: Unprocessable Entity
- 429: Too Many Requests
- 500: Internal Server Error

---

## Rate Limiting

- Unauthenticated endpoints: 100 requests per 15 minutes per IP
- Authenticated endpoints: 1000 requests per 15 minutes per user
- Authentication endpoints: 5 attempts per 15 minutes per IP

---

## Pagination

Endpoints that return lists support pagination:

**Query Parameters**:
- `page`: Page number (default: 1)
- `per_page`: Items per page (default: 20, max: 100)

**Response Headers**:
- `X-Total-Count`: Total number of items
- `X-Total-Pages`: Total number of pages
- `X-Current-Page`: Current page number
- `X-Per-Page`: Items per page
