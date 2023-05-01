API for DoorSystem
Uses PHP7.4 and MariaDB

Prerequisites:

Apache2
  libapache2-mod-php
PHP:
  PHP7.4
  php-bcmath
  php-cli
  php-curl
  php-common
  php-gd
  php-json
  php-mbstring
  php-mysql
  php-tokenizer
  php-xml
  php-zip
composer
MariaDB-server (or mysql, not prefered)
___________________________________________________________________________________________________

Installation : (french follows english)

One-shot apt install:
doas apt install apache2 libapache2-mod-php php7.4-{bcmath,cli,curl,common,gd,json,mbstring,mysql,tokenizer,xml,zip} composer mariadb-server

Create database DoorSystem; // run in MariaDB, case sensitive!!

On a GNU/Linux serveur (debian based) (using doas, you probably have sudo!)
dans le root du projet entrer les commandes:

doas composer install --no-dev
doas cp .env.example .env

Update .env with all needed info:database name, username and password.
Make sure the selected user has sufficent access to the database (create, update, delete)
grant all privileges on DoorSystem.* to 'user'@'localhost';

doas chown www-data:www-data {absolute route to the projet} // www-data is the Apache2 default user.
doas chmod 775 {absolute route to the projet}

doas php artisan migrate // create tables in db
doas php artisan key:generate // generate encription key

Edit (if needed) config file DoorSystemAPI.conf (included in config/)
Specify absolute path to the public/ directory in both DocumentRoot and Directory
ServerName et ServerAlias if needed.

copy le file DoorSystemAPI.conf to /etc/apache2/sites-available/
doas cp config/DoorSystemAPI.conf /etc/apache2/sites-available/
doas a2ensite DoorSystemAPI.conf
doas systemctl restart apache2

Server is now up and running

___________________________________________________________________________________________________

One-shot apt install:
doas apt install apache2 libapache2-mod-php php7.4-{bcmath,cli,curl,common,gd,json,mbstring,mysql,tokenizer,xml,zip} composer mariadb-server

Creer la base de donnees DoorSystem; // run in MariaDB, case sensitive!!

On a GNU/Linux serveur (debian based) (j'utilise doas, vous avez probablement sudo!)
dans le root du projet entrer les commandes:

doas composer install --no-dev
doas cp .env.example .env

Modifier le ficher .env avec le nom de la bd (si c'est pas CarnetSante), le nom du user et le mot de passe.
S'assurer que ce user a touts les access sur la bd
grant all privileges on CarnetSante.* to 'labelo'@'localhost';

doas chown www-data:www-data {route absolue vers le projet} // www-data est le user qui permet a Apache2 d'avoir acces, il est cree lors de l'installation de Apache2
doas chmod 775 {route absolue vers le projet}

doas php artisan migrate //pour creer les tables dans la bd
doas php artisan key:generate //pour generer une cle d'encription

Modifier le fichier carnetSanteAPI.conf (inclu dans le dossier config) 
Specifier le path absolu vers le dossier public/ du projet dans DocumentRoot et Directory
ServerName et ServerAlias s'ils sont incorrectes.

copier le fichier carnetSanteAPI.conf vers /etc/apache2/sites-available/
doas cp config/carnetSanteAPI.conf /etc/apache2/sites-available/
doas a2ensite carnetSanteAPI.conf
doas systemctl restart apache2

le serveur est maintenant operationnel