# This is only meant for development purposes.

To start the docker container navigate to /docker folder and run:
```bash
docker compose up -d
```

To execute commands on the docker instance:
```bash
docker exec docker-php-1 composer install       # Install composer packages

docker exec docker-php-1 composer test          # Run tests

docker exec docker-php-1 composer test-coverage # Test coverage

docker exec docker-php-1 composer lint          # Static analysis

docker exec docker-php-1 composer check-style   # Code formatting warnings

docker exec docker-php-1 composer fix-style     # Code formatting automatic fix
```
