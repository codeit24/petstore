<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

![Laravel Version](https://img.shields.io/badge/laravel-12.x-red)
![PHP Version](https://img.shields.io/badge/php-8.2-blue)
![License](https://img.shields.io/github/license/codeit24/petstore)

# PetStore — Zadanie rekrutacyjne REST API

Aplikacja front‑endowa napisana w Laravel 12, umożliwiająca zarządzanie „zwierzakami” przez interfejs REST API (np. [Swagger PetStore](https://petstore.swagger.io/)).  
Umożliwia przeglądanie, filtrowanie, dodawanie, edytowanie i usuwanie wpisów o zwierzętach.

## 📋 Spis treści
- [Wymagania](#-wymagania)  
- [Instalacja](#-instalacja)  
- [Konfiguracja](#-konfiguracja)  
- [Uruchomienie](#-uruchomienie)
- [Struktura projektu](#-struktura)
- [Technologie](#-technologie)  
- [Autor](#-autor)
- [Licencja](#-licencja)  

## 💻 Wymagania
- PHP 8.2 lub nowsze  
- Composer  
- Node.js (v16+) i npm / Yarn  
- MariaDB / MySQL

## 🚀 Instalacja
``command
git clone https://github.com/codeit24/petstore.git
cd petstore

cp .env.example .env
composer install
npm install

php artisan key:generate
php artisan migrate
npm run dev

## ⚙️ Konfiguracja
W pliku .env uzupełnij:

APP_NAME="PetStore"
APP_URL=http://localhost:8000

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petstore
DB_USERNAME=yourUserName
DB_PASSWORD=yourPassword

# Adres bazowego API PetStore (domyślnie Swagger PetStore)
PETSTORE_BASE_URL=https://petstore.swagger.io/v2

## 🏃 Uruchomienie
``command
php artisan serve || http://localhost/petstore/public/

## 🗂️ Struktura
``
app/
├── Http/Controllers/PetController.php  # logika CRUD przez Http::client

resources/
├── views/
│   ├── dashboard.blade.php             # lista zwierzaków
│   ├── pet_form.blade.php              # formularz dodawania
│   └── pet_update.blade.php            # formularz edycji

routes/
└── web.php                             # definicja tras

tests/
├── Feature/                            # testy integracyjne
└── Unit/                               # testy jednostkowe

public/                                 # zasoby front‑end``

## ✍️ Autor
codeit24

## 📄 Licencja
Projekt udostępniony na licencji MIT. [MIT license](https://opensource.org/licenses/MIT).
