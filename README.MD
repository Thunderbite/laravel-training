# Laravel training project

## Requirements

First, make sure you have all the appropriate tools to run this project. You will need:

- [GIT](https://git-scm.com/downloads)
- MYSQL (you can use [MYSQL Workbench](https://dev.mysql.com/downloads/workbench/) as it also installs a decent db management tool )
- [PHP7](http://php.net/downloads.php)
- [COMPOSER](https://getcomposer.org/download/)
- [VALET](https://laravel.com/docs/5.5/valet#installation) ( if you are not using a MAC, you will need to install a webserver to serve the project content, such as Apache or Nginx )

Once you have all the requirements installed, move on to the installation part

## Installation

1. Clone this repository in your work directory
```
    git clone https://github.com/Thunderbite/laravel-training.git
```

2. Switch to the project folder and run `composer install`. This is needed to install external dependencies
```
    cd laravel-training
    composer install
```

3. Create a database called `laravel_training` in your dbserver

4. Create a `.env` file. You can easily do this by copy-pasting the contents of `.env.example` to `.env` and then updating the custom fields, such as database connection

5. Run the migrations. This will create the required tables in the database you just created
```
    php artisan migrated
```

6. Run the seeds ( this will populate some default data in the database )
```
    php artisan db:seed
```

7. Make the application accessable via url.
    - If you are using `valet` you can run the following command: `valet link` and this will make the application accessable via `http://laravel-training.test/` and `http://laravel-training.test/admin`

    - If you are using a diferent method for serving webcontent, just make sure the application lies in your public folder.

## Documentation

- [LARAVEL](https://laravel.com/docs/5.5)