start-dev:
	docker-compose -f docker-compose.yml up
stop-dev:
	docker-compose -f docker-compose.yml down
build-deploy:
	docker-compose -f docker-compose.build.yml up
start-deploy:
	docker-compose -f docker-compose.deploy.yml up -d
stop-deploy:
	docker-compose -f docker-compose.deploy.yml down
db-set-rights:
	chown -R 999:999 ./docker/cup-mariadb
delete-dbs:
	rm -R ./docker/cup-mariadb
delete-deps:
	# For Laravel
	rm -R ./cup-web/vendor
	rm -R ./cup-web/node-modules
delete-build:
	rm -R ./cup-web/public/build
priv-dev:
	chmod u+x ./scripts/privileges-development.sh && ./scripts/privileges-development.sh
priv-deploy:
	chmod u+x ./scripts/privileges-deploy.sh && ./scripts/privileges-deploy.sh
cup-dev-config:
	docker exec -it cup-dev npm run build
	docker exec -it cup-dev php artisan config:clear
	docker exec -it cup-dev php artisan config:cache
	docker exec -it cup-dev php artisan view:clear
	docker exec -it cup-dev php artisan view:cache
	docker exec -it cup-dev php artisan route:clear
	docker exec -it cup-dev php artisan cache:clear
cup-laravel:
	docker-compose -f docker-compose.laravel.yml up
