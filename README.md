# Chat Application API

This is a Chat Application API built using Laravel Sanctum for authentication. The application allows users to register, login, create chat rooms, send messages, and communicate with friends. Additionally, it supports third-party authentication via Google and Facebook.

## Features

- User registration and authentication
- Third-party authentication (Google, Facebook)
- Create and manage chat rooms
- Send and receive messages in chat rooms
- Send and receive private messages

## Installation

1. **Clone the repository**

    ```sh
    git clone https://github.com/yourusername/chat-application-api.git
    cd chat-application-api
    ```

2. **Install dependencies**

    ```sh
    composer install
    ```

3. **Set up environment variables**

    Rename `.env.example` to `.env` and update the necessary configurations:

    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations**

    ```sh
    php artisan migrate
    ```

5. **Run the application**

    ```sh
    php artisan serve
    ```

## API Documentation

The API documentation is provided in a Postman collection. You can import the collection from the following link:

[Chat Application API Postman Collection](https://documenter.getpostman.com/view/32442929/2sA3XSB1LA)

### Authentication

- **Register**: `POST /register`
- **Login**: `POST /login`
- **Logout**: `POST /logout`
- **Get Authenticated User**: `GET /user`

### Chat Room

- **List Chat Rooms**: `GET /chat-rooms`
- **Create Chat Room**: `POST /chat-rooms`
- **Get Chat Room Details**: `GET /chat-rooms/{idChatRoom}`
- **Send Message in Chat Room**: `POST /messages`
- **Get Messages in Chat Room**: `GET /chat-rooms/{idChatRoom}/messages`

### Private Messages

- **Get Private Messages**: `GET /private-messages`
- **Send Private Message**: `POST /private-messages`

### Third-Party Authentication

- **Redirect to Google**: `GET /auth/google`
- **Handle Google Callback**: `GET /auth/google/callback`
- **Redirect to Facebook**: `GET /auth/facebook`
- **Handle Facebook Callback**: `GET /auth/facebook/callback`

## Database Schema

The database schema consists of the following tables:

- `users`
- `password_resets`
- `personal_access_tokens`
- `messages`
- `chat_rooms`
- `chat_room_user`

Refer to the migrations files for detailed schema definitions.

## ERD (Entity Relationship Diagram)

```mermaid
erDiagram
    USERS ||--o{ MESSAGES : "has many"
    USERS ||--o{ PERSONAL_ACCESS_TOKENS : "has many"
    MESSAGES }o--|| USERS : "belongs to"
    MESSAGES }o--|| CHAT_ROOMS : "belongs to"
    CHAT_ROOMS ||--o{ MESSAGES : "has many"
    CHAT_ROOMS ||--o{ CHAT_ROOM_USER : "has many"
    USERS ||--o{ CHAT_ROOM_USER : "has many"

    USERS {
        int id PK
        string name
        string username
        string email
        timestamp email_verified_at
        string password
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    PASSWORD_RESETS {
        string email
        string token
        timestamp created_at
    }

    PERSONAL_ACCESS_TOKENS {
        int id PK
        string tokenable_type
        int tokenable_id
        string name
        string token
        text abilities
        timestamp last_used_at
        timestamp created_at
        timestamp updated_at
    }

    MESSAGES {
        int id PK
        int user_id FK
        int chat_room_id FK
        text body
        timestamp created_at
        timestamp updated_at
    }

    CHAT_ROOMS {
        int id PK
        string name
        timestamp created_at
        timestamp updated_at
    }

    CHAT_ROOM_USER {
        int id PK
        int chat_room_id FK
        int user_id FK
        timestamp created_at
        timestamp updated_at
    }
