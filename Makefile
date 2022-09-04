.DEFAULT_GOAL := help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

rebuild: down build up api-install api-migrate-up frontend-install frontend-serve ## rebuild docker containers with dependencies and run frontend

start: up frontend-serve ## start docker containers and run frontend

up:
	docker-compose up -d

build:
	docker-compose build

down:
	docker-compose down --remove-orphans

api-cli: ## backend cli access
	docker-compose exec -T api-cli /bin/sh

api-install: ## install backend dependencies
	docker-compose exec -T api-cli composer install

api-migrate-up: ## apply last database migrations
	docker-compose exec -T api-cli symfony console doctrine:migrations:migrate -n

api-migrate-down:
	docker-compose exec -T api-cli symfony console doctrine:migrations:migrate 0 -n

api-load-fixtures: ## load fixtures to db (WARNING - rewrite existing data)
	docker-compose exec -T api-cli symfony console doctrine:fixtures:load -n

api-database-reload: api-migrate-down api-migrate-up api-load-fixtures ## migrate down and up, load fixtures (WARNING - rewrite existing data)

api-database-reload-force: ## drop db, create db, load fixtures (WARNING - rewrite existing data)
	docker-compose exec -T api-cli symfony console doctrine:database:drop --force
	docker-compose exec -T api-cli symfony console doctrine:database:create
	make api-migrate-up
	make api-load-fixtures

frontend-cli: ## frontend cli access
	docker-compose exec -T frontend-cli /bin/sh

frontend-install: ## install frontend dependencies
	docker-compose exec -T node npm install

frontend-serve:
	docker-compose exec -T node npm run dev
