# Magento 2.2 Docker Container

This Docker container is build with support to `Nginx`, `PHP 7.1` (built with PHP FPM) and `MySQL 5.7`. It is also shipped with `PHPMyAdmin` and `xDebug`. Additionally, you can enable support for ionCube Loader, uncommenting the right lines at _docker-magento22/php/Dockerfile_.

## How to use this repository

Just clone the files into your project folder. It contains a Magento 2.2 CE installation.

There are three folders:

- docker-magento22 - that is the folder for Docker files
- htdocs - that is the root folder, where website files are copied (I recommend the use of an automatic deploy, probably included in your IDE). Magento source files are here
- project - that is the project folder, where you should work

### Starting the container

Just open your terminal and navigate to docker-magento22 of this project. Type:

`docker-compose up -d`

Docker will build the containers and start them. You must also map the address _127.0.0.1 m2.docker.dev_ on your hosts file. If you don't know how to do that, just google it. It's easy!

### First access to project site

**Before accessing the Magento site**, you must import the database.
On this project you find a base DB, on folder sample-db. To use it, you just import it over magento2 DB, using PHPMyAdmin or your favourite MySQL client.
After that, when you access the project site, I recommend updating composer modules. To do that:

- on your terminal, navigate into the folder _docker-magento22_ and type the command `docker exec -it --user local dockermagento22_phpfpm_1 bash` to gain access to Docker container terminal as common user
- then, at folder _/var/www/html_ type the command `composer install` to start the install process. You can use `composer update` if you want to update the system but it is recommended to run first a install, using the current collection of packages (which almost always works).
- Magento will require an access key. To get it, you must visit Magento site and log in into your account. Then, go to Your Profile > Marketplace > Access Keys and generate a new access key.
- The username is the first sequence of digits and the password is the second one. Just copy and paste from Magento site to Docker terminal
- The last step is to generate the static content. To do that, on the same folder (the root of Magento, at Docker shell) type `php bin/magento setup:static-content:deploy`. This will recreate all static content.
- This version ships also the sample data. If by any reason sample data is not installed, then run this command: `php bin/magento sampledata:deploy` and after `php bin/magento setup:upgrade` to install sample data.

If you have doubts about generating the access key, visit this [link](http://devdocs.magento.com/guides/v2.0/install-gde/prereq/connect-auth.html).

### Accessing Magento backend

When using sample data, just navigate to m2.docker.dev/admin and access the panel with these credentials:

username: `admin`
password: `a123456`

### Changing project / htdocs files

To see your site live, just open a browser and visit m2.docker.dev. That's exactly what you find at folder htdocs and it's automatically updated when you change them on your local machine. So, you don't need to rebuild your container to see your files.
Don't forget that the live folder is htdocs. Project folder is only local.

### Seeing logs

All logs are saved locally, on folder docker-magento22/logs. You can control them on your local machine.
Access logs are disabled from nginx config files. If you need them, see docker-magento22/nginx conf files.
To see Magento logs, just open you var/logs and var/report folders, under htdocs.

### Accessing the container terminal

If you need to access the container terminal, use the following commands:

- to see which are the running containers: `docker ps`
- to connect to a container as root: `docker exec -it {container_name} bash`
- to connect to a container as local user (1000): `docker exec -it --user local {container_name} bash`

This last option is useful when you need to connect to the container and run an non root user (like when you need to run a console script).

### Adding a database

Database files are found on docker-magento22/databases and use a specific user, which means no access from the local machine. They are not included on git repository.
If you have some problems starting the MySQL container, try to empty this folder and build the container again.

### Connecting to DB

To create a DB and set user credentials, check docker-magento22/docker-compose.yml file. You find the entries at mysql node.

To connect to a DB from local machine, just use the localhost address (like 127.0.0.1) and the credentials.

To connect to a DB from another container, like from a framework running on php side, use the entry `mysql` as address/server

### Using PHPMyAdmin

This project is shipped with a PHPMyAdmin instance. It is accessible via 8084 port. So, just navigate to `m2.docker.dev:8084` and use same credentials informed at docker-compose.yml file.

## Contribution

This is an open source module and can be used as a base for other modules. If you have suggestions for improvements, just submit your pull request.

## Versioning

We use SemVer to versioning. To view all versions for this module, visit the tags page, on this repository.

## Authors

Andre Gugliotti - Initial module development - [AndreGugliotti](https://github.com/AndreGugliotti)
See also the developers list, with all those who contributed to this project. [Contributors](https://github.com/andregugliotti/docker-magento22/graphs/contributors)

## License

This project is licensed under GNU General Public License, version 3.