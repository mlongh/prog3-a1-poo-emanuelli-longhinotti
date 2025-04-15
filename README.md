# PHP Authentication System

A simple and secure PHP-based authentication system that provides user registration, login, and session management functionality.

## Features

- User Registration
- User Login/Logout
- Session Management
- Display of Registered Users
- Secure Password Hashing
- XSS Protection

## Requirements

- PHP 7.4 or higher
- XAMPP/Apache Web Server
- Session support enabled in PHP

## Installation

1. Clone or download this repository to your XAMPP's htdocs directory:
   ```bash
   C:/xampp/htdocs/auth_system/
   ```

2. Start your XAMPP Apache server

3. Access the application through your web browser:
   ```
   http://localhost/auth_system/
   ```

## Project Structure

```
auth_system/
├── classes/
│   ├── Authenticator.php  # Main authentication logic
│   ├── Session.php        # Session management
│   └── User.php          # User related functionality
├── README.md
└── logout.php
```

## Usage

### Registration
```php
$result = Authenticator::register($name, $email, $password);
// Returns true if registration successful, false if email already exists
```

### Login
```php
$user = Authenticator::login($email, $password);
// Returns user array if successful, null if failed
```

### Logout
```php
Authenticator::logout();
// Destroys the session and logs out the user
```

### Get Current User
```php
$currentUser = Authenticator::getCurrentUser();
// Returns current logged-in user or null
```

### Get All Users (for development propouses only)
```php
$allUsers = Authenticator::getAllUsers();
// Returns array of all registered users
```

## Security Features

- Passwords are securely hashed using PHP's `password_hash()` function
- Session management with proper session destruction on logout
- XSS protection through `htmlspecialchars()` when displaying user data
- Email uniqueness validation during registration

## Session Management

The system uses PHP's built-in session management with additional security measures:
- Automatic session starting when needed
- Complete session destruction on logout
- Session state checking