restart: down up frontend-install frontend-serve

rebuild: down build up frontend-install frontend-serve

up:
	docker-compose up -d

build:
	docker-compose build

down:
	docker-compose down --remove-orphans

api-cli:
	docker-compose exec api-cli /bin/sh

api-install:
	docker-compose exec composer install

frontend-cli:
	docker-compose exec frontend-cli /bin/sh

frontend-install:
	docker-compose exec node npm install

frontend-serve:
	docker-compose exec node npm run serve
