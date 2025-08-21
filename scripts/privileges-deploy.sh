PROJECT_DIR="./cup-web/"
DATABASE_DIR="./docker/cup-mariadb/"
USERID="1234"
GROUPID="1234"

# First all with only read permission for user and group (NO WRITE NO EXECUTE PERMISSION)
chmod -R 440 $PROJECT_DIR

# Execute & Read Permission To Directories with Code
chmod -R 550 $PROJECT_DIR"app/"
chmod -R 770 $PROJECT_DIR"bootstrap/"
chmod -R 550 $PROJECT_DIR"config/"
chmod -R 550 $PROJECT_DIR"database/"
chmod -R 550 $PROJECT_DIR"entrypoint.sh"
chmod -R 550 $PROJECT_DIR"entrypointBE.sh"
chmod -R 550 $PROJECT_DIR"node_modules/"
chmod -R 550 $PROJECT_DIR"resources/"
chmod -R 550 $PROJECT_DIR"routes/"

mkdir -p $PROJECT_DIR"vendor/"
chmod -R 550 $PROJECT_DIR"vendor/"

# Public folder to read only but index.php to read and execute
chmod -R 440 $PROJECT_DIR"public/"
chmod -R 550 $PROJECT_DIR"public/index.php"

# Read & Write Permission To Directories with Code
chmod -R 660 $PROJECT_DIR"storage/"

# Read Permission for .env file
chmod -R 440 $PROJECT_DIR".env"

# Directories with execute bit in order to be able to access them
find $PROJECT_DIR -type d -exec chmod ug+x {} +


mkdir -p $DATABASE_DIR
chmod -R 660 $DATABASE_DIR

# Directories with execute bit in order to be able to access them
find $DATABASE_DIR -type d -exec chmod ug+x {} +
