#!/bin/bash
cd /var/www/html/
a2enmod rewrite
composer update && composer install 
php artisan migrate && php artisan db:seed 
php artisan key:generate
npm install 
npm run build

#Create symlink if needed
chmod -R a+w /var/www/html/storage/
if [ -L ${my_link} ] ; then
   if [ -e ${my_link} ] ; then
      echo "Good link"
   else
      echo "Broken link"
      rm ./public/storage/public
      ln -rs ./storage/app/public  ./public/storage/public
   fi
elif [ -e ${my_link} ] ; then
   echo "Not a link"
   rm ./public/storage/public
   ln -rs ./storage/app/public  ./public/storage/public
else
   echo "Missing"
   ln -rs ./storage/app/public  ./public/storage/public
fi

#Start server
/usr/sbin/apachectl -D FOREGROUND
