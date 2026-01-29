# Skapa en lokal utvecklings miljö med Docker & LAMP

I denna guiden skapar vi en lokal utvecklingsmiljö av LAMP stacken. Genom att använda docker kommer vi skapa en flexibel miljö som går att använda som en template för att skapa en databasdriven applikation med PHP lokalt.

#### Varför använda docker?

Genom användningen av docker kan vi köra samma miljö oavsett vilket operativsystem vi annars använder. Docker installerar alla nödvändiga beroenden och kör dem i en isolerad miljö kallad container. Vi får exakt samma miljö oavsett vad vi tidigare har installerat på datorn. Detta motverkar problem relaterat till övriga program som kan finnas installerade på vår maskin.

###### Steg 1

Skapa en filstruktur enlig nedan

```txt
lamp-docker
    ├── docker`
    |   |__ mysql
    |   |  |__ init.sql
    │   └── php-apache
    │       └── Dockerfile
    ├── docker-compose.yml
    └── src
        |-- db
        |   |__ config.php
        |   |__ connect.php
        |-- functions
        |   |__ messages.php
        └── index.php
```

###### Steg 2

Lägg till följande i: /php-apache/Dockerfile

```docker
FROM php:8.2-apache

#Enable Apache rewrite module

RUN a2enmod rewrite

#Install PHP extension for MySql

RUN docker-php-ext-install mysqli pdo pdo_mysql

#Set woring directory

WORKDIR /var/www/html
```

###### Steg 3

För att bekräfta att databasen skapar vi med hjälp av init.sql en tabell 'messages' och lägger till tre meddelanden.

Lägg till följande i: ./docker/mysql/init.sql

```sql
USE app;

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content VARCHAR(255) NOT NULL
);

INSERT INTO messages (content) VALUES
  ('Hello from MySQL'),
  ('Docker LAMP works'),
  ('PHP can read this');
```

###### Steg 4

Vi skapar kontakt med databasen via PHP och hämtar data ifrån databasen vi lägger till variabler för att ansluta mot databasen i en egen fil. Glöm inte att lägga till filen i gitignore ifall projektet publiceras till Github.

Lägg till följande i ./src/db/config.php
```php
<?php
$dsn = "mysql:host=db;dbname=app;charset=utf8mb4";
$user = "appuser";
$pass = "secret";
?>
```

För att ansluta till databasen skapar vi en funktion.

Lägg till följande i ./src/db/connect.php
```php
<?php
require "config.php";

function connectDb() {
  global $dsn, $user, $pass;
function connectDb() {
    global $dsn, $user, $pass;
    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
```

Vi använder funktionen i vår index fil och hämtar meddelanden från databasen och visar sedan upp dessa i html dokumentet.

Vi använder connectDb för att ansluta till databasen och vi skapar en funktion för att hämta medelanden från databasen.

Lägg till följande i ./src/functions/messages.php
```php
<?php
include "./db/connect.php";

function getMessages() {
    $pdo = connectDb();
    $stmt = $pdo->query("SELECT * FROM messages");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
```

Vi visar upp data ifrån databasen genom att använda funktionen. Vi importerar funktionen i vår index fil och definerar variablen '$messages' som vi visar upp i vårt html dokument.

Lägg till följande i ./src/index.php

```php
<?php
include "./src/messages.php";
$messages = getMessages();
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

###### Steg 5

För att bygga vår container och köra den använder vi ett docker-compose script.

Lägg till följande i: ./docker-compose.yml

```yml
services:
  web:
    build: ./docker/php-apache
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: app
      MYSQL_USER: appuser
      MYSQL_PASSWORD: secret
    volumes:
      - db_data:/var/lib/mysqli
      - ./docker/mysql/init.sql:/docker-entrypoint-initdb.d/init.sql
    ports:
      - "3306:3306"

volumes:
  db_data:
```

###### Steg 6

I root kör vi sedan docker-compose scriptet med hjälp av följande kommando.

```bash
docker compose up --build
```

Besök http://localhost:8080 om allt fungerade ska en hemsida med meddelanden från databasen visas upp. Om det av någon anledning inte fungera testa att stänga ner docker containers genom: 'docker-compose-down' och kör om: 'docker compose up --build' innan vidare felsökning.

#### Sammanfattning

Vi har nu byggt en PHP applikation som ansluter och hämtar data ifrån en MySQL databas. Genom att skapa en docker container och ett compose script kan vi nu enkelt ladda ner och köra applikationen lokalt. Perfekt template att bygga vidare ifrån.