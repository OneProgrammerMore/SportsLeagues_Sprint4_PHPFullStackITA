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

npm run build

php artisan cache:clear
php artisan view:clear
php artisan view:cache 

# Create Links For Images If Not There
mkdir -p ./storage/app/public/imgs/league_imgs
mkdir -p ./storage/app/public/imgs/team_imgs
mkdir -p ./storage/app/public/imgs/player_imgs


#Create symlink if needed
chmod -R a+w /var/www/html/storage/
# mkdir -p ./storage/public/public/league_imgs
mkdir -p ./storage/app/public/league_imgs
my_link="./public/storage/public"
mkdir -p ./public/storage
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


# DEMO SEEDER:
php artisan db:seed --class=DemoWebSeeder




#Start server
/usr/sbin/apachectl -D FOREGROUND &
#Start dev mode
npm run dev-host