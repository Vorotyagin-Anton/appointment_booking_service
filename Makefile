rebuild: down build up api-install api-migrate frontend-install frontend-serve

start: up frontend-serve

up:
	docker-compose up -d

build:
	docker-compose build

down:
	docker-compose down --remove-orphans

api-cli:
	docker-compose exec api-cli /bin/sh

api-install:
	docker-compose exec api-cli composer install

api-migrate:
	docker-compose exec api-cli symfony console doctrine:migrations:migrate -n

api-load-fixtures:
	docker-compose exec api-cli symfony console doctrine:fixtures:load -n

frontend-cli:
	docker-compose exec frontend-cli /bin/sh

frontend-install:
	docker-compose exec node npm install

frontend-serve:
	docker-compose exec node npm run dev
