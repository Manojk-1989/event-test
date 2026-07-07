# Event Management API

A RESTful Event Management API built using **Laravel 13** with **Laravel Sanctum authentication**.

This project provides APIs for:

- User registration
- User login/logout
- Token-based authentication
- Password reset
- Event management
- Event participant registration
- Event participant cancellation

---

## Technology Stack

- **Framework:** Laravel 13
- **PHP Version:** 8.3+
- **Database:** MySQL
- **Server Environment:** WAMP Server
- **Authentication:** Laravel Sanctum
- **Architecture:** Service Layer Pattern
- **API Versioning:** v1

---

# Installation Guide

## 1. Install Required Software

Before setting up the project, install the following:

### PHP 8.3

This project requires PHP 8.3 or higher.

Download and install PHP 8.3 through WAMP Server:

https://www.wampserver.com/

After installation, verify PHP version:

```bash
php -v
```

Expected output:

```
PHP 8.3.x
```

---

## 2. Install Composer

Laravel uses Composer for dependency management.

Download Composer:

https://getcomposer.org/

Verify Composer installation:

```bash
composer -V
```

Example output:

```
Composer version 2.x
```

---

# Project Setup

## 3. Clone Project

Clone the repository:

```bash
git clone https://github.com/Manojk-1989/event-test.git
```

Navigate to project directory:

```bash
cd event-management-api
```

---

## 4. Install Laravel Dependencies

Install required PHP packages:

```bash
composer install
```

---

## 5. Configure Environment File

Copy the example environment file:

```bash
copy .env.example .env
```

For Linux/macOS:

```bash
cp .env.example .env
```

---

## 6. Generate Application Key

Generate Laravel application key:

```bash
php artisan key:generate
```

---

# Database Configuration

## 7. Create Database

Open MySQL using:

- phpMyAdmin
- MySQL Command Line

Create a database:

```sql
CREATE DATABASE event_management;
```

---

## 8. Configure Database Connection

Update `.env` file:

```env
APP_NAME="Event Management API"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_management
DB_USERNAME=root
DB_PASSWORD=
```

> Default WAMP MySQL root user usually has an empty password.

---

# Laravel Setup

## 9. Run Database Migration

Create database tables:

```bash
php artisan migrate
```

---

## 10. Install Laravel Sanctum

Install Sanctum package:

```bash
composer require laravel/sanctum
```

Publish Sanctum configuration:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Run migrations:

```bash
php artisan migrate
```

---

# Run Application

## 11. Start Laravel Development Server

Run:

```bash
php artisan serve
```

Application will start:

```
http://127.0.0.1:8000
```

---

# API Structure

Base URL:

```
http://127.0.0.1:8000/api/v1
```

---

# Authentication APIs

## Register User

```
POST /auth/register
```

Request:

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

---

## Login

```
POST /auth/login
```

Request:

```json
{
    "email": "john@example.com",
    "password": "password"
}
```

Response contains:

```json
{
    "token": "sanctum_token"
}
```

---

## Logout

```
POST /auth/logout
```

Header:

```
Authorization: Bearer {token}
```

---

## Get Authenticated User

```
GET /auth/me
```

---

# Event APIs

## List Events

```
GET /events
```

---

## Create Event

```
POST /events
```

Authentication required.

Request:

```json
{
    "title": "Laravel Workshop",
    "description": "Laravel API Workshop",
    "venue": "Kochi",
    "event_date": "2026-08-20T10:00:00",
    "capacity": 100
}
```

---

## View Event

```
GET /events/{id}
```

---

## Update Event

```
PUT /events/{id}
```

Only event creator can update.

---

## Delete Event

```
DELETE /events/{id}
```

Only event creator can delete.

---

# Participant APIs

## Register User For Event

```
POST /events/{event}/register
```

Authentication required.

---

## List Event Participants

```
GET /events/{event}/participants
```

---

## Cancel Event Registration

```
DELETE /events/{event}/register
```

---

# Project Structure

```
app
│
├── Http
│   ├── Controllers
│   │   └── Api
│   │       └── V1
│   │
│   └── Requests
│
├── Services
│
├── Events
│
├── Listeners
│
└── Jobs
```

---

# Features Implemented

## Authentication

- User Registration
- Login
- Logout
- Sanctum Token Authentication
- Password Reset API

## Event Management

- Create Event
- View Events
- Update Event
- Delete Event

## Participant Management

- Register for Event
- View Participants
- Cancel Registration

---

# Queue Worker

For processing background jobs such as emails:

Run:

```bash
php artisan queue:work
```

---

# Testing API

Recommended tool:

- Postman

Import the provided Postman collection:

```
Event Management API.postman_collection.json
```

---

# Clear Cache Commands

If configuration changes are not reflected:

```bash
php artisan optimize:clear
```

---

# Developer Notes

- Business logic is implemented using Service classes.
- API routes are versioned using `/api/v1`.
- Authentication is handled using Laravel Sanctum.
- Events and queued jobs are used for background email processing.
- Request validation is handled using Form Request classes.

---

# Requirements

| Software | Version |
|----------|---------|
| PHP | 8.3+ |
| Laravel | 13 |
| MySQL | 8+ |
| Composer | 2+ |
| WAMP Server | Latest |
