## Simple Shorten URL system

This application is simple shorten url system using Laravel Framework 5.7.17, the system can calculate hit url clicked by the user

## How to run Locally
1. you need to download laravel using this link <a href="https://laravel.com/docs/5.7#installation">Laravel install</a>
2. creat database on your local machine with database name "short_urls"
3. import using "short_urls.sql" files
4. run your laravel with php artisan serve

## Access the main website
You can access the main website using this URL <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a>
on that screen you can type any url, then shorten it, 

## Access the admin panel
You can access the admin site using this URL <a href="http://127.0.0.1:8000/admin">http://127.0.0.1:8000/admin</a>
and you can login with sample account 
ID: test@yopmail.com
PW: testing

after login, you can see some info 
    - top 10 latest link created
    - top 10 clicked link
    - top region whose click the link

## API 
Included postman collection file "hortenUrl.postman_collection.json"
just import the file to postman, then you can see all the API for test

