#!/bin/bash
cd /var/www/html/
a2enmod rewrite
composer update && composer install 
while ! php artisan migrate;
do 
   sleep 5s
   echo "Retrying Migration..."
done
while ! php artisan db:seed;
do 
   sleep 5s
   echo "Retrying Seeding..."
done

php artisan key:generate
npm install
php artisan cache:clear
php artisan view:clear
php artisan view:cache 
#npm run build

# DEMO SEEDER:
php artisan db:seed --class=DemoSeeder



#Create symlink if needed
chmod -R a+w /var/www/html/storage/
# mkdir -p ./storage/public/public/league_imgs
mkdir -p ./storage/app/public/league_imgs
my_link=./
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
/usr/sbin/apachectl -D FOREGROUND &
#Start dev mode
npm run dev-host