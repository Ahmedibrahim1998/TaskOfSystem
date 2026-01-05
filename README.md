# Laravel API Project

A RESTful API built with Laravel that includes user authentication, posts management, and comments system.

## Features

- User registration and authentication using Laravel Sanctum
- CRUD operations for posts
- Comments system with relationships
- API Resource for consistent JSON responses
- Input validation with Arabic error messages
- Pagination support

## API Endpoints

### Authentication

- `POST /api/register` - Register a new user
- `POST /api/login` - Login and get authentication token
- `POST /api/logout` - Logout (requires authentication)

### Posts

- `GET /api/posts` - Get all posts (paginated)
- `GET /api/posts/{post}` - Get a single post
- `POST /api/posts` - Create a new post (requires authentication)
- `PUT /api/posts/{post}` - Update a post (requires authentication)
- `DELETE /api/posts/{post}` - Delete a post (requires authentication)

### Comments

- `GET /api/posts/{post}/comments` - Get comments for a post (paginated)
- `POST /api/posts/{post}/comments` - Add a comment to a post (requires authentication)

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install