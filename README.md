# Setting up a LAMP development envinorment with Docker

We are going to set up a local development envinorment using the legendary LAMP stack. LAMP stands for Linux, Apache, MySql and PHP and will allow us to write all kinds of web applications.

#### Why using a development environment with docker?

By using Docker we can run a image of the full envinorment needed to run our application. This mean even the operating system is included and therefor we can run it on device regarding our own os. The docker image allows for version specification on all dependencies which is a huge benefit when switching machine.



###### Step 1

Create a folder structure like below this will hold our application.

lamp-docker
    ├── docker
    │   └── php-apache
    │       └── Dockerfile
    ├── docker-compose.yml
    └── src
        └── index.php



###### Step 2

In docker/php-apache/Dockerfile add the following.

```docker
FROM php:8.2-apache

#Enable Apache rewrite module

RUN a2enmod rewrite

#Install PHP extension for MySql

RUN docker-php-ext-install mysqli pdo pdo_mysql

#Set woring directory

WORKDIR /var/www/html
```



###### Step 3

In docker-compose.yml add the following.

```yml
version: "3.9"

services:
 web:
 build: ./docker/php-apache
 container_name: lamp_web
 ports:
 - "8080:80"
 volumes:
 - ./src:/var/www/html
 depends_on:
 - db

db:
 image: mysql:8.0
 container_name: lamp_db
 environment:
 MYSQL_ROOT_PASSWORD: root
 MYSQL_DATABASE: app
 MYSQL_USER: appuser
 MYSQL_PASSWORD: secret
 volumes:
 - db_data:/var/lib/mysql
 ports:
 - "3306:3306"

volumes: 
db_data:
```



###### Step 4

Add the following to src/index.php

```php
<?php

phpinfo();

?>
```



###### Step 5

From root in project folder build and run docker container.

```bash
$ docker compose up --build
```

If run succesfully you can now visit http://localhost:8080 and you should see the PHP info page.

##### Step 6

To confirm everygthing is up and running we will manually enter some data to the database. In the terminal run the following command

```
$ docker exec -t lamp_db mysql -uappuser -p

Password: secret

mysql> USE app;

mysql> CREATE TABLE messages (

    id INT AUTO_INCREMENT PRIMARY KEY,

    content VARCHAR(255) NOT NULL

);

mysql> INSERT INTO messages (content) VALUES
('Hello from MySQL!'),
('Docker LAMP works'),
('PHP can read this');

mysql> EXIT;
```

###### Step 7

Now we have created a table in the database and entered some data let further explore how we can connect our database to our PHP application. In src/index.php enter.

```php
<?php

$dsn = "mysql:host=db;dbname=app;charset=utf8mb4";
$user = "appuser";
$pass = "secret";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM messages");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LAMP Docker Test</title>
</head>
<body>

<h1>Messages from the database</h1>

<ul>
    <?php foreach ($messages as $message): ?>
        <li><?= htmlspecialchars($message['content']) ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>

```

Visit http://localhost:8080 again and yous should now see the messages from the MySQL database.

###### Summary

We now have a starting template for building all kinds of web applications with PHP and MySQL and now matter where we working we can spin up our dev envinorment fast. Feel free to download the code as a starter template or follow this guide to create your own starting ground.

* Note this app should not be run for production and also hide your passwords for this demonstration sensetive data is displayed.
