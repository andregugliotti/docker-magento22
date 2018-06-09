# Magento 2.2 Docker Container

This Docker container is built with support to `Nginx`, `PHP 7.1` (built with PHP FPM) and `MySQL 5.7`. It is also 
shipped with `PHPMyAdmin` and `xDebug`. Additionally, you can enable support for ionCube Loader, uncommenting the right lines at the end of **docker-magento22/php/Dockerfile**.

## How to use this repository

Just clone the files into your computer. It contains a Magento 2.2.1 Open Source installation as if 
you had downloaded it from Magento site.

There are three folders:

- docker-magento22 - that is the folder for Docker files.
- htdocs - that is the root folder, where website files live. Magento source files are here.
- project - that is the project folder, where you should work (I recommend the use of an automatic deploy, probably included in your IDE).

### Starting the container

Obviously, you need Docker and Docker-Compose softwares. If you don't have them installed, look for support for your 
OS. There are plenty of sites explaining how to do that, ;)

Then, as a regular user, just open your terminal and navigate to **docker-magento22** folder of this project. Type:

`docker-compose up -d`

Docker will build the containers and start them. It consists on downloading all required images (Ngix, PHP, Mysql, etc) and prepare them, installing the required softwares. Sometimes, you can find deprecated packages which lead to a
 broken installation. If you find yourself on this situation, please let us know.

You must also map the address **127.0.0.1 m2.docker.local** on your hosts file. If you don't know how to do that, 
just google it. It's easy!

### First access to project site

#### Installing Composer modules

The first step is run the Composer, to install all modules. As you know, when using Composer we must install them, as they are not shipped within the project. So:

- on the terminal, navigate into the folder **docker-magento22** and type the  following command to gain access to 
Docker container terminal as common user:

    `docker exec -it --user local magento22_phpfpm bash`
 
- then, at folder _/var/www/html_ type the following command to start the install process:

    `composer install`

- You could use `composer update` if you want to update the system but it is recommended to run first a install, using the current collection of packages (which almost always works).

- Magento will require an access key. To get it, you must visit the [Magento Marketplace](https://marketplace.magento.com) site and log in into your  account. Then, go to **Your Profile > Marketplace > Access Keys** and generate a new access key.

- The username is the first sequence of digits and the password is the second one. Just copy and paste from Magento site to Docker terminal

If you have doubts about generating the access key, visit this [link](http://devdocs.magento.com/guides/v2.0/install-gde/prereq/connect-auth.html).

Attention: you could have done all the steps on your local terminal (i.e. the host terminal instead of the Docker 
container terminal). But sometimes, you can face user permissions issues. So it's always better run these commands inside the Docker container.

#### Installing Magento Database

The next step is import the database shipped within this repository, on the folder sample-db, named **magento2.sql.gz**. To use it, just import it over magento2 DB, using PHP MyAdmin or your favourite MySQL client.

The PHP MyAdmin is available on port 8084 of the virtual machine. So you can access it typing `m2.docker.local:8084`,
 using the same credentials above. If you have any problem when importing, you can use the root credentials:

- username: `root`
- password: `secret_password`

The credentials to the first access on backend are:
 
- URL: `m2.docker.local/admin`
- username: `admin`
- password: `a123456`

Magento will require you to change the password as it's old. Just change the password to one you like and remember it
 on the next access.

#### Preparing static content and generating dependencies

There are some steps to have your Magento installation ready to be used. You type these commands always from root 
folder (/var/www/html/) on your Docker terminal:

- compile the code: `php bin/magento setup:di:compile`
- upgrade the database: `php bin/magento setup:upgrade`
- reindex: `php bin/magento indexer:reindex`
- if you find yourself with real slow pages loading, it's a good idea deploying the static content with `php 
bin/magento setup:static-content:deploy`. This will recreate all static content.

#### Installing sample data

- This version ships also the sample data. If by any reason sample data is not installed, then run this command: `php bin/magento sampledata:deploy` and after `php bin/magento setup:upgrade`.

### Changing project / htdocs files

To see your site live, just open a browser and visit m2.docker.local. That's exactly what you find at folder htdocs and it's automatically updated when you change them on your local machine. So, you don't need to rebuild your container to see your files.
Don't forget that the live folder is htdocs. Project folder is only local.

### Seeing logs

All logs are saved locally, on folder docker-magento22/logs. You can control them on your local machine.
Access logs are disabled from nginx config files. If you need them, see docker-magento22/nginx conf files and 
uncomment the correspondent line.
To see Magento logs, just open you var/logs and var/report folders, under htdocs.

### Accessing the container terminal

To access the container terminals, use the following commands:

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

This project is shipped with a PHPMyAdmin instance. It is accessible via 8084 port. So, just navigate to `m2.docker.local:8084` and use same credentials informed at docker-compose.yml file.

## Contribution

This is an open source module and can be used as a base for other modules. If you have suggestions for improvements, just submit your pull request.

## Versioning

We use SemVer to versioning. To view all versions for this module, visit the tags page, on this repository.

## Authors

Andre Gugliotti - Initial module development - [AndreGugliotti](https://github.com/AndreGugliotti)
See also the developers list, with all those who contributed to this project. [Contributors](https://github.com/andregugliotti/docker-magento22/graphs/contributors)

## License

This project is licensed under GNU General Public License, version 3.