<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).














# Logbook Application

A simple application for logging job activities and weights. This README provides instructions for local installation and collaboration.

## Local Installation Guide

Follow these steps to get the project running on your local machine.

1.  **Clone the Repository**
    ```bash
    git clone [https://github.com/your-username/logbook-app.git](https://github.com/your-username/logbook-app.git)
    cd logbook-app
    ```

2.  **Install Dependencies**
    Ensure you have Composer installed.
    ```bash
    composer install
    ```

3.  **Environment Setup**
    Copy the `.env.example` file to `.env` and configure your database credentials.
    ```bash
    cp .env.example .env
    ```
    Then, open `.env` and set `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Run Database Migrations & Seeding**
    This will create the necessary tables and populate them with initial data.
    ```bash
    php artisan migrate --seed
    ```

6.  **Start the Development Server**
    ```bash
    php artisan serve
    ```
    The application will be available at `http://127.0.0.1:8000`.

---

## Live Share Guide (VS Code)

To collaborate in real-time:

**To Host a Session:**
1.  Open the project in VS Code.
2.  Click the "Live Share" icon in the activity bar on the left.
3.  Click "Start collaboration session".
4.  An invitation link will be copied to your clipboard. Share this link with your collaborators.

**To Join a Session:**
1.  Click the "Live Share" icon in the activity bar.
2.  Click "Join collaboration session".
3.  Paste the invitation link you received and press Enter.

---

## Acceptance Criteria & Demo Script

### Acceptance Criteria
-   **Given** I am an admin on the `/logbook/admin` page,
    **When** I change a job's weight and click "Submit",
    **Then** a `PATCH` request is sent to `/api/activities/{id}` and a success message is shown.

-   **Given** an API request is sent with invalid data (e.g., negative weight),
    **When** the `/api/activities/{id}` endpoint is hit,
    **Then** the server should respond with a `422 Unprocessable Entity` status and error details.

-   **Given** I am a developer,
    **When** I run `php artisan test`,
    **Then** all unit and feature tests should pass successfully.

### Demo Script for Handoff
1.  **"First, let's look at the admin panel."** (Show `admin.blade.php` in the browser).
2.  **"As an admin, I can modify the details of this activity. I'll change the weight from 15 to 25."** (Change the value in the form).
3.  **"When I click submit, notice the success message appears."** (Click submit and point to the green feedback box).
4.  **"This action sent a PATCH request to our API to create a change request. We can see the network call and the JSON payload here in the browser's developer tools."** (Show the network tab).
5.  **"To ensure our logic is sound, we've created automated tests. Here's a unit test for our percentage calculator..."** (Show `PercentCalcTest.php` and run `php artisan test --filter PercentCalcTest`).
6.  **"...and here is our feature test that simulates the exact API call we just performed."** (Show the feature test file and run it).
7.  **"Finally, all documentation, including the API contract and setup instructions, is available in the project's `README.md` and `/docs` folder for the next team."** (Briefly show the documentation files).
