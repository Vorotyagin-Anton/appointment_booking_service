# appointment_booking_service
GB final project

### Commands
- `make rebuild` - build and run the project
- `make start` - run the project
- `make down` - stop the project
- `make frontend-cli` - enter to frontend command console
- `make api-cli` - enter to api command console
- `make api-migrate` - apply db changes
- `make api-load-fixtures` - load test data to db (WARNING - current data will be deleted)

### Development host
- `http://localhost:8080` - frontend
- `http://localhost:8081` - api

### Api prefix
- `http://locahost:8081/api` - for requests from the frontend

### DB connection
- `DATABASE_URL="postgresql://root:1234@database:5432/abs?serverVersion=14&charset=utf8"` - create `api/.env.local` and put string there