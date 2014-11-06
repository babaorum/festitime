VHOST :

  $ sudo nano /etc/apache2/sites-available/festitime.dev


    <VirtualHost *:80>
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

####

    $ sudo a2ensite festitime.dev
    $ sudo service apache2 reload

####

Host to add (Windows ou Mac) AND VM :

    127.0.0.1       festitime.dev

path VM :

    sudo nano /etc/hosts