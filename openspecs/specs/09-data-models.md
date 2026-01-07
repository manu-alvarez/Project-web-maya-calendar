# Data Models

## Entity-Relationship Diagram

```
┌─────────────┐
│    users    │
└──────┬──────┘
       │ 1
       │
       │ 1:N
       │
┌──────▼──────────┐
│fechas_guardadas  │
└─────────────────┘

┌─────────────┐
│    users    │
└──────┬──────┘
       │ 1
       │
       │ 1:N
       │
┌──────▼──────────┐
│ recordatorios   │
└─────────────────┘

┌─────────────┐
│    kins     │
└──────┬──────┘
       │ 1
       │
       │ 1:N
       │
┌──────▼──────────┐
│  onda_kins     │
└──────┬─────────┘
       │ N
       │
       │ 1
┌──────▼──────┐
│   ondas     │
└─────────────┘

┌─────────────┐
│    kins     │
└──────┬──────┘
       │ 1
       │
       │ 1:1 (self-reference)
       │
┌──────▼──────┐
│    kins     │ (guide, analog, antipode, occult)
└─────────────┘
```

## Models

### User

**Table**: `users`

**Attributes**:
| Field | Type | Constraints | Description |
|-------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| email | VARCHAR(255) | UNIQUE, NOT NULL | User email address |
| password | VARCHAR(255) | NULL (for Google users) | Hashed password |
| google_id | VARCHAR(255) | UNIQUE, NULL | Google OAuth ID |
| name | VARCHAR(255) | NOT NULL | User's display name |
| email_verified_at | TIMESTAMP | NULL | Email verification timestamp |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Account creation time |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Last update time |

**Relationships**:
- Has Many: `fechas_guardadas`
- Has Many: `recordatorios`

**Validation Rules**:
- Email: Valid email format, unique
- Password: Minimum 8 characters, at least one uppercase, one lowercase, one number
- Name: Required, min 2 characters

**Indexes**:
- `idx_email` on `email`
- `idx_google_id` on `google_id`

---

### Kin

**Table**: `kins`

**Attributes**:
| Field | Type | Constraints | Description |
|-------|------|-------------|-------------|
| id | INT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| kin_number | INT | UNIQUE, NOT NULL | Kin number (1-260) |
| solar_seal | VARCHAR(100) | NOT NULL | Solar seal name |
| galactic_tone | INT | NOT NULL | Galactic tone (1-13) |
| color | VARCHAR(50) | NOT NULL | Kin color |
| guide_kin_id | INT UNSIGNED | FK to kins(id), NULL | Guide Kin reference |
| analog_kin_id | INT UNSIGNED | FK to kins(id), NULL | Analog Kin reference |
| antipode_kin_id | INT UNSIGNED | FK to kins(id), NULL | Antipode Kin reference |
| occult_kin_id | INT UNSIGNED | FK to kins(id), NULL | Occult Kin reference |
| description | TEXT | NOT NULL | Kin description |
| interpretation | TEXT | NOT NULL | Extended interpretation |
| personal_application | TEXT | NOT NULL | Personal application |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Last update time |

**Relationships**:
- Belongs To (self): `guide_kin` (guide relationship)
- Belongs To (self): `analog_kin` (analog relationship)
- Belongs To (self): `antipode_kin` (antipode relationship)
- Belongs To (self): `occult_kin` (occult relationship)
- Has Many: `onda_kins`

**Validation Rules**:
- kin_number: Unique, between 1 and 260
- galactic_tone: Between 1 and 13
- solar_seal: Required, max 100 characters
- description: Required, min 100 characters
- interpretation: Required, min 200 characters
- personal_application: Required, min 100 characters

**Indexes**:
- `idx_kin_number` on `kin_number`

---

### Onda

**Table**: `ondas`

**Attributes**:
| Field | Type | Constraints | Description |
|-------|------|-------------|-------------|
| id | INT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| onda_number | INT | NOT NULL | Onda number |
| purpose_kin_id | INT UNSIGNED | FK to kins(id), NOT NULL | Purpose Kin reference |
| challenge_kin_id | INT UNSIGNED | FK to kins(id), NOT NULL | Challenge Kin reference |
| service_kin_id | INT UNSIGNED | FK to kins(id), NOT NULL | Service Kin reference |
| tone_count | INT | DEFAULT 13 | Number of tones (always 13) |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Record creation time |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Last update time |

**Relationships**:
- Belongs To: `purpose_kin`
- Belongs To: `challenge_kin`
- Belongs To: `service_kin`
- Has Many: `onda_kins`

**Validation Rules**:
- onda_number: Required
- purpose_kin_id: Required, valid Kin
- challenge_kin_id: Required, valid Kin
- service_kin_id: Required, valid Kin

**Indexes**:
- `idx_onda_number` on `onda_number`

---

### OndaKin

**Table**: `onda_kins`

**Attributes**:
| Field | Type | Constraints | Description |
|-------|------|-------------|-------------|
| id | INT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| onda_id | INT UNSIGNED | FK to ondas(id), NOT NULL | Onda reference |
| position | INT | NOT NULL | Position in wave (1-13) |
| kin_id | INT UNSIGNED | FK to kins(id), NOT NULL | Kin reference |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Record creation time |

**Relationships**:
- Belongs To: `onda`
- Belongs To: `kin`

**Validation Rules**:
- onda_id: Required, valid Onda
- position: Required, between 1 and 13
- kin_id: Required, valid Kin
- Unique combination: (onda_id, position) and (onda_id, kin_id)

**Indexes**:
- `idx_onda_id` on `onda_id`
- `idx_position` on `position`

**Composite Indexes**:
- `unique_onda_position` on `(onda_id, position)`
- `unique_onda_kin` on `(onda_id, kin_id)`

---

### FechaGuardada

**Table**: `fechas_guardadas`

**Attributes**:
| Field | Type | Constraints | Description |
|-------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| user_id | BIGINT UNSIGNED | FK to users(id), NOT NULL | User reference |
| fecha | DATE | NOT NULL | Saved date |
| nota | TEXT | NULL | User note |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Save creation time |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Last update time |

**Relationships**:
- Belongs To: `user`

**Validation Rules**:
- user_id: Required, valid User
- fecha: Required, valid date
- nota: Optional, max 1000 characters

**Indexes**:
- `idx_user_id` on `user_id`
- `idx_fecha` on `fecha`

**Cascade Rules**:
- DELETE CASCADE: When user is deleted, all saved dates are deleted

---

### Recordatorio

**Table**: `recordatorios`

**Attributes**:
| Field | Type | Constraints | Description |
|-------|------|-------------|-------------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Unique identifier |
| user_id | BIGINT UNSIGNED | FK to users(id), NOT NULL | User reference |
| fecha | DATE | NOT NULL | Reminder date |
| hora | TIME | NULL | Reminder time (optional) |
| titulo | VARCHAR(255) | NOT NULL | Reminder title |
| descripcion | TEXT | NULL | Reminder description |
| enviado | BOOLEAN | DEFAULT FALSE | Email sent flag |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Reminder creation time |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Last update time |

**Relationships**:
- Belongs To: `user`

**Validation Rules**:
- user_id: Required, valid User
- fecha: Required, valid date
- hora: Optional, valid time if provided
- titulo: Required, min 2 characters, max 255
- descripcion: Optional, max 1000 characters

**Indexes**:
- `idx_user_id` on `user_id`
- `idx_fecha` on `fecha`
- `idx_enviado` on `enviado`

**Cascade Rules**:
- DELETE CASCADE: When user is deleted, all reminders are deleted

---

## Data Integrity

### Foreign Key Constraints

All foreign key relationships are enforced at the database level:
- `kins.guide_kin_id` → `kins.id`
- `kins.analog_kin_id` → `kins.id`
- `kins.antipode_kin_id` → `kins.id`
- `kins.occult_kin_id` → `kins.id`
- `onda_kins.onda_id` → `ondas.id`
- `onda_kins.kin_id` → `kins.id`
- `ondas.purpose_kin_id` → `kins.id`
- `ondas.challenge_kin_id` → `kins.id`
- `ondas.service_kin_id` → `kins.id`
- `fechas_guardadas.user_id` → `users.id`
- `recordatorios.user_id` → `users.id`

### Unique Constraints

- `users.email`: Each email can be registered only once
- `users.google_id`: Each Google ID can be associated with only one account
- `kins.kin_number`: Each Kin number is unique
- `onda_kins(onda_id, position)`: Each position in an Onda is unique
- `onda_kins(onda_id, kin_id)`: Each Kin appears only once in an Onda

### Check Constraints

- `kins.galactic_tone`: Must be between 1 and 13
- `kins.kin_number`: Must be between 1 and 260
- `onda_kins.position`: Must be between 1 and 13
- `recordatorios.enviado`: Must be TRUE or FALSE

---

## Data Migration Strategy

### Version Control
- All schema changes are managed through Laravel migrations
- Migrations are versioned and stored in version control
- Migrations are run in order during deployment

### Rollback Strategy
- All migrations include down() method for rollback
- Rollback is tested in staging before production
- Database backups are created before major migrations

### Data Seeding
- Initial Kin data is seeded from authoritative sources
- Onda data is seeded based on Kin relationships
- Seeding scripts are idempotent (can be run multiple times safely)

---

## Performance Considerations

### Indexing Strategy
- Foreign keys are indexed for JOIN performance
- Frequently queried columns (email, fecha, etc.) are indexed
- Composite indexes for common query patterns

### Query Optimization
- Eager loading (eager loading relationships)
- Pagination for large result sets
- Caching of frequently accessed data (Kins, Ondas)

### Storage Optimization
- TEXT fields for long content (descriptions, interpretations)
- Appropriate data types to minimize storage
- Regular database maintenance (optimize, analyze)

---

## Data Privacy

### Sensitive Data
- Passwords: Hashed with bcrypt, never stored in plain text
- Email: Stored, can be deleted on account deletion
- Google ID: Stored for OAuth, can be deleted on account deletion

### Data Retention
- User data is retained until account deletion
- Deleted accounts: All associated data is deleted within 30 days
- Soft deletes considered for audit trail (future)

### GDPR Compliance
- Users can request data export
- Users can request account deletion
- Data processing is transparent (privacy policy)

---

## Future Extensions

### Planned Models (Not in MVP)
- `notifications`: For email notifications
- `preferences`: User preferences
- `activities`: Activity logging
- `content_versions`: Version tracking for content

### Planned Fields (Not in MVP)
- `users.avatar`: Profile image
- `users.timezone`: User timezone
- `kins.illustration_url`: URL to Kin illustration
- `ondas.description`: Onda description
