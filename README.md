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

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



## Pełna instalacja
Zeby aplikacja miała mozliwość odpalic, zainstaluj 

php -> https://windows.php.net/download#php-8.3

composerer -> 
https://getcomposer.org/download/

Pamietaj by dodać oby dwa programy do zmiennych środowiskowych PATH.
Nastepnie odnajdz plik php.ini i odkomentuj w nim:

- extension=fileinfo
- extension=mbstring
- extension=openssl
- extension=pdo_mysql

Nastepnie w docelowym folderze zklonuj te repozytorium:

```http
  git init
  git clone https://github.com/kubsikora/RentFlow-backend
```
Po udanym klonowaniu użyj poniższej komendy by zinicjalizować backend:

```http
  composer install
```
Dodatkowo znajdz plik zaczynajacy się .env exemple czy jakos tak, usuń reszte by było tylko '.env' nastepnie w sekcji z poczatkiem "DB" skonfiguruj połączenie z baza danych.
Tak wygląda to u mnie:
```http
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=rentflow
  DB_USERNAME=root
  DB_PASSWORD=zaq1@WSX
```
Po ustawieniu bazy danych użyj komendy `php artisan migrate`, uaktualni to twoją baze z projektem.
By połaczyć nasz aktualny backend z fontem użyj komendy `php artisan key:generate`.
Gratulacje masz zainstalowany funkcjonujacy backend, możesz go teraz uruchomić za pomoca komendy `php artisan serve`. Nastepnym krokiem żeby RentFlow funkcjonował w pełni jest zklonowanie frontendu do naszego projektu. Aby to zrobic wejdz do foldera 
`rentflow-front` w scieżce `\resources\js` i wykonaj poniższe komendy:

```http
  git init
  git clone https://github.com/kubsikora/RentFlow-frontend
```

Nastepnie użyj komendy `npm install` żeby zinicjaliować frontend,
Frontend możesz uruchomić komenda `quasar dev`, jeśli wszytko się udało powinna ci się odpalić strona webaplikacji.
