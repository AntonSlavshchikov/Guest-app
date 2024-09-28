env:
	cp ./pgsql/.env.example ./pgsql/.env
	cp ./backend/.env.example ./backend/.env

up:
	docker-compose up -d --build

down:
	docker-compose down -v

db-migrate:
	docker-compose exec app php artisan migrate

db-migrate-rollback:
	docker-compose exec app php artisa migrate:rollback

init: env up db-migrate up