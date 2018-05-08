### Install

```bash
$ docker-compose up
$ docker exec -ti blog_php_1 bash
# composer install
# chmod 777 -R storage/
# chmod 777 -R bootstrap/cache
# php artisan migrate
```

http://localhost

Register a user and then promote them to admin
```
php artisan user:toggle-admin user@email.com
```

### Notes

I wasn't able to find a lot of time for this so I just went with vanilla Laravel/Blade. Given more free time I would: 

* Add unit tests for the repo and model
* Add behat/web crawler tests, especially for auth end points
* Convert the Blade templates to Vue components, especially the form
* Refactor the bits where the controller touches the domain into into a service layer or command bus approach
* Use an ORM, pagination etc
