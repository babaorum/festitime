install mongo:

this should be automatically done

  //start by adding apt-key for downloading mongo
  $ sudo apt-key adv --keyserver keyserver.ubuntu.com --recv 7F0CEB10

  //get list of download for the future download
  $ echo 'deb http://downloads-distro.mongodb.org/repo/debian-sysvinit dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list

  // update and upgrade
  $ sudo apt-get update
  $ sudo apt-get upgrade

  //install
  $ sudo apt-get install mongodb-org

  // restart mongo 
  $ sudo /etc/init.d/mongod restart

  //test mongo and set good db
  $ mongo
  $ show dbs
  $ use festitime
  $ exit

that's what you really need:
  
  //install the MongoDB driver for PHP
  $ sudo pecl install mongo

  //give php.ini the extension of mongo
  $ sudo nano /etc/php5/cli/php.ini
  $ sudo nano /etc/php5/apache2/php.ini
  
  //paste this line at the end of the file
  extension=mongo.so

