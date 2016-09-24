pelicanconnect
==============

A Demo for job aplication in pelicanconnect

Installation
============

You will neeed

* Postgresql
* Apache (optionally)
* Php (developed with php 7)
* Linux
* Postgresql Php Driver

First of all change the enviromental parameters into the `scripts/create_env.sh` in order to suit with execution environment. After that run:

> cd ^path of the application^

> . ./scripts/create_env.sh

Please remember NOT to remove the `.` from the start of the command. Otherwise the execution evironment __WONT__ setup properly.

And setup the database with the command:

> php bin/console doctrine:schema:create --env=prod

Make sure before executing the command to create a correct postgresql user allowing `CREATEDB`

And after that execute:

> chmod 777 -R .

> php bin/console cache:warmup --env=prod

Please __BEFORE__ executing the command above make sure you are __INSIDE__ the path of the application's directory.
If not please use the `cd` command.

And start the symfony's server:

> php bin/console server:start --env=prod

If you insist on running via apache please try the following Virtual host:

````````````````````
<VirtualHost *:80>

	ServerAdmin pc_magas@openmailbox.org
	DocumentRoot /home/pcmagas/Kwdikas/web/apps/pelicanconnect/web/

	DirectoryIndex app.php

	ErrorLog /home/pcmagas/Kwdikas/web/apps/logs/error.log
	CustomLog /home/pcmagas/Kwdikas/web/apps/logs/access.log combined

	<Directory /home/pcmagas/Kwdikas/web/apps/pelicanconnect/web/>
		AllowOverride All
		Require all granted
		Order Allow,Deny
		Allow from All
	</Directory>

	#Db Connnection
	SetEnv SYMFONY__DB_HOST localhost
	SetEnv SYMFONY__DB_USER pelicanconnect
	SetEnv SYMFONY__DB_PASSWD pelicanconnect
	SetEnv SYMFONY__DB_PORT 5432

</VirtualHost>
````````````````````
