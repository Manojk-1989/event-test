# Event Management API

A RESTful Event Management API built using **Laravel 13** with **Laravel Sanctum** authentication.

This project provides APIs for:

* User Registration
* User Login / Logout
* Token-based Authentication
* Password Reset
* Event Management (CRUD)
* Event Participant Registration
* Event Participant Cancellation

---

# Technology Stack

* **Framework:** Laravel 13
* **PHP Version:** 8.3+
* **Database:** MySQL
* **Server Environment:** WAMP Server
* **Authentication:** Laravel Sanctum
* **API Documentation:** Scramble
* **Architecture:** Service Layer Pattern
* **API Versioning:** v1

---

# Installation Guide

## 1. Install Required Software

Before setting up the project, install the following software:

* WAMP Server
* PHP 8.3+
* Composer
* MySQL
* Git
* Postman (Optional for API Testing)

---

## PHP 8.3 Installation

This project requires **PHP 8.3 or higher**.

Download and install WAMP Server:

https://www.wampserver.com/

Verify the PHP version:

```bash
php -v
```

Expected output:

```
PHP 8.3.x
```

---

# Composer Installation

Laravel uses Composer for dependency management.

Download Composer:

https://getcomposer.org/

Verify installation:

```bash
composer -V
```

Expected output:

```
Composer version 2.x
```

---

# Project Setup

## 1. Clone Repository

```bash
git clone https://github.com/Manojk-1989/event-test.git
```

Navigate into the project:

```bash
cd event-test
```

---

## 2. Install Dependencies

```bash
composer install
```

---

## 3. Configure Environment File

Windows

```bash
copy .env.example .env
```

Linux/macOS

```bash
cp .env.example .env
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

# Database Configuration

## 5. Create Database

Create a MySQL database:

```sql
CREATE DATABASE event_management;
```

---

## 6. Configure Database

Update your `.env` file:

```env
APP_NAME="Event Management API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_management
DB_USERNAME=root
DB_PASSWORD=
```

> WAMP Server uses an empty password for the MySQL root user by default.

---

# Laravel Setup

## 7. Install Laravel Sanctum

```bash
composer require laravel/sanctum
```

Publish Sanctum configuration:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## 8. Run Database Migration & Seeder

```bash
php artisan migratephp artisan migrate --seed

If you want to recreate the database from scratch:

php artisan migrate:fresh --seed
```

---

# Run Application

Start the Laravel development server:

```bash
php artisan serve
```

Application URL:

```
http://127.0.0.1:8000
```

---

# Demo Credentials

After running the database seeder, use the following credentials to test the authentication APIs:

Email

admin@gmail.com

Password

password

You can use these credentials to:

Login
Create Events
Update Events
Delete Events
Register for Events
Cancel Event Registration
Test all protected API endpoints

# API Documentation

This project uses **Scramble** to automatically generate interactive API documentation.

After starting the application, open:

```
http://127.0.0.1:8000/docs/api
```

The documentation includes:

* Interactive API Explorer
* Request & Response Schemas
* Authentication Information
* Validation Rules
* Route Parameters
* OpenAPI Specification

---

# API Structure

Base URL

```
http://127.0.0.1:8000/api/v1
```

---

# Authentication APIs

| Method | Endpoint              |
| ------ | --------------------- |
| POST   | /auth/register        |
| POST   | /auth/login           |
| POST   | /auth/logout          |
| GET    | /auth/me              |
| POST   | /auth/forgot-password |
| POST   | /auth/reset-password  |

---

# Event APIs

| Method | Endpoint     |
| ------ | ------------ |
| GET    | /events      |
| POST   | /events      |
| GET    | /events/{id} |
| PUT    | /events/{id} |
| DELETE | /events/{id} |

---

# Participant APIs

| Method | Endpoint                     |
| ------ | ---------------------------- |
| POST   | /events/{event}/register     |
| GET    | /events/{event}/participants |
| DELETE | /events/{event}/register     |

---

# Project Structure

```
event-test

│
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   └── Api
│   │   │       └── V1
│   │   └── Requests
│   │
│   ├── Services
│   ├── Events
│   ├── Listeners
│   └── Jobs
│
├── config
├── database
├── routes
├── resources
├── storage
│
├── Event-test.postman_collection.json
├── .env.example
├── composer.json
├── artisan
└── README.md
```

---

# Features Implemented

## Authentication

* User Registration
* Login
* Logout
* Laravel Sanctum Authentication
* Password Reset
* User Registered Event
* Password Reset Event
* Queue-based Email Processing

---

## Event Management

* Create Event
* List Events
* View Single Event
* Update Event
* Delete Event

---

## Participant Management

* Register User for Event
* View Event Participants
* Cancel Event Registration

---

## API Documentation

* Interactive API Documentation using Scramble
* Automatic Request Validation Documentation
* Automatic Response Documentation
* OpenAPI-based Documentation

---

# Queue Worker

Background jobs are used for sending emails.

Start the queue worker:

```bash
php artisan queue:work
```

---

# Postman Collection

A Postman collection is included for testing all API endpoints.

Collection file:

```
Event-test.postman_collection.json
```

Location:

```
event-test/
├── Event-test.postman_collection.json
```

## Import Steps

1. Open Postman.
2. Click **Import**.
3. Select:

```
Event-test.postman_collection.json
```

4. Click **Import**.

The collection includes:

### Authentication

* Register
* Login
* Logout
* Forgot Password
* Reset Password
* Get Authenticated User

### Events

* List Events
* Create Event
* View Event
* Update Event
* Delete Event

### Participants

* Register User for Event
* List Event Participants
* Cancel Event Registration

---

# Useful Artisan Commands

Clear all caches:

```bash
php artisan optimize:clear
```

Generate application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Start development server:

```bash
php artisan serve
```

Start queue worker:

```bash
php artisan queue:work
```

---

# Developer Notes

* Business logic is implemented using Service classes.
* API routes are versioned under `/api/v1`.
* Authentication is handled using Laravel Sanctum.
* Validation is handled using Form Request classes.
* Events and queued jobs are used for background email processing.
* Controllers are responsible only for handling HTTP requests and responses.
* Service classes encapsulate business logic.
* Interactive API documentation is automatically generated using Scramble.

---

# Requirements

| Software    | Version |
| ----------- | ------- |
| PHP         | 8.3+    |
| Laravel     | 13      |
| MySQL       | 8+      |
| Composer    | 2+      |
| WAMP Server | Latest  |
| Postman     | Latest  |
| Scramble    | Latest  |
