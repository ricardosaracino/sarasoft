#!/bin/bash

mysql -uroot -p  < sarasoft.sql;
rm -rf var/cache/prod/*;
php bin/console cache:clear --env prod;
find * -type d -exec chmod 770 {} \;
find * -type f -exec chmod 660 {} \;
chown -R apache:apache .;