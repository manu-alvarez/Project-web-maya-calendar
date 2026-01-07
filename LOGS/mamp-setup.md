# MAMP PRO Setup Documentation

## Overview

This document documents the complete setup and configuration of MAMP PRO for the Maya Calendar project.

## Environment Details

### System Information
- **OS**: macOS
- **MAMP PRO Version**: Installed January 2024
- **MAMP Location**: `/Applications/MAMP` and `/Applications/MAMP PRO.app`
- **Status**: Running (verified January 7, 2026)

---

## Service Configurations

### Apache Web Server

**Status**: ✅ Running
- **Process ID**: Multiple httpd processes
- **Config File**: `/Library/Application Support/appsolute/MAMP PRO/conf/httpd.conf`
- **Binary**: `/Applications/MAMP/Library/bin/httpd`

### MySQL Database Server

**Status**: ✅ Running
- **Version**: MySQL 5.7.39
- **Port**: 8889 (non-standard)
- **Socket**: `/Applications/MAMP/tmp/mysql/mysql.sock`
- **Config File**: `/Applications/MAMP/tmp/mysql/my.cnf`
- **Data Directory**: `/Library/Application Support/appsolute/MAMP PRO/db/mysql57`
- **Binary**: `/Applications/MAMP/Library/bin/mysql`
- **PID File**: `/Applications/MAMP/tmp/mysql/mysql.pid`
- **Log File**: `/Applications/MAMP/logs/mysql_error.log`

**Default Credentials**:
- **Username**: `root`
- **Password**: `root`
- **Host**: `localhost` or `127.0.0.1`
- **Port**: `8889`

### PHP

**Status**: ✅ Available
- **Primary Version**: PHP 8.2.0
- **Binary Location**: `/Applications/MAMP/bin/php/php8.2.0/bin/php`
- **All Available Versions**:
  - PHP 5.4.45
  - PHP 5.6.40
  - PHP 7.3.33
  - PHP 7.4.33
  - PHP 8.1.13
  - PHP 8.2.0 (Recommended for Laravel 11)

**PHP Extensions Installed** (Laravel 11 Requirements):
- ✅ PDO
- ✅ PDO_MySQL
- ✅ mysqli
- ✅ json
- ✅ mbstring
- ✅ openssl
- ✅ curl
- ✅ gd
- ✅ intl
- ✅ bcmath
- ✅ xml
- ✅ tokenizer
- ✅ ctype
- ✅ fileinfo

---

## Project Database Setup

### Database: maya_calendar

**Status**: ✅ Created and Ready
- **Database Name**: `maya_calendar`
- **Character Set**: `utf8mb4`
- **Collation**: `utf8mb4_unicode_ci`
- **Created**: January 7, 2026

**Connection Parameters**:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=maya_calendar
DB_USERNAME=root
DB_PASSWORD=root
```

### Creating the Database

```bash
/Applications/MAMP/Library/bin/mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS maya_calendar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Verifying Database

```bash
/Applications/MAMP/Library/bin/mysql -u root -proot -e "SHOW DATABASES LIKE 'maya_calendar';"
```

---

## Composer Setup

### Issue Identified

Composer binary exists in `/Applications/MAMP/bin/php/php8.2.0/bin/composer` but has incorrect shebang pointing to `/usr/bin/env php` instead of full MAMP PHP path.

### Solution Implemented

Created local Composer wrapper script in project root:

**File**: `./composer`
```bash
#!/bin/bash
/Applications/MAMP/bin/php/php8.2.0/bin/php /Applications/MAMP/bin/php/php8.2.0/bin/composer "$@"
```

**Permissions**: Executable (`chmod +x composer`)

**Usage**:
```bash
./composer --version
```

**Output**:
```
Composer version 2.9.3 2025-12-30 13:40:17
PHP version 8.2.0 (/Applications/MAMP/bin/php/php8.2.0/bin/php)
```

---

## Node.js and npm

**Status**: ✅ Installed (Global)
- **Node.js Version**: v24.12.0
- **npm Version**: 11.6.2
- **Installation**: System-wide (not MAMP-specific)

**Usage**:
```bash
node --version
npm --version
```

---

## Laravel Project Configuration

### .env.example Template

```bash
# Application
APP_NAME="Maya Calendar"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=maya_calendar
DB_USERNAME=root
DB_PASSWORD=root

# Laravel-specific (when project is created)
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
LOG_CHANNEL=stack
LOG_LEVEL=debug
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Using MAMP PHP in Laravel Projects

When creating Laravel projects, always use MAMP's PHP:

```bash
# Create Laravel project using MAMP PHP
/Applications/MAMP/bin/php/php8.2.0/bin/php /Users/manu/Code/Project-web-maya-calendar-1/composer create-project laravel/laravel backend

# Run Laravel artisan commands
/Applications/MAMP/bin/php/php8.2.0/bin/php artisan

# Run migrations
/Applications/MAMP/bin/php/php8.2.0/bin/php artisan migrate
```

**Recommended**: Create an alias in your `.zshrc`:

```bash
alias php8='/Applications/MAMP/bin/php/php8.2.0/bin/php'
alias composer8='/Users/manu/Code/Project-web-maya-calendar-1/composer'
```

Then use:
```bash
php8 artisan migrate
composer8 install
```

---

## Vite Frontend Setup

Vite will run independently of MAMP and use system Node.js:

```bash
# In frontend directory
npm install
npm run dev
```

**Default Vite Port**: 5173

---

## Port Configuration

| Service | Port | Notes |
|---------|------|-------|
| Apache (HTTP) | 80 | Standard (may require sudo) |
| Apache (HTTPS) | 443 | Standard (may require sudo) |
| MySQL | 8889 | Non-standard (MAMP default) |
| Vite Dev Server | 5173 | Frontend default |
| Laravel Artisan Server | 8000 | Backend default |

---

## Testing the Setup

### Test MySQL Connection

```bash
/Applications/MAMP/Library/bin/mysql -u root -proot -e "SELECT VERSION();"
```

Expected output:
```
+-----------+
| VERSION() |
+-----------+
| 5.7.39    |
+-----------+
```

### Test PHP Version

```bash
/Applications/MAMP/bin/php/php8.2.0/bin/php -v
```

Expected output:
```
PHP 8.2.0 (cli) (built: Dec  9 2022 09:00:24) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.2.0, Copyright (c) Zend Technologies
```

### Test PHP Extensions

```bash
/Applications/MAMP/bin/php/php8.2.0/bin/php -m | grep -E "(pdo|mysqli|json|mbstring)"
```

Expected output:
```
json
mbstring
mysqli
pdo_mysql
```

### Test Composer

```bash
./composer --version
```

Expected output:
```
Composer version 2.9.3 2025-12-30 13:40:17
PHP version 8.2.0 (/Applications/MAMP/bin/php/php8.2.0/bin/php)
```

---

## Troubleshooting

### Issue: PHP command not found

**Solution**: Use full path to MAMP PHP:
```bash
/Applications/MAMP/bin/php/php8.2.0/bin/php
```

### Issue: Composer not working with Laravel

**Solution**: Use project Composer wrapper:
```bash
./composer require package/name
```

### Issue: MySQL connection refused

**Check**: MAMP MySQL is running:
```bash
ps aux | grep mysql | grep -v grep
```

**Check**: Port 8889 is accessible:
```bash
lsof -i :8889
```

### Issue: Database not found

**Solution**: Create database:
```bash
/Applications/MAMP/Library/bin/mysql -u root -proot -e "CREATE DATABASE maya_calendar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

---

## Security Considerations

### Development Environment

- **MySQL Credentials**: Default `root`/`root` (acceptable for local development)
- **No SSL Required**: Development HTTP is acceptable
- **Debug Mode**: `APP_DEBUG=true` for development

### Production Considerations

When deploying to production:

1. **Change MySQL Password**: Use strong, unique password
2. **Enable HTTPS**: Use SSL certificates (MAMP PRO supports this)
3. **Disable Debug Mode**: `APP_DEBUG=false`
4. **Restrict Database Access**: Firewall rules
5. **Use Environment Variables**: Never commit `.env` file
6. **Change APP_KEY**: Generate unique application key

---

## Next Steps

### Immediate Actions

1. ✅ Composer wrapper created and verified
2. ✅ Database `maya_calendar` created
3. ✅ All services verified and running
4. ⏭️ Create Laravel backend project
5. ⏭️ Create Vite frontend project

### Recommended Workflow

1. **Backend Setup** (Plan B01-B11):
   ```bash
   cd backend
   ../composer create-project laravel/laravel .
   /Applications/MAMP/bin/php/php8.2.0/bin/php artisan key:generate
   ```

2. **Frontend Setup** (Plan F01-F13):
   ```bash
   cd frontend
   npm create vite@latest . -- --template react
   npm install
   ```

3. **Development**:
   ```bash
   # Terminal 1: Backend
   cd backend
   /Applications/MAMP/bin/php/php8.2.0/bin/php artisan serve

   # Terminal 2: Frontend
   cd frontend
   npm run dev
   ```

---

## Summary

### ✅ Verified and Working

- ✅ Apache Web Server
- ✅ MySQL 5.7.39 (port 8889)
- ✅ PHP 8.2.0 with all required extensions
- ✅ Node.js v24.12.0
- ✅ npm 11.6.2
- ✅ Composer 2.9.3 (with wrapper)
- ✅ Database `maya_calendar` created

### 🎯 Ready for Development

All critical infrastructure is in place. The environment is ready to begin the implementation of the Maya Calendar project according to the frontend and backend plans.

### 📝 Important Notes

- Always use MAMP PHP for Laravel commands
- Use project Composer wrapper `./composer`
- MySQL runs on port 8889 (not standard 3306)
- Document all configuration changes in this file
- Never commit actual credentials to version control

---

**Document Version**: 1.0
**Last Updated**: January 7, 2026
**Status**: Environment fully configured and ready for development
