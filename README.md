FESTITIME
=========

Festitime is a Student project for an ecommerce website.
The particularity of this website is to be specific to Festivals.
We really think Festival is a particular type of buisness and that really specific features can be developed for it.

------------

* [Components](#components)
    - [Symfony2](#symfony2)
    - [MongoDB](#mongodb)
    - [Angular.JS](#angularjs)
    - [Grunt](#grunt)
    - [LESS](#less)
    - [API Blueprint](#api-blueprint)
* [Install](#install)
    - [Composer](#composer)

------------
Components :
------------

#### Symfony2

>We are using Symfony2 with FOSRestBundle for the API side

#### MongoDB

>We are using MongoDB with DoctrineMongoDBBundle

#### Angular.JS

>We are using Angular.JS for the front side intelligence, rendering and filters

#### Grunt

>We are using Grunt for compiling LESS files.

#### LESS

>We are using LESS for the stylesheets.

#### API Blueprint

>We are using Api Blueprint for generating documentation about our API
and for the continuous amelioration of the project.

---------
Install :
---------

#### Composer
  
To start you need to install the composer dependencies :

    $ composer install

#### NPM

##### API Blueprint - Protagonist

Before install of basic npm dependencies you need to have **ruby** and **g++** install for the install of protagonist.
**Protagonist** is the Node.js wrapper for Snow Crash library (which is the **API Blueprint Parser**)

So, if one of the previous package is missing run the following command :
+ For Debian :
    
    $ sudo apt-get install rubygems

+ For Ubuntu

    $ sudo aptitude install rubygems

##### Install Dependencies

You also need to install the npm dependencies :

    $ npm install

#### Grunt
You will need Grunt, so if you don't already have grunt-cli install, run the following command :

    $ npm install -g grunt-cli

#### Bower
you will also need bower dependencies:

    $ bower install

If bower isn't already installed you need to run :

    $ npm install -g bower

#### VHOST
#####basic configuration :
First run the following command : 
  
    $ sudo nano /etc/apache2/sites-available/festitime.dev

It will open an editor in your terminal, put the following content inside and save it :

        <VirtualHost *:80>
                SetEnv FESTITIME_ENV dev
                ServerAdmin webmaster@localhost
                ServerName festitime.dev
                ServerAlias www.festitime.dev

                DocumentRoot /var/www/festitime/web
                <Directory /var/www/festitime/web>
                        Options Indexes FollowSymLinks MultiViews
                        AllowOverride All
                        Order allow,deny
                        allow from all
                </Directory>

                ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/

                ErrorLog ${APACHE_LOG_DIR}/error.log

                # Possible values include: debug, info, notice, warn, error, crit,
                # alert, emerg.
                LogLevel warn

                CustomLog ${APACHE_LOG_DIR}/access.log combined
        </VirtualHost>

Once the file saved run the following commands : 

    $ sudo a2ensite festitime.dev 
    $ sudo service apache2 reload

You need to register the host (if you're using vagrant you will also need to put it in windows hosts) :

    $ sudo nano /etc/hosts

Put it the following content : 
  
    127.0.0.1       festitime.dev 


#####Environment configuration :

You also need to add the aliases for piloting the environment :
first run the command

    $ sudo nano ~/.bashrc

then go at the end of the file and put it the following lines :

    alias ftdev='sudo sed -i "s/FESTITIME_ENV prod/FESTITIME_ENV dev/g" /etc/apache2/sites-available/festitime.dev && sudo service apache2 restart'
    alias ftprod='sudo sed -i "s/FESTITIME_ENV dev/FESTITIME_ENV prod/g" /etc/apache2/sites-available/festitime.dev && sudo service apache2 restart'

#### MongoDB
##### Basic Install

You need to add this apt-key
  
    $ sudo apt-key adv --keyserver keyserver.ubuntu.com --recv 7F0CEB10
    $ echo 'deb http://downloads-distro.mongodb.org/repo/debian-sysvinit dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list

Then update and upgrade apt-get :

    $ sudo apt-get update
    $ sudo apt-get upgrade

Now you can install MongoDB : 

    $ sudo apt-get install mongodb-org
    $ sudo /etc/init.d/mongod restart

Now we are gonna install MongoDB PHP extension :

    $ sudo pecl install mongo
    $ echo "extension=mongo.so" >> /etc/php5/cli/php.ini
    $ echo "extension=mongo.so" >> /etc/php5/cgi/php.ini
    $ echo "extension=mongo.so" >> /etc/php5/apache2/php.ini
    $ sudo /etc/init.d/mongod restart

##### Install festitime DB :

    $ mongo
    $ show dbs
    $ use festitime
    $ exit

-----
USAGE
-----

#### Grunt

Grunt is here to compile less and javascript files.
You're supposed to run 
  
    $ grunt watch 

You have to run it in a second terminal, because it will watch you're files during you modify it. And when you make a change in a less or javascript file, grunt will compile it again.

Grunt watch will do some tasks:
    1. preprocessing less files into one unique css file : **/assets/dist/css/styles.css**
    2. minify styles.css into **/assets/dist/css/styles.min.css**
    3. concat javascript files into **/assets/dist/js/built.js**
    4. minify and uglify built.js into **/assets/dist/js/built.min.js**
    5. clear symfony2 cache for the appropriate environment (in case you forget to clear it)

Grunt also provide a task for building the API.md file (blueprint document)

    grunt blueprint2json

This will parse **API.md** and create a **blueprint.json** file in */web/assets/blueprint*

------------

