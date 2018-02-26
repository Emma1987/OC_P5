# OC_P5
## First blog in PHP
This blog developped in PHP and using OOP is a project for my studies with OpenClassrooms.

## Getting Started
You can download the project, or clone it with Git by using the green button "Clone or download". You can run it on your local machine for development and testing purposes.

### Prerequisites
PHP 5.6
MySql 5.6.35
Apache

### Installing
For installing the project, you have to clone or download it.
For running it on your local machine, you can install MAMP (or WAMP for Windows), and put it in the htdocs (or www) file.

You can install the database with the file named script.sql. For that, execute the requests in PHPMyAdmin.

Then, you need to configure the application. You will find the file in App > Config > app.xml.
You have to define informations for the database connexion, the domain name (for using in local, set 'http::/localhost/'), the mail of the administrator and the informations of the service used to send emails.

Finally, you need to install Composer and execute the \*composer update\* command to download libraries.

Now, you can use the application !

## Built With

* Bootstrap - the famous CSS framework
* Freelance template for the frontend
* Startmin template for the backend

### Add-ons

* PHP-Mailer for sending e-mails - https://github.com/PHPMailer/PHPMailer
* Imagine for resize and save images https://github.com/avalanche123/Imagine
