CREATE USER IF NOT EXISTS 'sporter'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'sporter'@'%' WITH GRANT OPTION;
#FLUSH PRIVILEGES;
