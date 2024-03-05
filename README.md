# testing_laravel

Testing Laravel + Liveware + MySQL

Testing Docker

---

-   Using mysql on localhost

### To run php local

1. Run `composer install`
2. Run `php artisan migrate`
3. Run `php artisan serve`

### To run by docker-compose

1. Change .env `DB_HOST` to `host.docker.internal`
2. Run `php artisan migrate`
3. Run `docker-compose build`
4. Run `docker-compose up`

---

Example home:
![image home](/public/home.png "home")
