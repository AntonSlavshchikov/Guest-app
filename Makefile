env:
	cp ./pgsql/.env.example ./pgsql/.env
	cp ./backend/.env.example ./backend/.env

key:
	docker-compose exec app php artisan key:generate
up:
	docker-compose up -d --build

down:
	docker-compose down -v

db-migrate:
	docker-compose exec app php artisan migrate

db-migrate-rollback:
	docker-compose exec app php artisa migrate:rollback

init: env key up db-migrate

test:
	docker-compose exec app php artisan test