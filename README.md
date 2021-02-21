## Maruweb Laravel starter kit

Maruweb Laravel starter kit source code

## How to setup

- Git clone
- composer install
- npm install && npm run dev
- Copy .env.example to .env and change configurations (Register Recaptcha & SMTP email provider like SendGrid, SendInBlue ...)
- php artisan migrate
- php artisan maruweb:setup-admins
- php artisan maruweb:setup-roles-and-permissions
- Go to domain.com/admin_nE7jVYS8cR/login, username: dev@maruweb.vn / password: Qwe123!@#