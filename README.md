# Dinamik 15
Dinamik 15 Official Website Repository

## Backend framework
<img width="40px" align="left" src="https://raw.githubusercontent.com/github/explore/56a826d05cf762b2b50ecbe7d492a839b04f3fbf/topics/laravel/laravel.png"/>
<br/>

## Frontend framework
<img width="40px" align="left" src="https://raw.githubusercontent.com/github/explore/37f1f9609f5c48a47f4d9c1a916fc2069fd0141c/topics/nuxt/nuxt.png"/>
<br/>

## Instalasi
1. Download / clone repo
2. Buka cmd / terminal di folder project, terus run
  ```
  composer install
  ```
3. Copy .env.example terus rename jadi .env, edit konfigurasi database
4. Migrate database & generate key
  ```
  php artisan migrate
  php artisan key:generate
  php artisan jwt:secret
  ```

## To-Do
- API
  - User auth system
    - Login (DONE)
    - Register (DONE)
    - Verify email
    - Forget password

- Front-end
  - Landing page
  - User auth system
    - Login
    - Register
    - Verify email
    - Forget password
  - User dashboard
    - Semua
  - Admin auth system
    - Login
  - Admin dashboard
    - Semua