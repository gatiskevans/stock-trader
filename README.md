# Stock Trader App

This program is dedicated for viewing, buying and selling various company stocks.
Program uses Finnhub API for data.

In order to run the program: 
* [Download the project](https://github.com/gatiskevans/stock-trader/archive/refs/heads/main.zip)
* PHP 7.4 or higher
* MySQL 5.7 or higher
* Composer installed
* Node.js installed
* Run `composer install` within the same folder where composer.json file is located
* Run `npm install` within the same folder where package.json file is located
* Run `php artisan migrate` to create database tables
* Run `php artisan serve` to start the server on your local machine
* Run `php artisan queue:listen` and leave it running in background
* Rename .env.example to .env
* Set up your database connection by providing your mysql DB_USERNAME and DB_PASSWORD in .env file
* Set up MAIL configuration in .env file of your mailbox
    * If you're using Mailtrap - under Integrations choose option Laravel 7+ and copy provided values in .env file's corresponding keys
    * For any other mailboxes you should get values for host, port, username, password and encryption in order to configure MAIL
* Register to [Finnhub API](https://finnhub.io/) and provide your API key in .env file as a value for FINNHUB_API key
* Enjoy! 
